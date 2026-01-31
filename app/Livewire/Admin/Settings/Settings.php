<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Settings extends Component
{
    use WithFileUploads;

    // Profile Fields
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $role;
    public $language;
    public $avatar;
    public $current_avatar_url;

    // Notification Fields
    public $email_notifications = false;
    public $sms_alerts = false;
    public $delivery_confirmations = false;

    // Security Fields
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        
        // Split name into First/Last for the UI (simple split)
        $parts = explode(' ', $user->name, 2);
        $this->first_name = $parts[0] ?? '';
        $this->last_name = $parts[1] ?? '';
        
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->language = $user->language ?? 'en';
        $this->current_avatar_url = $user->profile_image_url;

        // Preferences
        $prefs = $user->preferences ?? [];
        $this->email_notifications = $prefs['email_notifications'] ?? true;
        $this->sms_alerts = $prefs['sms_alerts'] ?? false;
        $this->delivery_confirmations = $prefs['delivery_confirmations'] ?? true;
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024', // 1MB Max
        ]);
        
        $user = Auth::user();
        $path = $this->avatar->store('avatars', 'public');
        $user->profile_image = $path;
        $user->save();
        
        $this->current_avatar_url = asset('storage/' . $path);
        
        $this->dispatch('profile-updated');
    }

    public function saveProfile()
    {
        $user = Auth::user();

        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', Rule::unique('users')->ignore($user->id)],
            'language' => 'required|in:en,hi,es',
        ]);

        $user->update([
            'name' => trim($this->first_name . ' ' . $this->last_name),
            'email' => $this->email,
            'phone' => $this->phone,
            'language' => $this->language,
        ]);

        // Save preferences
        $user->preferences = [
            'email_notifications' => $this->email_notifications,
            'sms_alerts' => $this->sms_alerts,
            'delivery_confirmations' => $this->delivery_confirmations,
        ];
        $user->save();

        session()->flash('success', 'Settings updated successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('success', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings.settings');
    }
}
