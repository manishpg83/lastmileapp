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
    public function render()
    {
        $totalDockets = Delivery::count();
        $delivered = Delivery::where('status', 'delivered')->count();
        $undelivered = Delivery::where('status', 'undelivered')->count();
        
        // In Progress = Assigned, In Transit, or Pending (everything not final)
        // Or strictly 'in_transit'? The user said "In Progress". 
        // Based on the mock data "In Progress" corresponded to "PASS" or "Pending" statuses effectively.
        // Let's count everything that is NOT delivered, undelivered, or cancelled.
        $inProgress = Delivery::whereNotIn('status', ['delivered', 'undelivered', 'cancelled'])->count();

        return view('livewire.admin.dashboard', [
            'totalDockets' => $totalDockets,
            'delivered' => $delivered,
            'undelivered' => $undelivered,
            'inProgress' => $inProgress,
        ]);
    }
}
