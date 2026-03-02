<?php

namespace App\Exports;

use App\Models\Delivery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class MasterReportExport implements FromView
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = Delivery::query()->with(['driver', 'statusHistory']);

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('docket_number', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('pincode', 'like', '%' . $search . '%')
                  ->orWhere('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('company_name', 'like', '%' . $search . '%');
            });
        }

        if (!empty($this->filters['dateRange'])) {
            $dates = explode(' to ', $this->filters['dateRange']);
            if (count($dates) === 2) {
                $query->whereBetween('updated_at', [
                    $dates[0] . ' 00:00:00',
                    $dates[1] . ' 23:59:59'
                ]);
            } else {
                $query->whereDate('updated_at', $dates[0]);
            }
        }

        if (!empty($this->filters['selectedCustomers'])) {
            $query->whereIn('customer_name', $this->filters['selectedCustomers']);
        }

        if (!empty($this->filters['selectedCompanies'])) {
            $query->whereIn('company_name', $this->filters['selectedCompanies']);
        }

        if (!empty($this->filters['selectedDrivers'])) {
            $query->whereIn('driver_id', $this->filters['selectedDrivers']);
        }

        if (!empty($this->filters['selectedStatuses'])) {
            $query->whereIn('status', $this->filters['selectedStatuses']);
        }

        if (isset($this->filters['partnerStatus']) && $this->filters['partnerStatus'] !== '') {
            $query->where('synced_to_third_party', $this->filters['partnerStatus']);
        }

        if (!empty($this->filters['minPackets'])) {
            $query->where('package', '>=', $this->filters['minPackets']);
        }

        if (!empty($this->filters['maxPackets'])) {
            $query->where('package', '<=', $this->filters['maxPackets']);
        }

        return view('exports.master-report-pdf', [
            'deliveries' => $query->latest()->get()
        ]);
    }
}
