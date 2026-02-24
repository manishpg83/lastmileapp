<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Delivery;
use App\Models\UndeliveredReason;
use App\Models\DriverLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        User::updateOrCreate(
            ['email' => 'Superadmin@lastmile.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Lastmile@123'),
                'role' => 'super_admin',
                'status' => 'active',
            ]
        );

        // 2. Create Drivers
        $driverData = [
            [
                'name' => 'Devanshu',
                'email' => 'devanshu@lastmile.com',
                'phone' => '9876543211',
                'vehicle_number' => 'MH01AB1235',
                'license_number' => 'DL98766',
            ],
            [
                'name' => 'Saurav',
                'email' => 'saurav@lastmile.com',
                'phone' => '9876543212',
                'vehicle_number' => 'MH01AB1236',
                'license_number' => 'DL98767',
            ],
            [
                'name' => 'Chintan',
                'email' => 'chintan@lastmile.com',
                'phone' => '9876543213',
                'vehicle_number' => 'MH01AB1237',
                'license_number' => 'DL98768',
            ],
        ];

        $drivers = [];
        foreach ($driverData as $data) {
            $drivers[] = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('Lastmile@123'),
                    'role' => 'driver',
                    'phone' => $data['phone'],
                    'vehicle_number' => $data['vehicle_number'],
                    'license_number' => $data['license_number'],
                    'status' => 'active',
                ]
            );
        }

        // 3. Create Undelivered Reasons
        $reasons = [
            ['title' => 'Customer Not Available', 'sort_order' => 1],
            ['title' => 'Address Not Found', 'sort_order' => 2],
            ['title' => 'Phone Unreachable', 'sort_order' => 3],
            ['title' => 'Refused by Customer', 'sort_order' => 4],
            ['title' => 'Area Not Covered', 'sort_order' => 5],
        ];

        foreach ($reasons as $reason) {
            UndeliveredReason::updateOrCreate(['title' => $reason['title']], $reason);
        }

        // 4. Create Sample Deliveries
        $companies = ['Amazon', 'Flipkart', 'BlueDart', 'Delhivery'];
        $statuses = ['pending', 'assigned', 'in_transit', 'delivered', 'undelivered', 'passed'];
        $reasonIds = UndeliveredReason::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            $status = $statuses[array_rand($statuses)];
            $driver = $drivers[array_rand($drivers)];

            Delivery::create([
                'docket_number' => 'DOC' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'customer_name' => 'Customer ' . $i,
                'company_name' => $companies[array_rand($companies)],
                'address' => $i . ' Main St, Mumbai',
                'pincode' => '4000' . str_pad($i % 99, 2, '0', STR_PAD_LEFT),
                'phone' => '9000000' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'driver_id' => ($status === 'pending') ? null : $driver->id,
                'status' => $status,
                'package' => rand(1, 5),
                'weight' => rand(10, 500) / 10,
                'undelivered_reason_id' => ($status === 'undelivered') ? $reasonIds[array_rand($reasonIds)] : null,
                'delivered_at' => ($status === 'delivered') ? now()->subHours(rand(1, 48)) : null,
            ]);
        }

        // 5. Create Sample Driver Logs for Today
        foreach ($drivers as $driver) {
            // Morning Trip
            DriverLog::create([
                'driver_id' => $driver->id,
                'action' => 'start',
                'image' => 'sample_start.jpg',
                'created_at' => Carbon::today()->setHour(9)->setMinute(0),
            ]);

            DriverLog::create([
                'driver_id' => $driver->id,
                'action' => 'end',
                'image' => 'sample_end.jpg',
                'created_at' => Carbon::today()->setHour(13)->setMinute(0),
            ]);

            // Afternoon Trip
            DriverLog::create([
                'driver_id' => $driver->id,
                'action' => 'start',
                'image' => 'sample_start_2.jpg',
                'created_at' => Carbon::today()->setHour(14)->setMinute(30),
            ]);
        }
    }
}