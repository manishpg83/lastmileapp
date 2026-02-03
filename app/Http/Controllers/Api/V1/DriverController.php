<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UndeliveredReason;
use App\Models\Notification;
use App\Models\DriverLocation;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class DriverController extends Controller
{
    public function todayCount(Request $request)
    {
        if ($request->user()->role !== 'driver') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $deliveriesCount = Delivery::where('driver_id', $request->user()->id)
            ->whereDate('assigned_at', today())
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'deliveries_count' => $deliveriesCount
            ]
        ]);
    }
    /**
     * Get Driver List
     */
    public function driverList(Request $request)
    {
        try {
            if ($request->user()->role !== 'driver') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $loggedInUserId = $request->user()->id;
            $drivers = User::where('role', 'driver')
            ->where('status', 'active')
            ->where('id', '!=', $loggedInUserId)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    // 'email' => $user->email,
                    //'phone' => $user->phone,
                    //'vehicle_number' => $user->vehicle_number,
                    //'license_number' => $user->license_number,
                ];
            });            
            return response()->json([
                'success' => true,
                'data' => [
                    'drivers' => $drivers
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load driver listing.'
            ], 500);
        }
    }

    /**
     * Get Undelivered Reasons List
     */
    public function undeliveredReasons(Request $request)
    {
        try {
            if ($request->user()->role !== 'driver') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $undeliveredReasons = UndeliveredReason::where('status', 'active')->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->title                   
                ];
            });            
            return response()->json([
                'success' => true,
                'data' => [
                    'undelivered_reasons' => $undeliveredReasons
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load Undelivered Reasons.'
            ], 500);
        }
    }

    /**
     * Get Deliveries List
     */
    public function deliveryList(Request $request)
    {
        try {
            if ($request->user()->role !== 'driver') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $loggedInUserId = $request->user()->id;
            $query = Delivery::select(
                'customer_name',
                'id',
                'company_name',
                'address',
                'docket_number',
                'phone',
                'driver_id',
                'status'
            )
            ->where('driver_id', $loggedInUserId)
            ->whereDate('assigned_at', today()) // assigned_at
            ->orderBy('customer_name');

            $deliveriesRaw = $query->get();
            $deliveryCount = $deliveriesRaw->count();
            $deliveries = $deliveriesRaw->groupBy('customer_name');

            return response()->json([
                'success' => true,
                'data' => [
                    'deliveries' => $deliveries,
                    'delivery_count' => $deliveryCount
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load deliveries.'
            ], 500);
        }
    }

    
    
    
    /* public function assignToDriver($driverId)
    {
        $this->driver_id = $driverId;
        $this->updateStatus(self::STATUS_ASSIGNED, auth()->id(), 'Assigned to driver');
        
        return $this;
    } */

    /**
     * Start Deliveries
     */
    public function startDelivery(Request $request)
    {
        try {
            if ($request->user()->role !== 'driver') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $status = Delivery::STATUS_IN_TRANSIT;
            //$delivery->updateStatus($status, $request->user()->id);
            
            // notifcation log 
            $title = 'Delivery Started';
            $message = $request->user()->name. ' has started delivery at '.now()->toDayDateTimeString();
            $data=[ 
                'type' => $status,
                'notifiable_type' => 'driver',
                'notifiable_id' => $request->user()->id,
                'delivery_id'   => null,
                'driver_id'     => $request->user()->id ?? null,
                'docket_number' => null,
                'customer_name' => null,
                'title'         => $title,
                'message'       => $message,
                'read_at'      => null,
            ];
           $this->notificationlog($data);
                 
            // Start timer logic
            // You can store start time in delivery_timers table
            
            return response()->json([
                'success' => true,
                'message' => 'Delivery started',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to start devivery.'
            ], 500);
        }
    }
    /**
     * undelivered
     */
    public function undelivered(Request $request)
    {
        try {
           
            try {
                 $request->validate([
                    'delivery_id' => 'required|integer|exists:deliveries,id',
                    'notes' => 'nullable|string',
                    'undelivered_reason_id' => 'required|integer|exists:undelivered_reasons,id'
                ]);
            } catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->errors(),
                ], 422);
            }
            $deliveryId = $request->delivery_id;
            $delivery = Delivery::findOrFail($deliveryId);
            if ($delivery->driver_id !== $request->user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $status = Delivery::STATUS_UNDELIVERED;
            
            $delivery->updateStatus($status, $request->user()->id, $request->notes);
            
            $delivery->status = $status;
            $delivery->undelivered_reason_id = $request->undelivered_reason_id;
            $delivery->save();

            // notifcation log 
            $title = 'Undeliveried';
            $message = $request->user()->name. ' has '.$status.' due to '.$delivery->undeliveredReason->title;
            $data=[ 
                'type' => $status,     
                'notifiable_type' => 'driver',           
                'notifiable_id' => $request->user()->id,
                'delivery_id'   => $deliveryId,
                'driver_id'     => $request->user()->id ?? null,
                'docket_number' => $delivery->docket_number,
                'customer_name' => $delivery->customer_name,
                'title'         => $title,
                'message'       => $message,
                'read_at'      => null,
            ];
            $this->notificationlog($data);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
               // 'delivery' => $delivery->fresh()
            ]);
        } catch (\Exception $e) {

            \Log::error('Notification insert failed', [
                'error' => $e->getMessage()
            ]);

            throw $e; // important for debugging    
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status.'
            ], 500);
        }
    }
    /**
     * Delivered
     */
    public function uploadPOD(Request $request)
    {
        try{
            try {
                 $request->validate([
                    'delivery_id' => 'required|integer|exists:deliveries,id',
                    'pod_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'quality' => 'required|in:good,bad'
                ]);
            } catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->errors(),
                ], 422);
            }
            $deliveryId = $request->delivery_id;
            $delivery = Delivery::findOrFail($deliveryId);            

            if ($delivery->driver_id !== $request->user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Delete old POD if exists
            if ($delivery->pod_image) {
                Storage::delete('public/pod/' . $delivery->pod_image);
            }

            $status = Delivery::STATUS_DELIVERED;
            
            $delivery->updateStatus($status, $request->user()->id, $request->notes);
            
            $delivery->status = $status;

            // Upload new POD
            $path = $request->file('pod_image')->store('pod', 'public');
            $delivery->pod_image = basename($path);
            $delivery->pod_quality = $request->quality;
            $delivery->save();

            // Dispatch job to sync with third-party if needed
            if ($request->quality === 'good') {
                // SyncWithThirdParty::dispatch($delivery);
            }

            // notifcation log 
            $title = 'Delivered';
            $message = $request->user()->name. ' has '.$status.' successfully with quality with '.$request->quality;
            $data=[ 
                'type' => $status,     
                'notifiable_type' => 'driver',           
                'notifiable_id' => $request->user()->id,
                'delivery_id'   => $deliveryId,
                'driver_id'     => $request->user()->id ?? null,
                'docket_number' => $delivery->docket_number,
                'customer_name' => $delivery->customer_name,
                'title'         => $title,
                'message'       => $message,
                'read_at'      => null,
            ];
            $this->notificationlog($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Delivered successfully'
               // 'pod_url' => $delivery->pod_image_url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delivered.'
            ], 500);
        }
    }

    /**
     * Pass to Another Driver
     */
    public function passToDriver(Request $request)
    {
        try{
            try {
                 $request->validate([
                    'new_driver_id' => 'required|exists:users,id',
                    'delivery_id' => 'required|integer|exists:deliveries,id',
                    'notes' => 'nullable|string'
                ]);
            } catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->errors(),
                ], 422);
            }
            $deliveryId = $request->delivery_id;
            $delivery = Delivery::findOrFail($deliveryId);
            
            if ($delivery->driver_id !== $request->user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $oldDriverId = $delivery->driver_id;
            $delivery->driver_id = $request->new_driver_id;

            $status = Delivery::STATUS_PASSED;
            
            $delivery->status = $status;
            
            $delivery->updateStatus($status, $request->user()->id, 
                "Passed to driver ID: {$request->new_driver_id}");
            
            // Notify new driver
            //event(new DeliveryAssigned($delivery));

            // notifcation log 
            $title = 'Passed to  another driver';
            $message = $request->user()->name. ' has '.$status.' to driver '.$delivery->driver->name;
            $data=[ 
                'type' => $status,     
                'notifiable_type' => 'driver',           
                'notifiable_id' => $request->user()->id,
                'delivery_id'   => $deliveryId,
                'driver_id'     => $request->user()->id ?? null,
                'docket_number' => $delivery->docket_number,
                'customer_name' => $delivery->customer_name,
                'title'         => $title,
                'message'       => $message,
                'read_at'      => null,
            ];
            $this->notificationlog($data);

            return response()->json([
                'success' => true,
                'message' => 'Delivery passed to another driver',
                'delivery' => $delivery->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to passed delivery.'
            ], 500);
        }
    }

    /** 
     * Notification log activity
     */
    protected function notificationlog(array $data)
    {
        try {
            Notification::create([
                'type'            => $data['type'],
                'notifiable_type' => $data['notifiable_type'],
                'notifiable_id'   => $data['notifiable_id'], // ✅ FIXED
                'delivery_id'     => $data['delivery_id'] ?? null,
                'driver_id'       => $data['driver_id'] ?? null,
                'docket_number'   => $data['docket_number'] ?? null,
                'customer_name'   => $data['customer_name'] ?? null,
                'title'           => $data['title'],
                'message'         => $data['message'],
                'read_at'         => $data['read_at'],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Notification insert failed', [
                'error' => $e->getMessage(),
                'data'  => $data,
            ]);

            throw $e; // important for debugging
        }
    }
    /**
     * Get driver dashboard data
     */
    public function dashboard(Request $request)
    {
        try {
            $driver = $request->user();

            // Get today's deliveries
            $todayDeliveries = $driver->deliveries()
                ->whereDate('created_at', today())
                ->with('undeliveredReason')
                ->orderBy('status')
                ->orderBy('scheduled_at')
                ->take(10)
                ->get();

            // Get stats
            $stats = [
                'total_assigned' => $driver->assignedDeliveries()->count(),
                'delivered_today' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_DELIVERED)
                    ->whereDate('delivered_at', today())
                    ->count(),
                'assigned_today' => $driver->deliveries()
                    ->where('assigned_at', today())
                    ->count(),
                'pending' => $driver->assignedDeliveries()
                    ->whereIn('status', [Delivery::STATUS_ASSIGNED, Delivery::STATUS_IN_TRANSIT])
                    ->count(),
                'in_progress' => $driver->assignedDeliveries()
                    ->where('status', Delivery::STATUS_IN_TRANSIT)
                    ->count(),
                'undelivered_today' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_UNDELIVERED)
                    ->whereDate('updated_at', today())
                    ->count(),
            ];

            // Get current location
            $currentLocation = $driver->latestLocation()->first();

            // Get next delivery (if any)
            $nextDelivery = $driver->assignedDeliveries()
                ->whereIn('status', [Delivery::STATUS_ASSIGNED, Delivery::STATUS_IN_TRANSIT])
                ->orderBy('scheduled_at')
                ->first();

            $dashboardData = [
                'stats' => $stats,
                'today_deliveries' => $todayDeliveries,
                'current_location' => $currentLocation ? [
                    'latitude' => $currentLocation->latitude,
                    'longitude' => $currentLocation->longitude,
                    'updated_at' => $currentLocation->created_at->format('Y-m-d H:i:s'),
                    'accuracy' => $currentLocation->accuracy,
                ] : null,
                'next_delivery' => $nextDelivery ? [
                    'id' => $nextDelivery->id,
                    'docket_number' => $nextDelivery->docket_number,
                    'customer_name' => $nextDelivery->customer_name,
                    'address' => $nextDelivery->address,
                    'scheduled_at' => $nextDelivery->scheduled_at ? $nextDelivery->scheduled_at->format('Y-m-d H:i:s') : null,
                ] : null,
            ];

            return response()->json([
                'success' => true,
                'data' => $dashboardData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load dashboard data.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Update driver location
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'accuracy' => 'nullable|numeric|min:0',
            'altitude' => 'nullable|numeric',
            'speed' => 'nullable|numeric|min:0',
            'heading' => 'nullable|numeric|between:0,360',
            'battery_level' => 'nullable|integer|between:0,100',
            'is_charging' => 'nullable|boolean',
            'network_type' => 'nullable|string|in:wifi,cellular,none',
            'signal_strength' => 'nullable|integer|between:-120,-50',
            'app_state' => 'nullable|string|in:foreground,background,terminated',
            'is_moving' => 'nullable|boolean',
        ]);

        try {
            $driver = $request->user();

            // Rate limiting: Max 1 update per 10 seconds
            $cacheKey = "location_update_{$driver->id}";
            if (Cache::has($cacheKey)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Location updated (rate limited).'
                ]);
            }

            // Cache for 10 seconds
            Cache::put($cacheKey, true, 10);

            $location = DriverLocation::create([
                'driver_id' => $driver->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'accuracy' => $request->accuracy,
                'altitude' => $request->altitude,
                'speed' => $request->speed,
                'heading' => $request->heading,
                'battery_level' => $request->battery_level,
                'is_charging' => $request->is_charging,
                'network_type' => $request->network_type,
                'signal_strength' => $request->signal_strength,
                'app_state' => $request->app_state,
                'is_moving' => $request->is_moving ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Location updated successfully.',
                'data' => [
                    'id' => $location->id,
                    'coordinates' => $location->coordinates,
                    'timestamp' => $location->created_at->format('Y-m-d H:i:s'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update location.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get location history
     */
    public function locationHistory(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date_format:Y-m-d',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $driver = $request->user();
            $date = $request->input('date');
            $limit = $request->input('limit', 50);

            $query = $driver->locations()->orderByDesc('created_at');

            if ($date) {
                $query->whereDate('created_at', $date);
            }

            $locations = $query->take($limit)->get();

            $formattedLocations = $locations->map(function ($location) {
                return [
                    'id' => $location->id,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                    'accuracy' => $location->accuracy,
                    'speed' => $location->speed,
                    'heading' => $location->heading,
                    'battery_level' => $location->battery_level,
                    'is_charging' => $location->is_charging,
                    'is_moving' => $location->is_moving,
                    'timestamp' => $location->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'locations' => $formattedLocations,
                    'count' => $locations->count(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load location history.'
            ], 500);
        }
    }

    /**
     * Get driver statistics
     */
    public function stats(Request $request)
    {
        try {
            $driver = $request->user();

            // Get today's stats
            $todayStats = [
                'total' => $driver->deliveries()->whereDate('created_at', today())->count(),
                'delivered' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_DELIVERED)
                    ->whereDate('delivered_at', today())
                    ->count(),
                'undelivered' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_UNDELIVERED)
                    ->whereDate('updated_at', today())
                    ->count(),
                'in_progress' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_IN_TRANSIT)
                    ->whereDate('started_at', today())
                    ->count(),
            ];

            // Get weekly stats
            $weekStart = now()->startOfWeek();
            $weekEnd = now()->endOfWeek();

            $weeklyStats = [
                'total' => $driver->deliveries()
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->count(),
                'delivered' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_DELIVERED)
                    ->whereBetween('delivered_at', [$weekStart, $weekEnd])
                    ->count(),
                'success_rate' => $todayStats['total'] > 0 
                    ? round(($todayStats['delivered'] / $todayStats['total']) * 100, 2)
                    : 0,
            ];

            // Get all-time stats
            $allTimeStats = [
                'total_deliveries' => $driver->deliveries()->count(),
                'total_delivered' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_DELIVERED)
                    ->count(),
                'total_undelivered' => $driver->deliveries()
                    ->where('status', Delivery::STATUS_UNDELIVERED)
                    ->count(),
                'delivery_success_rate' => $driver->deliveries()->count() > 0
                    ? round(($driver->deliveries()->where('status', Delivery::STATUS_DELIVERED)->count() / $driver->deliveries()->count()) * 100, 2)
                    : 0,
            ];

            return response()->json([
                'success' => true,
                'data' => [
                    'today' => $todayStats,
                    'weekly' => $weeklyStats,
                    'all_time' => $allTimeStats,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load statistics.'
            ], 500);
        }
    }

    /**
     * Get weekly statistics with day-by-day breakdown
     */
    public function weeklyStats(Request $request)
    {
        try {
            $driver = $request->user();
            $days = [];

            // Get stats for last 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dayStart = $date->copy()->startOfDay();
                $dayEnd = $date->copy()->endOfDay();

                $dayStats = [
                    'date' => $date->format('Y-m-d'),
                    'day_name' => $date->format('D'),
                    'total' => $driver->deliveries()
                        ->whereBetween('created_at', [$dayStart, $dayEnd])
                        ->count(),
                    'delivered' => $driver->deliveries()
                        ->where('status', Delivery::STATUS_DELIVERED)
                        ->whereBetween('delivered_at', [$dayStart, $dayEnd])
                        ->count(),
                    'undelivered' => $driver->deliveries()
                        ->where('status', Delivery::STATUS_UNDELIVERED)
                        ->whereBetween('updated_at', [$dayStart, $dayEnd])
                        ->count(),
                ];

                $dayStats['success_rate'] = $dayStats['total'] > 0
                    ? round(($dayStats['delivered'] / $dayStats['total']) * 100, 2)
                    : 0;

                $days[] = $dayStats;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'days' => $days,
                    'total' => array_sum(array_column($days, 'total')),
                    'total_delivered' => array_sum(array_column($days, 'delivered')),
                    'average_success_rate' => round(array_sum(array_column($days, 'success_rate')) / count($days), 2),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load weekly statistics.'
            ], 500);
        }
    }

    /**
     * Get driver settings
     */
    public function settings(Request $request)
    {
        try {
            $driver = $request->user();

            $settings = [
                'notifications' => [
                    'new_delivery' => true,
                    'delivery_reminder' => true,
                    'status_update' => true,
                    'system_alerts' => true,
                ],
                'location' => [
                    'tracking_interval' => 30, // seconds
                    'high_accuracy_mode' => false,
                    'background_tracking' => true,
                ],
                'app' => [
                    'theme' => 'light',
                    'language' => 'en',
                    'auto_logout' => 30, // minutes
                ],
            ];

            return response()->json([
                'success' => true,
                'data' => $settings
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load settings.'
            ], 500);
        }
    }

    /**
     * Update driver settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.notifications' => 'nullable|array',
            'settings.location' => 'nullable|array',
            'settings.app' => 'nullable|array',
        ]);

        try {
            $driver = $request->user();
            
            // In a real app, you might store these in a separate table
            // For now, we'll just return success
            $settings = $request->input('settings');

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully.',
                'data' => $settings
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update settings.'
            ], 500);
        }
    }
}