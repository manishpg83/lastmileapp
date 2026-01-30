<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class UserForm extends Component
{
    use WithFileUploads;

    public ?User $user = null;

    public $name, $email, $phone;
    public $role = 'driver';
    public $status = 'active';
    public $vehicle_number, $license_number;
    public $password;
    public $profile_image;
    public $existing_image;

    public function mount(User $user = null)
    {
        if ($user && $user->exists) {
            $this->user = $user;
            $this->fill($user->only([
                'name', 'email', 'phone', 'role', 'status',
                'vehicle_number', 'license_number'
            ]));
            $this->existing_image = $user->profile_image;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . optional($this->user)->id,
            'phone' => 'nullable',
            'role' => 'required',
            'status' => 'required',
            'vehicle_number' => 'nullable',
            'license_number' => 'nullable',
            'password' => $this->user ? 'nullable|min:6' : 'required|min:6',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // Remove password from data if it's empty during update
        if ($this->user && empty($this->password)) {
            unset($data['password']);
        } elseif ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        // Handle profile image upload
        if ($this->profile_image) {
            // Delete old image if exists
            if ($this->user && $this->user->profile_image) {
                Storage::disk('public')->delete($this->user->profile_image);
            }
            
            $data['profile_image'] = $this->profile_image->store('profiles', 'public');
        }

        // Update or create user
        if ($this->user) {
            $this->user->update($data);
        } else {
            User::create($data);
        }

        return redirect()->route('users.index')
            ->with('success', 'User saved successfully');
    }

    public function render()
    {
        return view('livewire.admin.user.user-form');
    }
}