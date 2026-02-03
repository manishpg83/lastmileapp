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

    public function render()
    {
        $shipments = Delivery::with('driver')
            ->whereNotNull('driver_id')
            ->whereDate('assigned_at', today())
            ->latest()
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
