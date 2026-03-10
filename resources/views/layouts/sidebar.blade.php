<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo ">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <i class="fa-solid fa-truck-fast text-primary logo-collapsed"
                    style="font-size: 1.5rem; margin-left: -4px"></i>
                <div class="logo-full d-flex align-items-center">
                    <i class="fa-solid fa-truck-fast text-primary me-2" style="font-size: 1.4rem;"></i>
                    <img src="{{ asset('frontend/images/delivery_wale.png') }}" alt="Delivery Wale"
                        style="max-height: 28px; width: auto; object-fit: contain; margin-left: -5px;">
                </div>
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base bx bx-chevron-left"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-home-smile"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <!-- Deliveries -->
        <li class="menu-item {{ request()->is('deliveries*') ? 'active' : '' }}">
            <a href="{{ route('deliveries.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-package"></i>
                <div>Deliveries</div>
            </a>
        </li>

        <!-- Users -->
        <li class="menu-item {{ request()->is('users*', 'drivers*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-user"></i>
                <div>Users</div>
            </a>
        </li>

        <!-- Notifications -->
        <li class="menu-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
            <a href="{{ route('notifications.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-bell"></i>
                <div data-i18n="Notifications">Notifications</div>
                @php
                    $unreadCount = \App\Models\Notification::unread()->count();
                @endphp
                @if ($unreadCount > 0)
                    <div class="badge bg-danger rounded-pill ms-auto">{{ $unreadCount }}</div>
                @endif
            </a>
        </li>

        <!-- Reasons List -->
        <li class="menu-item {{ request()->routeIs('reasons.index') ? 'active' : '' }}">
            <a href="{{ route('reasons.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-error-circle"></i>
                <div data-i18n="Reasons List">Reasons List</div>
            </a>
        </li>

        <!-- Reports -->
        <li class="menu-item {{ request()->is('reports*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Reports">Reports</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('reports.master') ? 'active' : '' }}">
                    <a href="{{ route('reports.master') }}" class="menu-link">
                        <div data-i18n="Master Report">Master Report</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('reports.driver-wise') ? 'active' : '' }}">
                    <a href="{{ route('reports.driver-wise') }}" class="menu-link">
                        <div data-i18n="Driver Wise Report">Driver Wise Report</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
            <a href="{{ route('settings.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-cog"></i>
                <div>Settings</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
