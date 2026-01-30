<?php

namespace App\Services;

use App\Mail\DisconnectAlertMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAlertEmailAction
{
    public function send($alert, $gateway, $setting)
    {
        try {
            $companyTimezone = getCompanyTimezone($gateway->company);

            $userIds = $setting->email_users ?? [];

            if (empty($userIds)) {
                return (object) [
                    'success' => false,
                    'error' => 'No email recipients configured',
                ];
            }

            $userIds = array_map('intval', (array) $userIds);

            $users = User::whereIn('id', $userIds)->get();
            if ($users->isEmpty()) {
                return (object) [
                    'success' => false,
                    'error' => 'No valid users found for configured IDs: '.implode(', ', $userIds),
                ];
            }

            $firstItem = $users->first();
            if (! ($firstItem instanceof User)) {
                return (object) [
                    'success' => false,
                    'error' => 'Invalid user data structure',
                ];
            }

            if ($users->isEmpty()) {
                return (object) [
                    'success' => false,
                    'error' => 'No valid users found for configured IDs',
                ];
            }

            $sentCount = 0;
            $errors = [];

            foreach ($users as $user) {
                try {
                    $lastConnectTime = $gateway->last_update
                        ? Carbon::parse($gateway->last_update, 'UTC')
                            ->setTimezone($companyTimezone)
                            ->format('Y-m-d H:i:s')
                        : 'Unknown';

                    $message = $setting->formatMessage([
                        'nick_name' => $user->nick_name ?? $user->name,
                        'gateway_name' => $gateway->gateway_name,
                        'gateway_mac' => $gateway->gateway_mac,
                        'gateway_model' => $gateway->gateway_model,
                        'description' => $gateway->description ?? '',
                        'disconnect_time' => $setting->disconnect_time,
                        'company_name' => $gateway->company->company_name ?? '',
                        'last_connect_datetime' => $lastConnectTime,
                    ]);

                    Mail::to($user->email)->send(new DisconnectAlertMail($alert, $message, $companyTimezone));

                    $sentCount++;
                } catch (\Throwable $e) {
                    $errors[] = "Failed to send to {$user->email}: {$e->getMessage()}";
                    Log::error('SendAlertEmailAction: Failed to send to user', [
                        'alert_id' => $alert->id,
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            if ($sentCount === 0) {
                return (object) [
                    'success' => false,
                    'error' => 'Failed to send to all recipients: '.implode('; ', $errors),
                ];
            }

            return (object) [
                'success' => true,
                'error' => null,
                'sent_count' => $sentCount,
                'total_recipients' => $users->count(),
            ];
        } catch (\Throwable $e) {
            Log::error('SendAlertEmailAction: Unexpected error', [
                'alert_id' => $alert->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return (object) [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
