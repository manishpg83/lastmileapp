<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\Attributes\On;

class NotificationDropdown extends Component
{
    public $unreadCount = 0;
    public $recentNotifications = [];
    public $lastKnownId = 0;

    public function mount()
    {
        $this->loadNotifications();
        $this->lastKnownId = Notification::latest()->first()?->id ?? 0;
    }

    #[On('notifications-updated')]
    public function loadNotifications()
    {
        $this->unreadCount = Notification::unread()->count();
        $this->recentNotifications = Notification::latest()->take(5)->get();
    }

    public function checkForNewNotifications()
    {
        $newNotifications = Notification::where('id', '>', $this->lastKnownId)
            ->latest()
            ->get();

        if ($newNotifications->count() > 0) {
            foreach ($newNotifications as $notification) {
                $this->dispatch('new-notification', [
                    'message' => $notification->message,
                    'level' => $notification->level,
                    'docket_number' => $notification->docket_number
                ]);
            }
            
            $this->lastKnownId = $newNotifications->first()->id;
            $this->loadNotifications();
        }
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
