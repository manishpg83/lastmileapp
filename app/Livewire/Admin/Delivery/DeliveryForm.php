<?php

namespace App\Livewire\Admin\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\User;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DeliveryForm extends Component
{
    public ?Delivery $delivery = null;
    public $isEdit = false;

    // Form Fields
    public $docket_number;
    public $customer_name;
    public $company_name;
    public $address;
    public $pincode;
    public $phone;
    public $package;
    public $email;
    public $notes;
    public $driver_id;
    public $status;
    public $assigned_at;

    public function mount(Delivery $delivery = null)
    {
        if ($delivery && $delivery->exists) {
            $this->delivery = $delivery;
            $this->isEdit = true;
            $this->fill($this->delivery->toArray());
            $this->assigned_at = $this->delivery->assigned_at?->format('Y-m-d\TH:i');
        } else {
            $this->status = Delivery::STATUS_PENDING;
        }
    }

    protected function rules()
    {
        return [
            'docket_number' => 'required|string|unique:deliveries,docket_number,' . ($this->delivery->id ?? 'NULL'),
            'customer_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'pincode' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',
            'driver_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'assigned_at' => 'nullable',
            'package' => 'nullable',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->isEdit) {
            $data['created_at'] = now(); // Update timestamp on edit as requested
            if ($data['status'] === Delivery::STATUS_ASSIGNED && $this->delivery->status !== Delivery::STATUS_ASSIGNED) {
                $data['assigned_at'] = now();
            } elseif ($data['status'] !== Delivery::STATUS_ASSIGNED) {
                $data['driver_id'] = null;
                $data['assigned_at'] = null;
            }
            $this->delivery->update($data);
            session()->flash('message', 'Delivery updated successfully');
            session()->flash('messageType', 'success');
        } else {
            Delivery::create($data);
            session()->flash('message', 'Delivery created successfully');
            session()->flash('messageType', 'success');
        }

        return redirect()->route('deliveries.index');
    }

    public function render()
    {
        return view('livewire.admin.delivery.delivery-form', [
            'drivers' => User::drivers()->active()->get(),
            'statuses' => [
                Delivery::STATUS_PENDING => 'Pending',
                Delivery::STATUS_ASSIGNED => 'Assigned',
                Delivery::STATUS_DELIVERED => 'Delivered',
                Delivery::STATUS_UNDELIVERED => 'Undelivered',
            ],
        ])->title($this->isEdit ? 'Edit Delivery' : 'Add Delivery');
    }
}
