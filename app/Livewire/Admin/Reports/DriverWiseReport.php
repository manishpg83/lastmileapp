<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriverLog;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DriverWiseReportExport;

#[Layout('layouts.app')]
class DriverWiseReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $dateRange = '';
    public $selectedDrivers = [];
    public $search = '';
    public $minHours = '';
    public $maxHours = '';
    public $minKm = '';
    public $maxKm = '';

    public function mount()
    {
        $this->dateRange = now()->subDays(30)->format('Y-m-d') . ' to ' . now()->format('Y-m-d');
    }

    public function updating($propertyName)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['selectedDrivers', 'search', 'minHours', 'maxHours', 'minKm', 'maxKm']);
        $this->dateRange = now()->subDays(30)->format('Y-m-d') . ' to ' . now()->format('Y-m-d');
        $this->resetPage();
    }

    public $selectedTrips = [];
    public $selectedDriverName = '';
    public $selectedDate = '';

    public function showActivity($driverId, $date)
    {
        $logs = DriverLog::where('driver_id', $driverId)
            ->whereDate('created_at', $date)
            ->with('driver')
            ->orderBy('created_at', 'asc')
            ->get();

        if ($logs->isNotEmpty()) {
            $trips = [];
            $currentStart = null;

            foreach ($logs as $log) {
                if ($log->action === 'start') {
                    if ($currentStart) {
                        $trips[] = [
                            'start_time' => $currentStart->created_at,
                            'end_time'   => null,
                            'start_pic'  => $currentStart->image,
                            'end_pic'    => null,
                            'distance'   => 0,
                            'duration'   => '-',
                        ];
                    }
                    $currentStart = $log;
                } elseif ($log->action === 'end') {
                    $distance = 0;
                    $duration = '-';

                    if ($currentStart) {
                        $startKm = $currentStart->km_reading;
                        $endKm   = $log->km_reading;

                        if ($startKm !== null && $endKm !== null) {
                            $distance = max(0, $endKm - $startKm);
                        } elseif ($log->distance !== null) {
                            $distance = max(0, $log->distance);
                        }

                        $diffMinutes = Carbon::parse($currentStart->created_at)->diffInMinutes(Carbon::parse($log->created_at));
                        $duration = floor($diffMinutes / 60) . 'h ' . ($diffMinutes % 60) . 'm';
                    }

                    $trips[] = [
                        'start_time' => $currentStart ? $currentStart->created_at : null,
                        'end_time'   => $log->created_at,
                        'start_pic'  => $currentStart ? $currentStart->image : null,
                        'end_pic'    => $log->image,
                        'distance'   => round($distance, 2),
                        'duration'   => $duration,
                    ];
                    $currentStart = null;
                }
            }

            if ($currentStart) {
                $trips[] = [
                    'start_time' => $currentStart->created_at,
                    'end_time'   => null,
                    'start_pic'  => $currentStart->image,
                    'end_pic'    => null,
                    'distance'   => 0,
                    'duration'   => '-',
                ];
            }

            $this->selectedTrips = array_reverse($trips);
            $this->selectedDriverName = $logs->first()->driver->name ?? 'Unknown';
            $this->selectedDate = $date;
            $this->dispatch('show-activity-modal');
        }
    }

    public function export($format)
    {
        $filters = [
            'dateRange' => $this->dateRange,
            'selectedDrivers' => $this->selectedDrivers,
            'minHours' => $this->minHours,
            'maxHours' => $this->maxHours,
            'minKm' => $this->minKm,
            'maxKm' => $this->maxKm,
        ];

        $export = new DriverWiseReportExport($filters);
        $fileName = 'Driver_Wise_Report_' . now()->format('Y-m-d_H-i-s');

        switch ($format) {
            case 'excel':
                return Excel::download($export, $fileName . '.xlsx');
            case 'csv':
                return Excel::download($export, $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'pdf':
                $html = view('exports.driver-wise-report-pdf', ['entries' => $export->view()->getData()['entries']])->render();
                $dompdf = new \Dompdf\Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                return response()->streamDownload(function () use ($dompdf) {
                    echo $dompdf->output();
                }, $fileName . '.pdf');
        }
    }

    public function render()
    {
        $dateFrom = null;
        $dateTo = null;

        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) === 2) {
                $dateFrom = Carbon::parse($dates[0]);
                $dateTo = Carbon::parse($dates[1]);
            } else {
                $dateFrom = Carbon::parse($dates[0]);
                $dateTo = Carbon::parse($dates[0]);
            }
        }

        $query = DriverLog::query();
        
        if (!empty($this->selectedDrivers)) {
            $query->whereIn('driver_id', $this->selectedDrivers);
        }

        if ($this->search) {
            $query->whereHas('driver', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($dateFrom && $dateTo) {
            $query->whereDate('created_at', '>=', $dateFrom)
                  ->whereDate('created_at', '<=', $dateTo);
        }

        $paginatedGroups = $query->select('driver_id', DB::raw('DATE(created_at) as log_date'))
            ->groupBy('driver_id', 'log_date')
            ->orderBy('log_date', 'desc')
            ->paginate(50);

        $processedData = [];

        foreach ($paginatedGroups as $group) {
            $logs = DriverLog::where('driver_id', $group->driver_id)
                ->whereDate('created_at', $group->log_date)
                ->with('driver')
                ->orderBy('created_at', 'asc')
                ->get();

            $totalKm = 0;
            $totalMinutes = 0;

            foreach ($logs as $log) {
                if ($log->action === 'end') {
                    if (isset($lastStart) && $lastStart->driver_id == $log->driver_id) {
                         $startKm = $lastStart->km_reading;
                         $endKm = $log->km_reading;
                         if ($startKm !== null && $endKm !== null) {
                             $totalKm += max(0, $endKm - $startKm);
                         }
                         $totalMinutes += Carbon::parse($lastStart->created_at)->diffInMinutes(Carbon::parse($log->created_at));
                         unset($lastStart);
                    }
                } elseif ($log->action === 'start') {
                    $lastStart = $log;
                }
            }

            $hours = round($totalMinutes / 60, 2);
            
            $processedData[] = [
                'driver_id'       => $group->driver_id,
                'driver_name'     => $logs->first()->driver->name ?? 'Unknown',
                'date'            => $group->log_date,
                'total_km'        => $totalKm,
                'total_minutes'   => $totalMinutes,
                'hours'           => $hours,
                'formatted_hours' => floor($totalMinutes / 60) . 'h ' . ($totalMinutes % 60) . 'm',
                'km'              => round($totalKm, 2),
            ];
        }

        $filteredData = collect($processedData)->filter(function ($item) {
            if ($this->minHours !== '' && $item['hours'] < (float)$this->minHours) return false;
            if ($this->maxHours !== '' && $item['hours'] > (float)$this->maxHours) return false;
            if ($this->minKm !== '' && $item['km'] < (float)$this->minKm) return false;
            if ($this->maxKm !== '' && $item['km'] > (float)$this->maxKm) return false;
            return true;
        });

        return view('livewire.admin.reports.driver-wise-report', [
            'reportData' => $paginatedGroups->setCollection($filteredData),
            'driversList' => User::drivers()->get()
        ])->title('Driver Wise Report');
    }

    public function toJSON()
    {
        return [];
    }
}
