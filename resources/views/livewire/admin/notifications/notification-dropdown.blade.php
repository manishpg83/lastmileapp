<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1"
    wire:poll.15s="checkForNewNotifications">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-expanded="false">
        <i class="icon-base bx bx-bell icon-md"></i>
        @if ($unreadCount > 0)
            <span class="badge bg-danger rounded-pill badge-notifications">{{ $unreadCount }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Notification</h5>
                <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Mark all as read" wire:click.prevent="markAllAsRead">
                    <i class="bx fs-4 bx-envelope-open"></i>
                </a>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush">
                @forelse($recentNotifications as $notification)
                    <li class="list-group-item list-group-item-action dropdown-notifications-item {{ $notification->isUnread() ? 'bg-label-primary' : '' }}"
                        wire:click="markAsRead({{ $notification->id }})" style="cursor: pointer;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <span
                                        class="avatar-initial rounded-circle bg-label-{{ $notification->border_color }}">
                                        <i class="bx {{ $notification->icon }}"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 {{ $notification->isUnread() ? 'fw-bold' : '' }}">
                                    {{ $notification->message }}</h6>
                                <p class="mb-0 small text-muted">{{ $notification->created_at->diffForHumans() }}</p>
                                <small
                                    class="text-muted text-uppercase text-{{ $notification->border_color }}">{{ $notification->level }}</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                @if ($notification->isUnread())
                                    <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                            class="badge badge-dot"></span></a>
                                @endif
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                        class="bx bx-x"></span></a>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex justify-content-center align-items-center p-3">
                            <span class="text-muted">No recently found</span>
                        </div>
                    </li>
                @endforelse
            </ul>
        </li>
        <li class="dropdown-menu-footer border-top">
            <a href="{{ route('notifications.index') }}" class="dropdown-item d-flex justify-content-center p-3">
                View all notifications
            </a>
        </li>
    </ul>
</li>
