<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\Attributes\On;

class NotificationDropdown extends Component
{
    public $unreadCount = 0;
    public $recentNotifications = [];

    public function mount()
    {
        $this->loadNotifications();
    }

    #[On('notifications-updated')]
    public function loadNotifications()
    {
        $this->unreadCount = Notification::unread()->count();
        $this->recentNotifications = Notification::latest()->take(5)->get();
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification && $notification->isUnread()) {
            $notification->markAsRead();
            $this->loadNotifications();
            $this->dispatch('notifications-updated');
        }
    }

    public function markAllAsRead()
    {
        Notification::unread()->update(['read_at' => now()]);
        $this->loadNotifications();
        $this->dispatch('notifications-updated');
    }

    public function render()
    {
        return view('livewire.admin.notifications.notification-dropdown');
    }
}
