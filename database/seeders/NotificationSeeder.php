<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) return;

        $notifications = [
            [
                'type' => Notification::TYPE_DELIVERY_COMPLETED,
                'level' => Notification::LEVEL_SUCCESS,
                'message' => 'Bulk Import Success: 104 dockets from Excel "MUM_WEST_01.xlsx" added to system.',
                'created_at' => now()->subMinutes(5),
            ],
            [
                'type' => Notification::TYPE_UNDELIVERED,
                'level' => Notification::LEVEL_ERROR,
                'message' => 'Alert: Docket IND-70010 failed delivery due to "Premises Closed" in Andheri.',
                'created_at' => now()->subHours(1)->subMinutes(20),
            ],
            [
                'type' => Notification::TYPE_DELIVERY_STARTED,
                'level' => Notification::LEVEL_INFO,
                'message' => 'Driver Rajesh Kumar has started the trip for route Mumbai-Central (DL-01-BK-1234).',
                'created_at' => now()->subHours(2)->subMinutes(50),
            ],
            [
                'type' => 'sla_warning', // Custom type for this example
                'level' => Notification::LEVEL_WARNING,
                'message' => 'Warning: 12 dockets in Navi Mumbai area are exceeding the 24-hour SLA limit.',
                'created_at' => now()->subHours(4),
            ],
            [
                'type' => 'system_maintenance',
                'level' => Notification::LEVEL_INFO,
                'message' => 'System Maintenance: Server sync scheduled for 02:00 AM IST.',
                'created_at' => now()->subHours(5),
            ],
        ];

        foreach ($notifications as $data) {
            Notification::create([
                'type' => $data['type'],
                'level' => $data['level'],
                'notifiable_type' => User::class,
                'notifiable_id' => $admin->id,
                'message' => $data['message'],
                'created_at' => $data['created_at'],
            ]);
        }
    }
}
