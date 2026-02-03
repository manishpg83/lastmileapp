<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Notification;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class NotificationHub extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $filter = 'all'; // all, error, warning, success, info
    public $search = '';

    #[On('notifications-updated')]
    public function refreshNotifications()
    {
        // Simply refreshing the component
    }

    protected $queryString = [
        'filter' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification && $notification->isUnread()) {
            $notification->markAsRead();
            $this->dispatch('notifications-updated');
        }
    }

    public function markAllAsRead()
    {
        Notification::unread()->update(['read_at' => now()]);
        $this->dispatch('notifications-updated');
    }

    public function render()
    {
        $query = Notification::query()->latest();

        // Apply Level Filter
        if ($this->filter !== 'all') {
            $query->where('level', $this->filter);
        }

        // Apply Search
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('message', 'like', '%' . $this->search . '%')
                  ->orWhere('docket_number', 'like', '%' . $this->search . '%');
            });
        }

        $notifications = $query->paginate(2);
        $unreadCount = Notification::unread()->count();

        return view('livewire.admin.notifications.notification-hub', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }
}
