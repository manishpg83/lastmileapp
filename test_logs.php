<?php

use App\Models\User;
use App\Models\DriverLog;
use Illuminate\Support\Facades\Storage;

// Execute in tinker
$driver = User::where('role', 'driver')->first();
if (!$driver) {
    echo "No driver found. Creating one...\n";
    $driver = User::create([
        'name' => 'Test Driver',
        'email' => 'driver@example.com',
        'password' => bcrypt('password'),
        'role' => 'driver',
        'status' => 'active',
    ]);
}

echo "Using driver: {$driver->name} ({$driver->id})\n";

// Clear existing logs for today
DriverLog::where('driver_id', $driver->id)->delete();

// Create logs for today
$today = now()->format('Y-m-d');

// Trip 1
DriverLog::create([
    'driver_id' => $driver->id,
    'action' => 'start',
    'image' => 'test_start.jpg',
    'odometer_reading' => 1000,
    'created_at' => $today . ' 09:00:00',
]);

DriverLog::create([
    'driver_id' => $driver->id,
    'action' => 'end',
    'image' => 'test_end.jpg',
    'odometer_reading' => 1050, // 50km
    'created_at' => $today . ' 12:00:00',
]);

// Trip 2
DriverLog::create([
    'driver_id' => $driver->id,
    'action' => 'start',
    'image' => 'test_start2.jpg',
    'odometer_reading' => 1050,
    'created_at' => $today . ' 13:00:00',
]);

DriverLog::create([
    'driver_id' => $driver->id,
    'action' => 'end',
    'image' => 'test_end2.jpg',
    'odometer_reading' => 1120, // 70km
    'created_at' => $today . ' 17:00:00',
]);

echo "Logs created successfully.\n";
echo "Expected Total Distance: 120 km\n";
