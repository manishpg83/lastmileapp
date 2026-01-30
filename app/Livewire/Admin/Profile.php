<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Account Settings')]
class Profile extends Component
{
    public string $name;

    public string $email;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
        ]);

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Account updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
