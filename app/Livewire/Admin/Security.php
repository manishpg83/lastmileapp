<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Security')]
class Security extends Component
{
    public string $currentPassword = '';

    public string $newPassword = '';

    public string $confirmPassword = '';

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => ['required', 'current_password'],
            'newPassword' => ['required', 'min:8'],
            'confirmPassword' => ['same:newPassword'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->reset();

        session()->flash('success', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.security');
    }
}
