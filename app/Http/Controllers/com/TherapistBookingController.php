<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TherapistBooking;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TherapistBookingConfirmation;

class TherapistBookingController extends Controller
{
    public function initializeBooking(Request $request)
    {
        $rules = [
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
        ];

        if (!Auth::check()) {
            $rules['create_account'] = 'required|accepted';
            $rules['password'] = 'required|min:8|confirmed';
            $rules['email'] = 'required|email|max:255|unique:users,email';
        }

        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $user_id = Auth::id();

            // 1. Handle user registration for guests (Now INSIDE transaction)
            if (!$user_id && $request->has('create_account')) {
                try {
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'city' => $request->location,
                        'password' => Hash::make($request->password),
                    ]);

                    $userRole = \App\Models\Role::where('slug', 'user')->first();
                    if ($userRole) {
                        $user->roles()->attach($userRole->id);
                    }

                    Auth::login($user);
                    $user_id = $user->id;
                } catch (\Exception $e) {
                    throw new \Exception("Account creation failed: " . $e->getMessage());
                }
            }

            // 2. Booking Data Preparation
            $therapist = Team::findOrFail($request->team_id);
            $servicePivot = DB::table('service_team')
                ->where('team_id', $request->team_id)
                ->where('service_id', $request->service_id)
                ->first();

            $amount = ($servicePivot && $servicePivot->fees) ? $servicePivot->fees : ($therapist->fees ?? 1000);

            // 3. Create Booking
            try {
                $booking = TherapistBooking::create([
                    'user_id' => $user_id,
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
            } catch (\Exception $e) {
                throw new \Exception("Booking registration failed: " . $e->getMessage());
            }

            // 4. Initialize Razorpay Order
            try {
                $razorpay = $this->getRazorpayApi();
                $api = $razorpay['api'];
                $razorpayKeyId = $razorpay['key'];

                $orderData = [
                    'receipt' => 'rcpt_' . $booking->id,
                    'amount' => (int) round($amount * 100),
                    'currency' => $razorpay['currency'],
                    'payment_capture' => 1
                ];

                if ($therapist->razorpay_account_id) {
                    $commission = (float) ($therapist->commission_percentage ?? 0);
                    $therapistSharePaise = (int) round(($amount * (100 - $commission) / 100) * 100);

                    if ($therapistSharePaise > 0) {
                        $orderData['transfers'] = [
                            [
                                'account' => $therapist->razorpay_account_id,
                                'amount' => $therapistSharePaise,
                                'currency' => $razorpay['currency'],
                            ]
                        ];
                    }
                }

                $razorpayOrder = $api->order->create($orderData);
                $booking->update(['razorpay_order_id' => $razorpayOrder->id]);

            } catch (\Exception $e) {
                throw new \Exception("Payment initialization failed: " . $e->getMessage());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'razorpay_order_id' => $razorpayOrder->id,
                'razorpay_key' => $razorpayKeyId,
                'currency' => $razorpay['currency'],
                'amount' => $amount * 100,
                'new_token' => csrf_token(),
                'customer' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->phone
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Booking Initialization Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $booking = TherapistBooking::with('therapist')->findOrFail($request->booking_id);

        try {
            // 1. Verify Signature using Razorpay SDK
            $razorpay = $this->getRazorpayApi();
            $api = $razorpay['api'];

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            try {
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                throw new \Exception("Payment signature verification failed. Possible fraud or invalid transaction.");
            }

            // 2. If verification successful, update booking
            $booking->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'payment_status' => 'paid'
            ]);

            // 3. Send Emails & Calendar Sync
            $emailStatus = 'sent';
            try {
                $this->configureMailSettings();

                // Mail to Therapist
                if ($booking->therapist && $booking->therapist->email) {
                    Mail::to($booking->therapist->email)->send(new TherapistBookingConfirmation($booking, 'therapist'));
                }

                // Mail to User
                Mail::to($booking->email)->send(new TherapistBookingConfirmation($booking, 'user'));

                // Auto-create Google Calendar Event for Therapist
                if ($booking->therapist && $booking->therapist->google_access_token) {
                    try {
                        $calendarService = new \App\Services\GoogleCalendarService();
                        $startTime = \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->booking_time, 'Asia/Kolkata');

                        $durationStr = DB::table('service_team')
                            ->where('team_id', $booking->team_id)
                            ->where('service_id', $booking->service_id)
                            ->value('duration') ?? '60';

                        $duration = (int) filter_var($durationStr, FILTER_SANITIZE_NUMBER_INT);
                        if ($duration <= 0) $duration = 60;

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
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get Razorpay API instance with credentials from DB or Config.
     */
    private function getRazorpayApi()
    {
        $razorpayKeyId = SiteSetting::where('key', 'razorpay_key_id')->value('value') ?? config('services.razorpay.key_id');
        $razorpayKeySecret = SiteSetting::where('key', 'razorpay_key_secret')->value('value') ?? config('services.razorpay.key_secret');
        $razorpayCurrency = SiteSetting::where('key', 'razorpay_currency')->value('value') ?? config('services.razorpay.currency', 'INR');

        if (!$razorpayKeyId || !$razorpayKeySecret) {
            throw new \Exception("Razorpay credentials are not configured properly.");
        }

        return [
            'api' => new \Razorpay\Api\Api($razorpayKeyId, $razorpayKeySecret),
            'key' => $razorpayKeyId,
            'currency' => $razorpayCurrency
        ];
    }

    /**
     * Configure Mail settings dynamically from SiteSettings.
     */
    private function configureMailSettings()
    {
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
    }
}
