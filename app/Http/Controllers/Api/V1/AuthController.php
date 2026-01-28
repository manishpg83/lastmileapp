<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverLoginRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\OtpService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Send OTP for driver login
     */
    public function sendOtp(DriverLoginRequest $request)
    {
        try {
            $phone = $request->input('phone');
            $deviceId = $request->input('device_id');
            $deviceName = $request->input('device_name');
            
            $ip = $request->ip();
            
            $result = $this->otpService->sendOtp($phone);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            // Store device info temporarily (could store in session or cache)
            if ($deviceId) {
                cache()->put("device_{$phone}", [
                    'device_id' => $deviceId,
                    'device_name' => $deviceName,
                ], now()->addMinutes(10));
            }

            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => [
                    'phone' => $phone,
                    'otp' => $result['otp'] ?? null, // Only in development
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Verify OTP and login driver
     */
    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $phone = $request->input('phone');
            $otp = $request->input('otp');
            $deviceId = $request->input('device_id');
            $deviceName = $request->input('device_name');

            // Verify OTP
           /*  $verified = $this->otpService->verifyOtp($phone, $otp, 'login');

            if (!$verified) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP.'
                ], 400);
            } */

            // Get driver
            $driver = User::where('phone', $phone)
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found.'
                ], 404);
            }

            if ($driver->status !== 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is inactive. Please contact administrator.'
                ], 403);
            }

            // Check device limit (optional)
            $maxDevices = config('app.max_driver_devices', 3);
            if ($driver->tokens()->count() >= $maxDevices) {
                // Revoke oldest token
                $oldestToken = $driver->tokens()->oldest()->first();
                if ($oldestToken) {
                    $oldestToken->delete();
                }
            }

            // Delete existing tokens for this device (optional)
            if ($deviceId) {
                $driver->tokens()
                    ->where('name', 'like', "%{$deviceId}%")
                    ->delete();
            }

            // Create token with device info
            $tokenName = "Driver App";
            if ($deviceName) {
                $tokenName .= " - {$deviceName}";
            }
            if ($deviceId) {
                $tokenName .= " ({$deviceId})";
            }

            //$driver->tokens()->delete();

            //$token = $driver->createToken('driver-token')->plainTextToken;

            $token = $driver->createToken($tokenName, ['driver'])->plainTextToken;

            // Update last login
            //$driver->last_login_at = now();
            //$driver->save();

            //$driver = $request->user();
            // Prepare response
            $response = [
                'success' => true,
                'message' => 'Login successful.',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'driver' => [
                        'id' => $driver->id,
                        'name' => $driver->name,
                        'email' => $driver->email,
                        'phone' => $driver->phone,
                        'profile_image' => $driver->profile_image_url,
                        'assigned_deliveries' => 0 //$driver->assignedDeliveries()->count()
                    ]
                ]
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
        ]);

        try {
            $phone = $request->input('phone');
            $ip = $request->ip();

            $result = $this->otpService->resendOtp($phone);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => [
                    'phone' => $phone,
                    'otp' => $result['otp'] ?? null, // Only in development
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Logout driver
     */
    public function logout(Request $request)
    {
        try {
            $driver = $request->user();
            
            // Clear FCM token
            $driver->clearFcmToken();
            
            // Revoke current token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed. Please try again.'
            ], 500);
        }
    }

    /**
     * Update FCM token for push notifications
     */
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        try {
            $driver = $request->user();
            $driver->updateFcmToken($request->input('fcm_token'));

            return response()->json([
                'success' => true,
                'message' => 'FCM token updated successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update FCM token.'
            ], 500);
        }
    }

    /**
     * Get driver profile
     */
    public function profile(Request $request)
    {
        try {
            $driver = $request->user()->loadCount([
                'assignedDeliveries',
                'deliveredToday',
                'deliveries as total_deliveries_count'
            ]);

            $profile = [
                'id' => $driver->id,
                'name' => $driver->name,
                'email' => $driver->email,
                'phone' => $driver->phone,
                'vehicle_number' => $driver->vehicle_number,
                'license_number' => $driver->license_number,
                'profile_image' => $driver->profile_image_url,
                'status' => $driver->status,
                'created_at' => $driver->created_at->format('Y-m-d H:i:s'),
                'stats' => [
                    'assigned_deliveries' => $driver->assigned_deliveries_count,
                    'delivered_today' => $driver->delivered_today_count,
                    'total_deliveries' => $driver->total_deliveries_count,
                ]
            ];

            return response()->json([
                'success' => true,
                'data' => $profile
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load profile.'
            ], 500);
        }
    }

    /**
     * Update driver profile
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $driver = $request->user();
            $data = $request->validated();

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($driver->profile_image) {
                    Storage::delete('public/profiles/' . $driver->profile_image);
                }

                // Upload new image
                $path = $request->file('profile_image')->store('profiles', 'public');
                $data['profile_image'] = basename($path);
            }

            $driver->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'data' => [
                    'profile_image' => $driver->profile_image_url
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile.'
            ], 500);
        }
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $driver = $request->user();

            // Verify current password
            if (!Hash::check($request->current_password, $driver->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.'
                ], 400);
            }

            // Update password
            $driver->password = Hash::make($request->new_password);
            $driver->save();

            // Revoke all tokens (optional, for security)
            $driver->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully. Please login again.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change password.'
            ], 500);
        }
    }

    /**
     * Forgot password - Send reset OTP
     */
    /* public function forgotPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
        ]);

        try {
            $phone = $request->input('phone');
            
            $result = $this->otpService->sendForgotPasswordOtp($phone);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => [
                    'phone' => $phone,
                    'otp' => $result['otp'] ?? null, // Only in development
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process request. Please try again.'
            ], 500);
        }
    } */

    /**
     * Reset password with OTP
     */
    /* public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'otp' => 'required|string|digits:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $phone = $request->input('phone');
            $otp = $request->input('otp');
            $password = $request->input('password');

            // Verify OTP
            $verified = $this->otpService->verifyOtp($phone, $otp, 'reset_password');

            if (!$verified) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP.'
                ], 400);
            }

            // Get driver
            $driver = User::where('phone', $phone)
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found.'
                ], 404);
            }

            // Update password
            $driver->password = Hash::make($password);
            $driver->save();

            // Revoke all existing tokens
            $driver->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully. Please login with new password.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password.'
            ], 500);
        }
    } */
}