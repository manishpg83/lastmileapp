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

    public $dateFilter;

    public function mount($dateFilter = 'today')
    {
        $this->dateFilter = $dateFilter;
    }

    public function render()
    {
        $query = Delivery::with('driver')
            ->whereNotNull('driver_id');

        if ($this->dateFilter === 'today') {
            $query->whereDate('updated_at', today());
        } elseif ($this->dateFilter === 'yesterday') {
            $query->whereDate('updated_at', today()->subDay());
        } elseif ($this->dateFilter === 'this_week') {
            $query->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $query->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
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
