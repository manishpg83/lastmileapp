<?php

namespace App\Livewire\Admin;

use App\Models\Delivery;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeliveriesExport;

class ShipmentTable extends Component

{
    use WithPagination;

    // Use bootstrap theme for pagination
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $shipments = Delivery::with('driver')->latest()->paginate(20);

        return view('livewire.admin.shipment-table', [
            'shipments' => $shipments
        ]);
    }

    public function export()
    {
        return Excel::download(new DeliveriesExport, 'deliveries.xlsx');
    }
}
