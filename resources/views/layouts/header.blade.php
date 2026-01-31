<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>

    <!-- Page Title & Subtitle -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <div class="d-flex flex-column">
                <h5 class="fw-bold mb-0">
                    @if (request()->routeIs('notifications.index'))
                        Notifications
                    @elseif(request()->routeIs('reasons.index'))
                        Reasons
                    @elseif(request()->routeIs('settings.index'))
                        Settings
                    @else
                        Dashboard
                    @endif
                </h5>
            </div>
        </div>
    </div>

    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-md-auto">

            <!-- Notification Bell -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="icon-base bx bx-bell icon-md"></i>
                    @php
                        $unreadCount = \App\Models\Notification::unread()->count();
                        $recentNotifications = \App\Models\Notification::latest()->take(5)->get();
                    @endphp
                    @if ($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill badge-notifications">{{ $unreadCount }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                    class="bx fs-4 bx-envelope-open"></i></a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @forelse($recentNotifications as $notification)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
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
                                            <h6 class="mb-1">{{ $notification->message }}</h6>
                                            <p class="mb-0">{{ $notification->created_at->diffForHumans() }}</p>
                                            <small
                                                class="text-muted text-uppercase text-{{ $notification->border_color }}">{{ $notification->level }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                    class="badge badge-dot"></span></a>
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
                        <a href="{{ route('notifications.index') }}"
                            class="dropdown-item d-flex justify-content-center p-3">
                            View all notifications
                        </a>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <span class="avatar-initial rounded-circle bg-label-warning text-warning fw-bold">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 2) }}
                        </span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ url('/profile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <span
                                            class="avatar-initial rounded-circle bg-label-warning text-warning fw-bold">
                                            {{ substr(Auth::user()->name ?? 'Admin', 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ Auth::user()->name ?? 'Admin' }}</h6>
                                    <small class="text-body-secondary">Administrator</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/settings') }}">
                            <i class="icon-base bx bx-cog icon-md me-3"></i>Settings
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); 
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'You will be logged out of your session.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Log Out!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('logout-form').submit();
                                }
                            });">
                            <i class="icon-base bx bx-power-off icon-md me-3"></i>Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- / Navbar -->
