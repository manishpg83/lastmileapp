<?php

namespace App\Livewire\Admin;

use App\Models\Delivery;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public $dateFilter = 'today';
    protected $paginationTheme = 'bootstrap';
    public function updatedDateFilter()
    {
        $this->dispatch('dateFilterUpdated', $this->dateFilter);
    }

    public function render()
    {
        $query = Delivery::query();

        if ($this->dateFilter === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($this->dateFilter === 'yesterday') {
            $query->whereDate('created_at', today()->subDay());
        } elseif ($this->dateFilter === 'this_week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }

        $totalDockets = (clone $query)->count();
        $delivered = (clone $query)->where('status', 'delivered')->count();
        $undelivered = (clone $query)->where('status', 'undelivered')->count();
        
        // In Progress = Assigned or Pending (everything not final)
        $inProgress = (clone $query)->whereNotIn('status', ['delivered', 'undelivered'])->count();

        return view('livewire.admin.dashboard', [
            'totalDockets' => $totalDockets,
            'delivered' => $delivered,
            'undelivered' => $undelivered,
            'inProgress' => $inProgress,
            'dateFilter' => $this->dateFilter,
        ]);
    }
}
