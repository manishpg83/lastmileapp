<div>
<style>
    /* ── Drivers List – compact font ── */
    .drivers-wrap .driver-row {
        font-size: 0.82rem !important;
    }
    .drivers-wrap .driver-row strong {
        font-size: 0.82rem !important;
    }
    .drivers-wrap .driver-row small,
    .drivers-wrap .driver-row .extra-small {
        font-size: 0.72rem !important;
    }
    .drivers-wrap .driver-row .text-muted.small {
        font-size: 0.78rem !important;
    }
    .drivers-wrap .driver-row .badge {
        font-size: 0.7rem !important;
    }
    .drivers-wrap .driver-row .btn-sm {
        padding: 0.25rem 0.45rem !important;
        font-size: 0.78rem !important;
    }
    .drivers-wrap .driver-row .bx {
        font-size: 0.95rem !important;
    }
    /* Avatar smaller */
    .drivers-wrap .driver-avatar {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.7rem !important;
    }
    /* Header row labels */
    .drivers-wrap .header-row {
        font-size: 0.7rem !important;
        letter-spacing: 0.03em;
    }
    /* Tighter row padding */
    .drivers-wrap .driver-row {
        padding-top: 0.65rem !important;
        padding-bottom: 0.65rem !important;
    }
</style>

<div class="container-xxl container-p-y">
<button wire:click="$refresh" class="btn btn-primary">Test Livewire</button>
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card drivers-wrap">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 py-3">
            <h4 class="mb-0 fw-bold">Drivers</h4>

            <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center w-100 w-md-auto">
                {{-- Search Box --}}
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                        placeholder="Search drivers...">
                    @if ($search)
                        <button wire:click="$set('search', '')" class="btn btn-outline-secondary" type="button">
                            <i class="bx bx-x"></i>
                        </button>
                    @endif
                </div>

                {{-- Add Button --}}
                <a href="{{ route('users.create') }}" class="btn btn-primary text-nowrap">
                    <i class="bx bx-plus me-1"></i> Add Driver
                </a>
            </div>
        </div>

        <div class="card-body p-0">

            {{-- Header Row --}}
            <div class="d-none d-md-flex px-4 py-2 border-bottom fw-semibold text-muted header-row">
                <div class="col-md-3">DRIVER DETAILS</div>
                <div class="col-md-2">CONTACT</div>
                <div class="col-md-3">VEHICLE NUMBER</div>
                <div class="col-md-2">STATUS</div>
                <div class="col-md-2 text-end">ACTIONS</div>
            </div>

            {{-- Rows --}}
            @forelse($users as $user)
                <div class="row align-items-center px-4 py-3 border-bottom g-0 driver-row">

                    {{-- Driver --}}
                    <div class="col-md-3 col-6 d-flex align-items-center gap-3">
                        @if ($user->profile_image_url)
                            <img src="{{ $user->profile_image_url }}"
                                class="rounded-circle border border-2 driver-avatar"
                                style="object-fit: cover;" alt="{{ $user->name }}">
                        @else
                            <div class="rounded-circle border border-2 d-flex align-items-center justify-content-center fw-bold text-white driver-avatar"
                                style="background-color: {{ $user->avatar_color }};">
                                {{ $user->initials }}
                            </div>
                        @endif
                        <div class="truncate">
                            <strong class="d-block text-heading text-truncate" style="max-width: 120px;">{{ $user->name }}</strong>
                            <small class="text-muted d-block text-truncate" style="max-width: 120px;">{{ $user->email }}</small>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="col-md-2 col-6">
                        <label class="d-md-none text-muted fw-bold d-block mb-1" style="font-size:0.7rem;">CONTACT</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-phone-call text-primary"></i>
                            <span class="text-muted">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Vehicle --}}
                    <div class="col-md-3 col-6 mt-3 mt-md-0">
                        <label class="d-md-none text-muted fw-bold d-block mb-1" style="font-size:0.7rem;">VEHICLE</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-car text-primary"></i>
                            <div>
                                <span class="text-muted d-block">{{ $user->vehicle_number ?? '-' }}</span>
                                @if ($user->license_number)
                                    <small class="text-muted">License: {{ $user->license_number }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2 col-3 mt-3 mt-md-0">
                        <label class="d-md-none text-muted fw-bold d-block mb-1" style="font-size:0.7rem;">STATUS</label>
                        <span class="d-flex align-items-center gap-2">
                            <span class="badge badge-dot bg-{{ $user->status === 'active' ? 'success' : 'secondary' }}"></span>
                            <span class="fw-semibold" style="font-size:0.72rem;">
                                {{ $user->status === 'active' ? 'On duty' : 'Offline' }}
                            </span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2 col-3 text-end mt-3 mt-md-0">
                        <label class="d-md-none text-muted fw-bold d-block mb-1" style="font-size:0.7rem;">ACTIONS</label>
                        <div class="d-flex justify-content-end gap-1">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Edit Driver">
                                <i class="bx bx-edit"></i>
                            </a>

                            <a href="{{ route('drivers.logs', $user) }}" class="btn btn-sm btn-outline-info" title="View Activity">
                                <i class="bx bx-show"></i>
                            </a>

                            <button wire:click="logoutDriver({{ $user->id }})"
                                onclick="return confirm('Are you sure you want to log out this user from all sessions?')"
                                class="btn btn-sm btn-outline-warning" title="Revoke Sessions">
                                <i class="bx bx-log-out-circle"></i>
                            </button>

                            @if (
                                !$user->isSuperAdmin() &&
                                !Illuminate\Support\Str::contains(strtolower($user->name), 'superadmin') &&
                                !Illuminate\Support\Str::contains(strtolower($user->email), 'superadmin'))
                               <button wire:click="deleteDriver({{ $user->id }})"
                                    onclick="return confirm('Are you sure you want to delete this driver?')"
                                    class="btn btn-sm btn-outline-danger" title="Delete Driver">
                                    <i class="bx bx-trash"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <div class="p-5 text-center">
                    <i class="bx bx-user-x display-3 text-muted opacity-50"></i>
                    <p class="text-muted mt-3 mb-0 fs-6">
                        @if ($search)
                            No drivers found matching "{{ $search }}"
                        @else
                            No drivers found
                        @endif
                    </p>
                    @if ($search)
                        <button wire:click="$set('search', '')" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bx bx-x me-1"></i> Clear Search
                        </button>
                    @endif
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
</div>