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
    public $bulkStatus = '';
    public $bulkGatiStatus = '';

    public $dateRange = '';
    
    public $perPage = 25;
    
    protected $queryString = [
        'search', 
        'dateRange',
        'perPage',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedDateRange()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetDateRange()
    {
        $this->dateRange = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // Get IDs from the current query to match what the user sees
            $query = Delivery::query();
            if ($this->search) $query->search($this->search);
            if ($this->dateRange) {
                $dates = explode(' to ', $this->dateRange);
                if (count($dates) === 2) {
                    $query->whereBetween('assigned_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
                } else {
                    $query->whereDate('assigned_at', $dates[0]);
                }
            }
            
            $this->selectedDeliveries = $query->latest()
                ->paginate($this->perPage) // Match pagination size
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
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
    public function bulkDelete()
    {
        if (empty($this->selectedDeliveries)) {
            session()->flash('message', 'Please select at least one delivery');
            session()->flash('messageType', 'warning');
            return;
        }

        $deliveries = Delivery::whereIn('id', $this->selectedDeliveries)->get();

        foreach ($deliveries as $delivery) {
            // Cleanup related data
            \App\Models\DeliveryTimer::where('delivery_id', $delivery->id)->delete();
            \App\Models\Notification::where('delivery_id', $delivery->id)->delete();
            
            // Delete images
            if ($delivery->pod_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('pod/' . $delivery->pod_image);
            }
            if ($delivery->signature_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('signatures/' . $delivery->signature_image);
            }

            $delivery->forceDelete();
        }

        $this->selectedDeliveries = [];
        $this->selectAll = false;

        session()->flash('message', 'Selected deliveries and their related data deleted permanently');
        session()->flash('messageType', 'success');
    }

    public function bulkUpdateStatus()
    {
        if (empty($this->selectedDeliveries)) {
            session()->flash('message', 'Please select at least one delivery');
            session()->flash('messageType', 'warning');
            return;
        }

        if (!$this->bulkStatus) {
            session()->flash('message', 'Please select a status');
            session()->flash('messageType', 'warning');
            return;
        }

        $deliveries = Delivery::whereIn('id', $this->selectedDeliveries)->get();

        foreach ($deliveries as $delivery) {
            $delivery->updateStatus($this->bulkStatus, auth()->id(), 'Bulk status update');
        }

        $this->selectedDeliveries = [];
        $this->selectAll = false;
        $this->bulkStatus = '';

        session()->flash('message', 'Status updated successfully for selected deliveries');
        session()->flash('messageType', 'success');
    }

    public function bulkUpdateGatiStatus()
    {
        if (empty($this->selectedDeliveries)) {
            session()->flash('message', 'Please select at least one delivery');
            session()->flash('messageType', 'warning');
            return;
        }

        if ($this->bulkGatiStatus === '') {
            session()->flash('message', 'Please select a Gati status');
            session()->flash('messageType', 'warning');
            return;
        }

        Delivery::whereIn('id', $this->selectedDeliveries)
            ->update(['synced_to_third_party' => (bool) $this->bulkGatiStatus]);

        $this->selectedDeliveries = [];
        $this->selectAll = false;
        $this->bulkGatiStatus = '';

        session()->flash('message', 'Gati status updated successfully for selected deliveries');
        session()->flash('messageType', 'success');
    }

    public function delete($id)
    {
        $delivery = Delivery::findOrFail($id);
        
        // Cleanup related data
        \App\Models\DeliveryTimer::where('delivery_id', $delivery->id)->delete();
        \App\Models\Notification::where('delivery_id', $delivery->id)->delete();
        
        // Delete images
        if ($delivery->pod_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('pod/' . $delivery->pod_image);
        }
        if ($delivery->signature_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('signatures/' . $delivery->signature_image);
        }

        $delivery->forceDelete();
        
        session()->flash('message', 'Delivery and its related data deleted permanently');
        session()->flash('messageType', 'success');
    }

    public function toggleGatiStatus($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->synced_to_third_party = !$delivery->synced_to_third_party;
        $delivery->save();

        session()->flash('message', 'Gati status updated successfully');
        session()->flash('messageType', 'success');
    }

    public function render()
    {
        $query = Delivery::query()->with('driver');

        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) === 2) {
                $query->whereBetween('assigned_at', [
                    $dates[0] . ' 00:00:00',
                    $dates[1] . ' 23:59:59'
                ]);
            } else {
                $query->whereDate('assigned_at', $dates[0]);
            }
        }

        $drivers = \App\Models\User::drivers()->active()->get();

        return view('livewire.admin.delivery.delivery-list', [
            'deliveries' => $query->latest()->paginate($this->perPage),
            'drivers' => $drivers
        ])->title('Deliveries List');
    }
}
