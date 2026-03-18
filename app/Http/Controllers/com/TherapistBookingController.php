<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TherapistBooking;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TherapistBookingConfirmation;

class TherapistBookingController extends Controller
{
    public function initializeBooking(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'mode' => 'required|string',
            'gender' => 'required|string',
            'location' => 'required|string',
            'message' => 'nullable|string',
        ]);

        $therapist = Team::findOrFail($request->team_id);

        // Find the service-specific fee if assigned
        $servicePivot = DB::table('service_team')
            ->where('team_id', $request->team_id)
            ->where('service_id', $request->service_id)
            ->first();

        $amount = ($servicePivot && $servicePivot->fees) ? $servicePivot->fees : ($therapist->fees ?? 1000);

        DB::beginTransaction();
        try {
            $booking = TherapistBooking::create([
                'team_id' => $request->team_id,
                'service_id' => $request->service_id,
                'therapist_id' => $request->team_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'booking_date' => $request->date,
                'booking_time' => $request->time,
                'mode' => $request->mode,
                'gender' => $request->gender,
                'location' => $request->location,
                'message' => $request->message,
                'amount' => $amount,
                'payment_status' => 'pending',
            ]);

            // 1. Initialize Razorpay API
            $api = new \Razorpay\Api\Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));

            // 2. Prepare Order Data
            $orderData = [
                'receipt' => 'rcpt_' . $booking->id,
                'amount' => (int) round($amount * 100), // in paise, cast to int to avoid decimals
                'currency' => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            // 3. Handle Split Payment (Razorpay Route) if Therapist Account ID exists
            if ($therapist->razorpay_account_id) {
                // Calculate therapist share: Amount * (100 - Commission) / 100
                $commission = (float) ($therapist->commission_percentage ?? 0);
                $therapistSharePaise = (int) round(($amount * (100 - $commission) / 100) * 100);

                if ($therapistSharePaise > 0) {
                    $orderData['transfers'] = [
                        [
                            'account' => $therapist->razorpay_account_id,
                            'amount' => $therapistSharePaise,
                            'currency' => 'INR',
                        ]
                    ];
                }
            }

            // 4. Create Razorpay Order
            $razorpayOrder = $api->order->create($orderData);

            // 5. Update booking with Order ID
            $booking->update([
                'razorpay_order_id' => $razorpayOrder->id
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'razorpay_order_id' => $razorpayOrder->id,
                'razorpay_key' => config('services.razorpay.key_id'),
                'amount' => $amount * 100,
                'customer' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->phone
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Razorpay Order Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error initializing booking: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $booking = TherapistBooking::with('therapist')->findOrFail($request->booking_id);

        try {
            // 1. Verify Signature using Razorpay SDK
            $api = new \Razorpay\Api\Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // 2. If verification successful, update booking
            $booking->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'payment_status' => 'paid'
            ]);

            // Send Emails
            $emailStatus = 'sent';
            try {
                // Configure Mail from Database
                $smtpSettings = SiteSetting::whereIn('key', [
                    'mail_mailer',
                    'mail_host',
                    'mail_port',
                    'mail_username',
                    'mail_password',
                    'mail_encryption',
                    'mail_from_address',
                    'mail_from_name'
                ])->pluck('value', 'key');

                if ($smtpSettings->has('mail_host')) {
                    config([
                        'mail.default' => $smtpSettings['mail_mailer'] ?? 'smtp',
                        'mail.mailers.smtp.host' => $smtpSettings['mail_host'],
                        'mail.mailers.smtp.port' => $smtpSettings['mail_port'],
                        'mail.mailers.smtp.encryption' => $smtpSettings['mail_encryption'],
                        'mail.mailers.smtp.username' => $smtpSettings['mail_username'],
                        'mail.mailers.smtp.password' => $smtpSettings['mail_password'],
                        'mail.from.address' => $smtpSettings['mail_from_address'],
                        'mail.from.name' => $smtpSettings['mail_from_name'] ?? config('app.name'),
                    ]);
                }

                // $adminEmail = SiteSetting::where('key', 'workplace_email')->first()->value ?? 'dilpreetsingh5196@gmail.com';
                // $therapistEmail = $booking->therapist->email ?? $adminEmail;

                // // 1. Mail to Admin
                // Mail::to($adminEmail)->send(new TherapistBookingConfirmation($booking, 'admin'));

                // 2. Mail to Therapist
                if ($booking->therapist && $booking->therapist->email) {
                    Mail::to($booking->therapist->email)->send(new TherapistBookingConfirmation($booking, 'therapist'));
                }

                // 3. Mail to User
                Mail::to($booking->email)->send(new TherapistBookingConfirmation($booking, 'user'));

                // 4. Auto-create Google Calendar Event for Therapist
                if ($booking->therapist && $booking->therapist->google_access_token) {
                    try {
                        $calendarService = new \App\Services\GoogleCalendarService();

                        $startTime = \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->booking_time, 'Asia/Kolkata');

                        // Determine duration (extract number from e.g. "60 mins")
                        $durationStr = DB::table('service_team')
                            ->where('team_id', $booking->team_id)
                            ->where('service_id', $booking->service_id)
                            ->value('duration') ?? '60';

                        $duration = (int) filter_var($durationStr, FILTER_SANITIZE_NUMBER_INT);
                        if ($duration <= 0)
                            $duration = 60;

                        $endTime = (clone $startTime)->addMinutes($duration);

                        $calendarService->createEvent($booking->therapist, [
                            'client_name' => $booking->name,
                            'client_email' => $booking->email,
                            'client_phone' => $booking->phone,
                            'start_time' => $startTime->toIso8601String(),
                            'end_time' => $endTime->toIso8601String(),
                            'location' => $booking->location ?? 'Online (Link will be shared)',
                        ]);
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Google Calendar Sync Error: ' . $e->getMessage());
                    }
                }
            } catch (\Exception $e) {
                // Log the error but don't fail the request
                \Illuminate\Support\Facades\Log::error('Booking Email Error: ' . $e->getMessage());
                $emailStatus = 'failed: ' . $e->getMessage();
            }

            return response()->json([
                'success' => true,
                'message' => 'Booking confirmed successfully!',
                'email_status' => $emailStatus
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Razorpay Verification Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }
    }
}
