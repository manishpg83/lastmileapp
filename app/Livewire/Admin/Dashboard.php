<?php

namespace App\Livewire\Admin;

use App\Models\Delivery;
use App\Models\DriverLog;
use App\Models\User;
use App\Models\DeliveryTimer;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public $dateFilter = 'today';
    protected $paginationTheme = 'bootstrap';
    public function updatedDateFilter()
    {
        $this->dispatch('dateFilterUpdated', $this->dateFilter);
    }

    public function render()
    {
        $deliveryQuery = Delivery::query();
        $logQuery = DriverLog::query();
        $timerQuery = DeliveryTimer::query();

        if ($this->dateFilter === 'today') {
            $deliveryQuery->whereDate('updated_at', today());
            $logQuery->whereDate('updated_at', today());
            $timerQuery->whereDate('updated_at', today());
        } elseif ($this->dateFilter === 'yesterday') {
            $deliveryQuery->whereDate('updated_at', today()->subDay());
            $logQuery->whereDate('updated_at', today()->subDay());
            $timerQuery->whereDate('updated_at', today()->subDay());
        } elseif ($this->dateFilter === 'this_week') {
            $deliveryQuery->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
            $logQuery->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
            $timerQuery->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $deliveryQuery->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
            $logQuery->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
            $timerQuery->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
        }
        // If 'all', we don't apply any date filters

        $totalDockets = (clone $deliveryQuery)->count();
        $delivered = (clone $deliveryQuery)->where(function($q) {
            $q->where('status', 'delivered')
              ->orWhere('synced_to_third_party', true);
        })->count();
        $undelivered = (clone $deliveryQuery)->where('status', 'undelivered')->count();
        $inProgress = (clone $deliveryQuery)->whereNotIn('status', ['delivered', 'undelivered'])
            ->where('synced_to_third_party', false)
            ->count();

        // New Metrics - Always show Global Totals as requested
        $totalDrivers = User::where('role', 'driver')->count();
        $totalCustomers = Delivery::distinct('customer_name')->count('customer_name');
        
        $totalKm = DriverLog::where('action', 'end')->sum('distance');
        
        $totalSeconds = DeliveryTimer::sum('total_seconds');
        
        // Fallback: If no timer data, calculate hours from DriverLogs (global)
        if ($totalSeconds == 0) {
            $logsForHours = DriverLog::whereIn('action', ['start', 'end'])
                ->orderBy('driver_id')
                ->orderBy('created_at')
                ->get();
            
            $tempTotalSeconds = 0;
            $currentStarts = []; // [driver_id => start_time]

            foreach ($logsForHours as $log) {
                if ($log->action === 'start') {
                    $currentStarts[$log->driver_id] = $log->created_at;
                } elseif ($log->action === 'end' && isset($currentStarts[$log->driver_id])) {
                    $tempTotalSeconds += $currentStarts[$log->driver_id]->diffInSeconds($log->created_at);
                    unset($currentStarts[$log->driver_id]);
                }
            }
            $totalSeconds = $tempTotalSeconds;
        }

        $totalHours = round($totalSeconds / 3600, 2);

        // Calculate averages based on all active drivers in history
        $totalActiveDrivers = Delivery::whereNotNull('driver_id')->distinct('driver_id')->count('driver_id');
        
        $avgKm = $totalActiveDrivers > 0 ? round($totalKm / $totalActiveDrivers, 2) : 0;
        $avgHours = $totalActiveDrivers > 0 ? round($totalHours / $totalActiveDrivers, 2) : 0;

        // Chart Data: Last 15 days performance
        $chartData = [
            'labels' => [],
            'deliveries' => [],
            'delivered' => [],
            'undelivered' => []
        ];

        for ($i = 14; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dateLabel = now()->subDays($i)->format('d M');
            
            $chartData['labels'][] = $dateLabel;
            
            $dayQuery = Delivery::whereDate('updated_at', $date);
            $chartData['deliveries'][] = (clone $dayQuery)->count();
            $chartData['delivered'][] = (clone $dayQuery)->where(function($q) {
                $q->where('status', 'delivered')
                  ->orWhere('synced_to_third_party', true);
            })->count();
            $chartData['undelivered'][] = (clone $dayQuery)->where('status', 'undelivered')->count();
        }

        return view('livewire.admin.dashboard', [
            'totalDockets' => $totalDockets,
            'delivered' => $delivered,
            'undelivered' => $undelivered,
            'inProgress' => $inProgress,
            'totalDrivers' => $totalDrivers,
            'totalCustomers' => $totalCustomers,
            'totalKm' => $totalKm,
            'totalHours' => $totalHours,
            'avgKm' => $avgKm,
            'avgHours' => $avgHours,
            'chartData' => $chartData,
        ]);
    }
}
