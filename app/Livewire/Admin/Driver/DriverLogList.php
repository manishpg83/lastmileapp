<?php

namespace App\Livewire\Admin\Driver;

use Livewire\Component;
use App\Models\User;
use App\Models\DriverLog;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Carbon\Carbon;

#[Layout('layouts.app')]
class DriverLogList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $driverId;
    public $dateFrom;
    public $dateTo;
    public $kmInputs = []; // [logId => value]

    protected $queryString = ['dateFrom', 'dateTo'];

    public function mount(User $driver)
    {
        $this->driverId = $driver->id;
        $this->dateFrom = now()->subDays(6)->format('Y-m-d'); // Default to last 7 days
        $this->dateTo = now()->format('Y-m-d');
        $this->loadKmInputs();
    }

    public function loadKmInputs()
    {
        $logs = DriverLog::where('driver_id', $this->driverId)->get();
        foreach ($logs as $log) {
            $this->kmInputs[$log->id] = $log->km_reading;
        }
    }

    public function render()
    {
        $driver = User::findOrFail($this->driverId);

        // Get all logs for the period to perform pairing
        $logs = DriverLog::where('driver_id', $this->driverId)
            ->whereDate('created_at', '>=', $this->dateFrom)
            ->whereDate('created_at', '<=', $this->dateTo)
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $allTrips = [];
        $currentStart = null;

        foreach ($logs as $log) {
            if ($log->action === 'start') {
                if ($currentStart) {
                    $allTrips[] = ['start' => $currentStart, 'end' => null, 'date' => $currentStart->created_at->format('Y-m-d')];
                }
                $currentStart = $log;
            } elseif ($log->action === 'end') {
                $allTrips[] = ['start' => $currentStart, 'end' => $log, 'date' => $log->created_at->format('Y-m-d')];
                $currentStart = null;
            }
        }

        if ($currentStart) {
            $allTrips[] = ['start' => $currentStart, 'end' => null, 'date' => $currentStart->created_at->format('Y-m-d')];
        }

        // Reverse to show latest first
        $allTrips = array_reverse($allTrips);

        // Manually paginate the paired trips
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $currentItems = array_slice($allTrips, ($currentPage - 1) * $perPage, $perPage);
        $paginatedTrips = new LengthAwarePaginator(
            $currentItems,
            count($allTrips),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.admin.driver.driver-log-list', [
            'driver' => $driver,
            'trips' => $paginatedTrips->items(),
            'pagination' => $paginatedTrips,
        ]);
    }

    public function verifyTrip($startId, $endId = null)
    {
        $startLog = $startId ? DriverLog::find($startId) : null;
        $endLog = $endId ? DriverLog::find($endId) : null;

        $startKm = isset($this->kmInputs[$startId]) && $this->kmInputs[$startId] !== '' ? floatval($this->kmInputs[$startId]) : null;
        $endKm = $endId && isset($this->kmInputs[$endId]) && $this->kmInputs[$endId] !== '' ? floatval($this->kmInputs[$endId]) : null;

        if ($startKm === null && $endKm === null) {
            $this->dispatch('new-notification', [
                'level' => 'error',
                'title' => 'Validation Error',
                'message' => 'Please enter at least one KM value to save!'
            ]);
            return;
        }

        if ($startLog && $startKm !== null) {
            $startLog->update(['km_reading' => $startKm]);
        }

        if ($endLog && $endKm !== null) {
            if ($startKm !== null && $endKm <= $startKm) {
                $this->dispatch('new-notification', [
                    'level' => 'error',
                    'title' => 'Validation Error',
                    'message' => 'End KM must be greater than Start KM!'
                ]);
                return;
            }
            $endLog->update(['km_reading' => $endKm]);
            
            if ($startKm !== null) {
                $distance = max(0, $endKm - $startKm);
                $endLog->update(['distance' => $distance]);
            }
        }

        $this->dispatch('new-notification', [
            'level' => 'success',
            'title' => 'Verified',
            'message' => 'KM readings updated successfully!'
        ]);
        
        $this->loadKmInputs(); // Reset inputs to latest saved state (blank if user wants it always blank, or keep as is)
        // Note: the user said inputs should BE blank, but after save they might want to see it?
        // If he wants them ALWAYS blank every time they load, loadKmInputs should overwrite with null.
    }

    public function toJSON()
    {
        return [];
    }
}
