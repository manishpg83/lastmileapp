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

    protected $queryString = [
        'dateFilter' => ['except' => 'today'],
    ];

    public function render()
    {
        $query = Delivery::query();

        // Date Filter Logic
        if ($this->dateFilter === 'today') {
            $query->whereDate('updated_at', today());
        } elseif ($this->dateFilter === 'yesterday') {
            $query->whereDate('updated_at', today()->subDay());
        } elseif ($this->dateFilter === 'this_week') {
            $query->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateFilter === 'this_month') {
            $query->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
        }
        
        // Clone query for counts to avoid side effects if we accumulated where clauses
        // But here we just re-apply the filter or use the query builder properly.
        // Actually, the previous code used separate queries: Delivery::count(), Delivery::where(...)->count().
        // I need to apply the date filter to EACH count count.
        
        $totalDockets = (clone $query)->count();
        $delivered = (clone $query)->where('status', 'delivered')->count();
        $undelivered = (clone $query)->where('status', 'undelivered')->count();
        $inProgress = (clone $query)->whereNotIn('status', ['delivered', 'undelivered', 'cancelled'])->count();

        return view('livewire.admin.dashboard', [
            'totalDockets' => $totalDockets,
            'delivered' => $delivered,
            'undelivered' => $undelivered,
            'inProgress' => $inProgress,
            'dateFilter' => $this->dateFilter,
        ]);
    }
}
