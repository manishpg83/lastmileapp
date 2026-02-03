<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Notifications
    </h4>

    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Notification Hub</h5>
                    <small class="text-muted">You have {{ $unreadCount }} unread system alerts</small>
                </div>
                <button wire:click="markAllAsRead" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-check-double me-1"></i> Mark all as read
                </button>
            </div>
        </div>

        <div class="card-body mt-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <!-- Filters -->
                <div class="btn-group" role="group" aria-label="Notification filters">
                    <button type="button" class="btn btn-outline-secondary {{ $filter === 'all' ? 'active' : '' }}"
                        wire:click="setFilter('all')">All</button>
                    <button type="button" class="btn btn-outline-danger {{ $filter === 'error' ? 'active' : '' }}"
                        wire:click="setFilter('error')">Error</button>
                    <button type="button" class="btn btn-outline-warning {{ $filter === 'warning' ? 'active' : '' }}"
                        wire:click="setFilter('warning')">Warning</button>
                    <button type="button" class="btn btn-outline-success {{ $filter === 'success' ? 'active' : '' }}"
                        wire:click="setFilter('success')">Success</button>
                    <button type="button" class="btn btn-outline-info {{ $filter === 'info' ? 'active' : '' }}"
                        wire:click="setFilter('info')">Info</button>
                </div>

                <!-- Search -->
                <div class="input-group" style="max-width: 350px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bx bx-search text-muted"></i></span>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="form-control border-start-0 ps-2" placeholder="Search by docket number or message...">
                </div>
            </div>

            <!-- Notifications List -->
            <div class="list-group">
                @forelse($notifications as $notification)
                    <div wire:click="markAsRead({{ $notification->id }})"
                        class="list-group-item list-group-item-action d-flex align-items-center mb-3 rounded border border-start-4 border-start-{{ $notification->border_color }} shadow-sm p-3 {{ $notification->isUnread() ? 'bg-label-primary shadow-none border-opacity-50' : '' }}"
                        style="cursor: pointer;">

                        <!-- Icon -->
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-{{ $notification->border_color }}">
                                    <i class="bx {{ $notification->icon }} fs-4"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 text-uppercase text-{{ $notification->border_color }} fw-bold"
                                        style="font-size: 0.8rem; letter-spacing: 0.5px;">
                                        {{ $notification->level }}
                                    </h6>
                                    @if ($notification->isUnread())
                                        <span class="badge badge-dot bg-primary"></span>
                                    @endif
                                </div>
                                <small class="text-muted">{{ $notification->time_ago }}</small>
                            </div>
                            <p class="mb-0 {{ $notification->isUnread() ? 'fw-bold text-heading' : 'text-body' }}">
                                @if ($notification->docket_number)
                                    <span
                                        class="badge bg-label-secondary me-1">{{ $notification->docket_number }}</span>
                                @endif
                                {{ $notification->message }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bx bx-bell-off fs-1 text-muted mb-3"></i>
                        <h5 class="text-muted">No notifications found</h5>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
