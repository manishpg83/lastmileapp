<div class="nav-align-top mb-6">
    <ul class="nav nav-pills flex-column flex-md-row gap-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <i class="bx bx-user me-1_5"></i> profile
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('security') ? 'active' : '' }}" href="{{ route('security') }}">
                <i class="bx bx-lock-alt me-1_5"></i> Security
            </a>
        </li>
    </ul>
</div>