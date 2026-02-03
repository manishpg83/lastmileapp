<?php

namespace App\Livewire\Admin\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class DeliveryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $selectedDeliveries = [];
    public $selectAll = false;
    public $bulkDriverId = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDeliveries = Delivery::latest()->take(20)->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedDeliveries = [];
        }
    }

    public function assignDriver()
    {
        if (empty($this->selectedDeliveries)) {
            session()->flash('message', 'Please select at least one delivery');
            session()->flash('messageType', 'warning');
            return;
        }

        if (!$this->bulkDriverId) {
            session()->flash('message', 'Please select a driver');
            session()->flash('messageType', 'warning');
            return;
        }

        $deliveries = Delivery::whereIn('id', $this->selectedDeliveries)->get();
        
        foreach ($deliveries as $delivery) {
            $delivery->updateStatus(Delivery::STATUS_ASSIGNED, auth()->id(), 'Bulk assigned to driver');
            $delivery->update(['driver_id' => $this->bulkDriverId]);
        }

        $this->selectedDeliveries = [];
        $this->selectAll = false;
        $this->bulkDriverId = '';

        session()->flash('message', 'Driver assigned successfully to selected deliveries');
        session()->flash('messageType', 'success');
    }

    public function assignSingleDriver($shipmentId, $driverId)
    {
        if (!$driverId) return;

        $delivery = Delivery::find($shipmentId);
        if ($delivery) {
            $delivery->updateStatus(Delivery::STATUS_ASSIGNED, auth()->id(), 'Inline assigned to driver');
            $delivery->update(['driver_id' => $driverId]);

            session()->flash('message', 'Driver assigned successfully');
            session()->flash('messageType', 'success');
        }
    }
    public function delete($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();
        
        session()->flash('message', 'Delivery deleted successfully');
        session()->flash('messageType', 'success');
    }

    public function render()
    {
        $query = Delivery::query()->with('driver');

        if ($this->search) {
            $query->search($this->search);
        }

        $drivers = \App\Models\User::drivers()->active()->get();

        return view('livewire.admin.delivery.delivery-list', [
            'deliveries' => $query->latest()->paginate(10),
            'drivers' => $drivers
        ])->title('Deliveries List');
    }
}
