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
    
    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
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

        return view('livewire.admin.delivery.delivery-list', [
            'deliveries' => $query->latest()->paginate(10),
        ])->title('Deliveries List');
    }
}
