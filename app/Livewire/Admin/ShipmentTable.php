<?php

namespace App\Livewire\Admin;

use App\Models\Delivery;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeliveriesExport;
use App\Models\User;

class ShipmentTable extends Component

{
    use WithPagination;

    public $dateFilter = 'today';

    #[On('dateFilterUpdated')]
    public function updateDateFilter($filter)
    {
        $this->dateFilter = $filter;
        $this->resetPage();
    }

    public function render()
    {
        $query = Delivery::with('driver')
            ->whereNotNull('driver_id');

        if ($this->dateFilter === 'today') {
            $query->whereDate('assigned_at', today());
        } elseif ($this->dateFilter === 'yesterday') {
            $query->whereDate('assigned_at', today()->subDay());
        } elseif ($this->dateFilter === 'this_week') {
            $query->whereBetween('assigned_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $query->whereMonth('assigned_at', now()->month)->whereYear('assigned_at', now()->year);
        }

        $shipments = $query->latest()
            ->paginate(20);

        return view('livewire.admin.shipment-table', [
            'shipments' => $shipments
        ]);
    }

    public function export()
    {
        return Excel::download(new DeliveriesExport, 'deliveries.xlsx');
    }
}
