<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class UserList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteDriver($id)
    {
        $user = User::findOrFail($id);

        if ($user->isSuperAdmin() || \Illuminate\Support\Str::contains(strtolower($user->name), 'superadmin') || \Illuminate\Support\Str::contains(strtolower($user->email), 'superadmin')) {
            session()->flash('error', 'Super Admin cannot be deleted.');
            return;
        }

        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }

        // Nullify driver reference in deliveries instead of deleting them
        \DB::table('deliveries')->where('driver_id', $user->id)->update(['driver_id' => null]);
        \DB::table('delivery_status_history')->where('changed_by', $user->id)->update(['changed_by' => null]);

        $user->forceDelete();
        session()->flash('success', 'Driver deleted permanently');
    }

    public function logoutDriver($id)
    {
        $user = User::findOrFail($id);

        // Revoke Sanctum tokens
        $user->tokens()->delete();

        // Rotate remember token
        $user->forceFill([
            'remember_token' => \Illuminate\Support\Str::random(60),
        ])->save();

        // Invalidate sessions
        if (config('session.driver') === 'database') {
            \Illuminate\Support\Facades\DB::table(config('session.table', 'sessions'))
                ->where('user_id', $user->id)
                ->delete();
        }

        session()->flash('success', 'User sessions revoked successfully');
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            // Search in all fields
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%')
                    ->orWhere('vehicle_number', 'like', '%'.$this->search.'%')
                    ->orWhere('license_number', 'like', '%'.$this->search.'%')
                    ->orWhere('role', 'like', '%'.$this->search.'%')
                    ->orWhere('status', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.admin.user.user-list', [
            'users' => $query->latest()->paginate(50),
        ]);
    }
}
