<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h4 class="mb-0">
            <span class="text-muted fw-light">Dashboard /</span> Notifications
        </h4>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h5 class="mb-1 fw-bold">Notification Hub</h5>
                    <p class="text-muted mb-0 small">You have <strong>{{ $unreadCount }}</strong> unread system alerts
                    </p>
                </div>
                <button wire:click="markAllAsRead" class="btn btn-primary btn-sm px-3 shadow-none">
                    <i class="bx bx-check-double me-1"></i> Mark all as read
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Filter & Search Bar -->
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-12 col-lg-7">
                    <div class="nav-align-top">
                        {{--<ul class="nav nav-pills flex-nowrap overflow-auto pb-2 gap-2 no-scrollbar" role="tablist"
                            style="scrollbar-width: none;">
                            <li class="nav-item">
                                <button type="button"
                                    class="btn btn-sm btn-filter {{ $filter === 'all' ? 'active btn-primary' : 'btn-label-primary' }} text-nowrap"
                                    wire:click="setFilter('all')">All</button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                    class="btn btn-sm btn-filter {{ $filter === 'error' ? 'active btn-danger' : 'btn-label-danger' }} text-nowrap"
                                    wire:click="setFilter('error')">Error</button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                    class="btn btn-sm btn-filter {{ $filter === 'warning' ? 'active btn-warning' : 'btn-label-warning' }} text-nowrap"
                                    wire:click="setFilter('warning')">Warning</button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                    class="btn btn-sm btn-filter {{ $filter === 'success' ? 'active btn-success' : 'btn-label-success' }} text-nowrap"
                                    wire:click="setFilter('success')">Success</button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                    class="btn btn-sm btn-filter {{ $filter === 'info' ? 'active btn-info' : 'btn-label-info' }} text-nowrap"
                                    wire:click="setFilter('info')">Info</button>
                            </li>
                        </ul>--}}
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="input-group input-group-merge shadow-none border rounded">
                        <span class="input-group-text border-0 bg-transparent"><i
                                class="bx bx-search fs-4 text-muted"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control border-0 ps-1"
                            placeholder="Search notifications...">
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="list-group list-group-flush gap-3 mt-2">
                @forelse($notifications as $notification)
                    <div wire:click="markAsRead({{ $notification->id }})"
                        class="list-group-item list-group-item-action border rounded-3 p-3 transition-all notification-item {{ $notification->isUnread() ? 'unread-notification' : 'bg-white' }}"
                        style="cursor: pointer;">

                        <div class="d-flex align-items-start">
                            <!-- Icon -->
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-md notification-avatar">
                                    <span
                                        class="avatar-initial rounded-circle bg-{{ $notification->border_color }} shadow-sm">
                                        <i class="bx {{ $notification->icon }} fs-3"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    {{--<div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge bg-label-{{ $notification->border_color }} text-uppercase fw-bold label-badge"
                                            style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                            {{ $notification->level }}
                                        </span>
                                        @if ($notification->isUnread())
                                            <span class="badge badge-dot bg-primary pulse-animation"></span>
                                        @endif
                                    </div>--}}
                                    <small class="text-muted fw-medium">{{ $notification->time_ago }}</small>
                                </div>
                                <h6 class="mb-1 {{ $notification->isUnread() ? 'fw-bold text-dark' : 'text-body' }}">
                                    @if ($notification->docket_number)
                                        <span class="fw-bold text-primary">#{{ $notification->docket_number }}</span>
                                    @endif
                                    {{ $notification->message }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-bell-off fs-1 text-light"></i>
                        </div>
                        <h5 class="text-muted">No notifications found</h5>
                        <p class="text-muted small">Try adjusting your filters or search query</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>

    <style>
        /* Custom robust styles to ensure design parity */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .btn-label-primary {
            background-color: #e7e7ff !important;
            color: #696cff !important;
            border-color: transparent !important;
        }

        .btn-label-danger {
            background-color: #ffe5e5 !important;
            color: #ff3e1d !important;
            border-color: transparent !important;
        }

        .btn-label-warning {
            background-color: #fff2e2 !important;
            color: #ffab00 !important;
            border-color: transparent !important;
        }

        .btn-label-success {
            background-color: #e8fadf !important;
            color: #71dd37 !important;
            border-color: transparent !important;
        }

        .btn-label-info {
            background-color: #d7f5fc !important;
            color: #03c3ec !important;
            border-color: transparent !important;
        }

        .bg-label-primary {
            background-color: #e7e7ff !important;
            color: #696cff !important;
        }

        .bg-label-danger {
            background-color: #ffe5e5 !important;
            color: #ff3e1d !important;
        }

        .bg-label-warning {
            background-color: #fff2e2 !important;
            color: #ffab00 !important;
        }

        .bg-label-success {
            background-color: #e8fadf !important;
            color: #71dd37 !important;
        }

        .bg-label-info {
            background-color: #d7f5fc !important;
            color: #03c3ec !important;
        }

        .notification-item {
            transition: all 0.2s ease-in-out;
            border: 1px solid #ebedef !important;
        }

        .notification-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
            z-index: 2;
            border-color: #696cff !important;
        }

        .unread-notification {
            background-color: #f5f5ff !important;
            border-left: 4px solid #696cff !important;
        }

        .pulse-animation {
            width: 8px;
            height: 8px;
            box-shadow: 0 0 0 0 rgba(105, 108, 255, 0.7);
            animation: pulse 2s infinite;
            border-radius: 50%;
            display: inline-block;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(105, 108, 255, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(105, 108, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(105, 108, 255, 0);
            }
        }

        .notification-avatar .avatar-initial {
            background-image: linear-gradient(310deg, rgba(105, 108, 255, 0.8), #696cff);
        }

        .bg-danger .avatar-initial {
            background-image: linear-gradient(310deg, #ff6b4d, #ff3e1d);
        }

        .bg-warning .avatar-initial {
            background-image: linear-gradient(310deg, #ffc107, #ffab00);
        }

        .bg-success .avatar-initial {
            background-image: linear-gradient(310deg, #94e864, #71dd37);
        }

        .bg-info .avatar-initial {
            background-image: linear-gradient(310deg, #26e0fe, #03c3ec);
        }

        .label-badge {
            border-radius: 4px;
            padding: 0.35em 0.65em;
        }
    </style>
</div>
