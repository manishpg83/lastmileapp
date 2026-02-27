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
    public $perPage = 25;

    protected $queryString = [
        'search',
        'dateRange',
        'perPage'
    ];

    public function mount()
    {
        $this->dateRange = now()->subDays(30)->format('Y-m-d') . ' to ' . now()->format('Y-m-d');
    }

    public function updating($propertyName)
    {
        $this->resetPage();
    }

    public function updatingPerPage()
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
                $dateFrom = Carbon::parse($dates[0])->startOfDay();
                $dateTo   = Carbon::parse($dates[1])->endOfDay();
            } else {
                $dateFrom = Carbon::parse($dates[0])->startOfDay();
                $dateTo   = Carbon::parse($dates[0])->endOfDay();
            }
        }

        $query = DB::table('driver_logs as end_logs')
            ->join('driver_logs as start_logs', function ($join) {
                $join->on('end_logs.driver_id', '=', 'start_logs.driver_id')
                    ->whereColumn('start_logs.created_at', '<', 'end_logs.created_at')
                    ->where('start_logs.action', '=', 'start');
            })
            ->join('users', 'end_logs.driver_id', '=', 'users.id')
            ->where('end_logs.action', '=', 'end')
            ->select(
                'end_logs.driver_id',
                'users.name as driver_name',
                DB::raw('DATE(end_logs.created_at) as log_date'),
                DB::raw('SUM(GREATEST(end_logs.km_reading - start_logs.km_reading, 0)) as total_km'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, start_logs.created_at, end_logs.created_at)) as total_minutes')
            )
            ->groupBy('end_logs.driver_id', 'log_date', 'users.name')
            ->orderBy('log_date', 'desc');

        if (!empty($this->selectedDrivers)) {
            $query->whereIn('end_logs.driver_id', $this->selectedDrivers);
        }

        if ($this->search) {
            $query->where('users.name', 'like', '%' . $this->search . '%');
        }

        if ($dateFrom && $dateTo) {
            $query->whereBetween('end_logs.created_at', [$dateFrom, $dateTo]);
        }

        if ($this->minKm !== '') {
            $query->havingRaw('total_km >= ?', [(float) $this->minKm]);
        }

        if ($this->maxKm !== '') {
            $query->havingRaw('total_km <= ?', [(float) $this->maxKm]);
        }

        if ($this->minHours !== '') {
            $query->havingRaw('(total_minutes / 60) >= ?', [(float) $this->minHours]);
        }

        if ($this->maxHours !== '') {
            $query->havingRaw('(total_minutes / 60) <= ?', [(float) $this->maxHours]);
        }

        $reportData = $query->paginate($this->perPage);

        // Format values for blade
        $reportData->getCollection()->transform(function ($row) {
            $row->hours = round($row->total_minutes / 60, 2);
            $row->formatted_hours = floor($row->total_minutes / 60) . 'h ' . ($row->total_minutes % 60) . 'm';
            $row->km = round($row->total_km, 2);
            return $row;
        });

        $totalMinutes = $reportData->sum('total_minutes');
        $totalKm = $reportData->sum('total_km');

        $totals = [
            'formatted_hours' => floor($totalMinutes / 60) . 'h ' . ($totalMinutes % 60) . 'm',
            'hours' => round($totalMinutes / 60, 2),
            'km' => round($totalKm, 2),
        ];

        return view('livewire.admin.reports.driver-wise-report', [
            'reportData' => $reportData,
            'driversList' => \App\Models\User::drivers()->get(),
            'totals' => $totals,
        ])->title('Driver Wise Report');
    }

    public function toJSON()
    {
        return [];
    }
}
