<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-md-auto">

            <!-- Style Switcher -->
            <li class="nav-item dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="bx-sun icon-base bx icon-md theme-icon-active"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <button type="button" class="dropdown-item" data-bs-theme-value="light">
                            <i class="icon-base bx bx-sun icon-md me-3"></i>Light
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" data-bs-theme-value="dark">
                            <i class="icon-base bx bx-moon icon-md me-3"></i>Dark
                        </button>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('admin/img/avatars/1.png') }}" alt="" class="rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ url('/profile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('admin/img/avatars/1.png') }}" alt=""
                                            class="rounded-circle">
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
                        <a class="dropdown-item" href="{{ url('/profile') }}">
                            <i class="icon-base bx bx-user icon-md me-3"></i>My Profile
                        </a>
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
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-base bx bx-power-off icon-md me-3"></i>Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- / Navbar -->