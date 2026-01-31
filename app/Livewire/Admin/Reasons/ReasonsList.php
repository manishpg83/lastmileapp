<?php

namespace App\Livewire\Admin\Reasons;

use App\Models\UndeliveredReason;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ReasonsList extends Component
{
    public $newReason = '';

    protected $rules = [
        'newReason' => 'required|string|max:255',
    ];

    public function addReason()
    {
        $this->validate();

        $maxSortOrder = UndeliveredReason::max('sort_order') ?? 0;

        UndeliveredReason::create([
            'title' => $this->newReason,
            'status' => UndeliveredReason::STATUS_ACTIVE,
            'sort_order' => $maxSortOrder + 1,
        ]);

        $this->newReason = '';
        $this->dispatch('reason-added');
    }

    public function deleteReason($id)
    {
        $reason = UndeliveredReason::find($id);
        if ($reason) {
            $reason->delete();
        }
    }

    public function render()
    {
        $reasons = UndeliveredReason::ordered()->get();
        return view('livewire.admin.reasons.reasons-list', [
            'reasons' => $reasons,
        ]);
    }
}
