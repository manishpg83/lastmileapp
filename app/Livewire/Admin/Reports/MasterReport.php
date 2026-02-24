<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MasterReportExport;

#[Layout('layouts.app')]
class MasterReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filters
    public $dateRange = '';
    public $selectedCustomers = [];
    public $selectedCompanies = [];
    public $selectedDrivers = [];
    public $search = '';
    public $minPackets = '';
    public $maxPackets = '';
    public $partnerStatus = '';
    public $selectedStatuses = [];

    public function updating($propertyName)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['dateRange', 'selectedCustomers', 'selectedCompanies', 'selectedDrivers', 'search', 'minPackets', 'maxPackets', 'partnerStatus', 'selectedStatuses']);
        $this->resetPage();
    }

    public function export($format)
    {
        $filters = [
            'search' => $this->search,
            'dateRange' => $this->dateRange,
            'selectedCustomers' => $this->selectedCustomers,
            'selectedCompanies' => $this->selectedCompanies,
            'selectedDrivers' => $this->selectedDrivers,
            'selectedStatuses' => $this->selectedStatuses,
            'partnerStatus' => $this->partnerStatus,
            'minPackets' => $this->minPackets,
            'maxPackets' => $this->maxPackets,
        ];

        $export = new MasterReportExport($filters);
        $fileName = 'Master_Report_' . now()->format('Y-m-d_H-i-s');

        switch ($format) {
            case 'excel':
                return Excel::download($export, $fileName . '.xlsx');
            case 'csv':
                return Excel::download($export, $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'pdf':
                $html = view('exports.master-report-pdf', ['deliveries' => $export->view()->getData()['deliveries']])->render();
                $dompdf = new \Dompdf\Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                return response()->streamDownload(function () use ($dompdf) {
                    echo $dompdf->output();
                }, $fileName . '.pdf');
        }
    }

    public function render()
    {
        $query = Delivery::query()->with(['driver', 'statusHistory', 'latestStatusUpdate']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('docket_number', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhere('pincode', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                  ->orWhere('company_name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) === 2) {
                $query->whereBetween('created_at', [
                    $dates[0] . ' 00:00:00',
                    $dates[1] . ' 23:59:59'
                ]);
            } else {
                $query->whereDate('created_at', $dates[0]);
            }
        }

        if (!empty($this->selectedCustomers)) {
            $query->whereIn('customer_name', $this->selectedCustomers);
        }

        if (!empty($this->selectedCompanies)) {
            $query->whereIn('company_name', $this->selectedCompanies);
        }

        if (!empty($this->selectedDrivers)) {
            $query->whereIn('driver_id', $this->selectedDrivers);
        }

        if (!empty($this->selectedStatuses)) {
            $query->whereIn('status', $this->selectedStatuses);
        }

        if ($this->partnerStatus !== '') {
            $query->where('synced_to_third_party', $this->partnerStatus);
        }

        if ($this->minPackets !== '') {
            $query->where('package', '>=', $this->minPackets);
        }

        if ($this->maxPackets !== '') {
            $query->where('package', '<=', $this->maxPackets);
        }

        $deliveries = $query->latest()->paginate(50);
        
        // Optimizing filter queries by limiting results or using a more efficient approach
        $customers = Delivery::select('customer_name')
            ->whereNotNull('customer_name')
            ->groupBy('customer_name')
            ->orderBy('customer_name')
            ->pluck('customer_name')
            ->toArray();

        $companies = Delivery::select('company_name')
            ->whereNotNull('company_name')
            ->groupBy('company_name')
            ->orderBy('company_name')
            ->pluck('company_name')
            ->toArray();

        $drivers = User::drivers()->get();

        return view('livewire.admin.reports.master-report', [
            'deliveries' => $deliveries,
            'customers' => $customers,
            'companies' => $companies,
            'drivers' => $drivers,
        ])->title('Master Report');
    }
    public function toJSON()
    {
        return [];
    }
}
