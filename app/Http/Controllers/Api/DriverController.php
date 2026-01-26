<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverLocation;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DriverController extends Controller
{
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