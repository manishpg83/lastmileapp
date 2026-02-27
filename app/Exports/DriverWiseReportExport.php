<?php

namespace App\Exports;

use App\Models\DriverLog;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;

class DriverWiseReportExport implements FromView
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $dateFrom = null;
        $dateTo = null;

        if (!empty($this->filters['dateRange'])) {
            $dates = explode(' to ', $this->filters['dateRange']);
            if (count($dates) === 2) {
                $dateFrom = Carbon::parse($dates[0]);
                $dateTo = Carbon::parse($dates[1]);
            } else {
                $dateFrom = Carbon::parse($dates[0]);
                $dateTo = Carbon::parse($dates[0]);
            }
        }

        $query = DriverLog::query()->with('driver');

        if (!empty($this->filters['selectedDrivers'])) {
            $query->whereIn('driver_id', $this->filters['selectedDrivers']);
        }

        if ($dateFrom && $dateTo) {
            $query->whereDate('created_at', '>=', $dateFrom)
                  ->whereDate('created_at', '<=', $dateTo);
        }

        $logs = $query->orderBy('created_at', 'asc')->orderBy('id', 'asc')->get();

        $groupedLogs = [];
        foreach ($logs as $log) {
            $dateString = Carbon::parse($log->created_at)->format('Y-m-d');
            $driverId = $log->driver_id;
            $key = $driverId . '_' . $dateString;

            if (!isset($groupedLogs[$key])) {
                $groupedLogs[$key] = [
                    'driver_id'   => $driverId,
                    'driver_name' => optional($log->driver)->name ?? 'Unknown',
                    'date'        => $dateString,
                    'logs'        => [],
                ];
            }
            $groupedLogs[$key]['logs'][] = $log;
        }

        $processedData = [];
        foreach ($groupedLogs as $key => $group) {
            $totalKm      = 0;
            $totalMinutes = 0;
            $currentStart = null;

            foreach ($group['logs'] as $log) {
                if ($log->action === 'start') {
                    $currentStart = $log;
                } elseif ($log->action === 'end') {
                    $distance = 0;
                    if ($currentStart) {
                        $startKm = $currentStart->km_reading;
                        $endKm   = $log->km_reading;

                        if ($startKm !== null && $endKm !== null) {
                            $distance = max(0, $endKm - $startKm);
                        } elseif ($log->distance !== null) {
                            $distance = max(0, $log->distance);
                        }

                        $diffMinutes   = Carbon::parse($currentStart->created_at)->diffInMinutes(Carbon::parse($log->created_at));
                        $totalMinutes += $diffMinutes;
                    }
                    $totalKm += $distance;
                    $currentStart = null;
                }
            }

            $hours = round($totalMinutes / 60, 2);
            $km    = round($totalKm, 2);

            if (!empty($this->filters['minHours']) && $hours < (float) $this->filters['minHours']) continue;
            if (!empty($this->filters['maxHours']) && $hours > (float) $this->filters['maxHours']) continue;
            if (!empty($this->filters['minKm'])    && $km   < (float) $this->filters['minKm'])    continue;
            if (!empty($this->filters['maxKm'])    && $km   > (float) $this->filters['maxKm'])    continue;

            $processedData[] = [
                'driver_name'     => $group['driver_name'],
                'date'            => $group['date'],
                'formatted_hours' => floor($totalMinutes / 60) . 'h ' . ($totalMinutes % 60) . 'm',
                'km'              => $km,
                'total_minutes'   => $totalMinutes,
                'total_km'        => $totalKm,      
            ];
        }

        $entries = collect($processedData);

        $grandTotalMinutes = $entries->sum('total_minutes');
        $grandTotalKm      = $entries->sum('total_km');

        $grandTotal = [
            'formatted_hours' => floor($grandTotalMinutes / 60) . 'h ' . ($grandTotalMinutes % 60) . 'm',
            'km'              => round($grandTotalKm, 2),
        ];

        return view('exports.driver-wise-report-pdf', [
            'entries'    => $entries,
            'grandTotal' => $grandTotal,
        ]);
    }
}