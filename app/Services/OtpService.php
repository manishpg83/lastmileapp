<?php

namespace App\Services;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OtpService
{
    protected $smsService;

    public function __construct()
    {
        // You can inject SMS service here (Twilio, MSG91, etc.)
        $this->smsService = config('services.sms.default');
    }

    public function sendOtp($phone, $purpose = OTP::PURPOSE_LOGIN, $ip = null): array
    {
        try {
            // Check if user exists and is a driver
            $user = User::where('phone', $phone)
                ->where('role', 'driver')
                ->first();

            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Driver not found with this phone number.'
                ];
            }

            if ($user->status !== 'active') {
                return [
                    'success' => false,
                    'message' => 'Your account is inactive. Please contact administrator.'
                ];
            }

            // Rate limiting: Check for too many OTP requests
            $recentOtpCount = OTP::where('phone', $phone)
                ->where('created_at', '>=', now()->subHour())
                ->count();

            if ($recentOtpCount >= 5) {
                return [
                    'success' => false,
                    'message' => 'Too many OTP requests. Please try again after 1 hour.'
                ];
            }

            // Generate and save OTP
            $otp = OTP::generateOTP($phone, $purpose, $ip);

            // For development/testing, return OTP directly
            if (app()->environment('local', 'testing')) {
                return [
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                    'otp' => $otp->otp, // Only for development
                    'phone' => $phone
                ];
            }

            // For production, send SMS
            $smsSent = $this->sendSms($phone, $otp->otp);

            if ($smsSent) {
                return [
                    'success' => true,
                    'message' => 'OTP sent successfully to your phone.',
                    'phone' => $phone
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ];

        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ];
        }
    }

    public function verifyOtp($phone, $otp, $purpose = OTP::PURPOSE_LOGIN): bool
    {
        try {
            return OTP::verifyOTP($phone, $otp, $purpose);
        } catch (\Exception $e) {
            Log::error('OTP Verify Error: ' . $e->getMessage());
            return false;
        }
    }

    public function resendOtp($phone, $purpose = OTP::PURPOSE_LOGIN, $ip = null): array
    {
        // Clear old unused OTPs
        OTP::where('phone', $phone)
            ->where('purpose', $purpose)
            ->where('used', false)
            ->where('expires_at', '<', now())
            ->delete();

        return $this->sendOtp($phone, $purpose, $ip);
    }

    private function sendSms($phone, $otp): bool
    {
        try {
            // Example using MSG91 (Indian SMS service)
            $apiKey = config('services.msg91.key');
            $senderId = config('services.msg91.sender_id');
            $route = config('services.msg91.route');
            $country = config('services.msg91.country');

            $message = "Your OTP for login is: {$otp}. Valid for 10 minutes. Do not share with anyone.";

            $response = Http::post('https://api.msg91.com/api/v5/flow/', [
                'template_id' => config('services.msg91.template_id'),
                'short_url' => '0',
                'recipients' => [
                    [
                        'mobiles' => ltrim($phone, '+'),
                        'var' => $otp,
                    ]
                ]
            ], [
                'authkey' => $apiKey,
                'Content-Type' => 'application/json',
            ]);

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('SMS Send Error: ' . $e->getMessage());
            
            // Fallback to another SMS service or return true for testing
            return app()->environment('local', 'testing');
        }
    }

    public function sendForgotPasswordOtp($phone): array
    {
        $user = User::where('phone', $phone)
            ->where('role', 'driver')
            ->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Driver not found with this phone number.'
            ];
        }

        return $this->sendOtp($phone, OTP::PURPOSE_RESET_PASSWORD);
    }
}