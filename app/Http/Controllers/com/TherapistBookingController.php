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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'mode' => 'required|string',
            'message' => 'nullable|string',
        ]);

        $therapist = Team::findOrFail($request->team_id);
        $amount = $therapist->fees ?? 1000;

        DB::beginTransaction();
        try {
            $booking = TherapistBooking::create([
                'team_id' => $request->team_id,
                'therapist_id' => $request->team_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'booking_date' => $request->date,
                'booking_time' => $request->time,
                'mode' => $request->mode,
                'message' => $request->message,
                'amount' => $amount,
                'payment_status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'razorpay_key' => config('services.razorpay.key_id'),
                'amount' => $amount * 100, // Razorpay works in paise
                'customer' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->phone
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error initializing booking: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $booking = TherapistBooking::with('therapist')->findOrFail($request->booking_id);

        if ($request->razorpay_payment_id) {
            $booking->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'payment_status' => 'paid'
            ]);

            // Send Emails
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

                $adminEmail = SiteSetting::where('key', 'workplace_email')->first()->value ?? 'dilpreetsingh5196@gmail.com';
                $therapistEmail = $booking->therapist->email ?? $adminEmail;

                // 1. Mail to Admin
                Mail::to($adminEmail)->send(new TherapistBookingConfirmation($booking, 'admin'));

                // 2. Mail to Therapist
                if ($booking->therapist->email) {
                    Mail::to($booking->therapist->email)->send(new TherapistBookingConfirmation($booking, 'therapist'));
                }

                // 3. Mail to User
                Mail::to($booking->email)->send(new TherapistBookingConfirmation($booking, 'user'));
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


        }

        return response()->json(['success' => false, 'message' => 'Payment verification failed'], 400);
    }
}
