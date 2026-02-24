<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DriverLog;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DriverLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::where('role', 'driver')->get();

        if ($drivers->isEmpty()) {
            $this->command->info('No drivers found. Creating a test driver first.');
            $drivers = collect([User::create([
                'name' => 'Test Driver (Seeder)',
                'email' => 'driver_seeder@example.com',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'status' => 'active',
            ])]);
        }

        foreach ($drivers as $driver) {
            // Clear existing logs for these drivers to avoid duplicates
            DriverLog::where('driver_id', $driver->id)->delete();
            $this->command->info("Creating logs for {$driver->name}...");

            $startOdometer = 10000;

            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                
                // Random number of trips per day (1-3)
                $trips = rand(1, 3);

                for ($j = 0; $j < $trips; $j++) {
                    $startTime = $date->copy()->addHours(8 + ($j * 3)); // 8am, 11am, 2pm roughly
                    $endTime = $startTime->copy()->addHours(2);
                    
                    $tripDistance = rand(10, 50);
                    $endOdometer = $startOdometer + $tripDistance;

                    DriverLog::create([
                        'driver_id' => $driver->id,
                        'action' => 'start',
                        // Minimal placeholder image string
                        'image' => 'placeholder_start.jpg', 
                        'odometer_reading' => $startOdometer,
                        'created_at' => $startTime,
                        'updated_at' => $startTime,
                    ]);

                    DriverLog::create([
                        'driver_id' => $driver->id,
                        'action' => 'end',
                        'image' => 'placeholder_end.jpg',
                        'odometer_reading' => $endOdometer,
                        'created_at' => $endTime,
                        'updated_at' => $endTime,
                    ]);

                    $startOdometer = $endOdometer;
                }
            }
        }
    }
}
