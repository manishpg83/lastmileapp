<div class="container-xxl container-p-y">

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

    <div class="card">
        <div
            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 py-3">
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
            <div class="d-none d-md-flex px-4 py-3 border-bottom fw-semibold text-muted fs-6">
                <div class="col-md-3">DRIVER DETAILS</div>
                <div class="col-md-2">CONTACT</div>
                <div class="col-md-3">VEHICLE NUMBER</div>
                <div class="col-md-2">STATUS</div>
                <div class="col-md-2 text-end">ACTIONS</div>
            </div>

            {{-- Rows --}}
            @forelse($users as $user)
                <div class="row align-items-center px-4 py-4 border-bottom g-0">

                    {{-- Driver --}}
                    <div class="col-md-3 col-6 d-flex align-items-center gap-3">
                        {{-- Avatar with initials fallback --}}
                        @if ($user->profile_image_url)
                            <img src="{{ $user->profile_image_url }}" class="rounded-circle border border-2" width="44"
                                height="44" style="object-fit: cover;" alt="{{ $user->name }}">
                        @else
                            <div class="rounded-circle border border-2 d-flex align-items-center justify-content-center fw-bold text-white extra-small"
                                style="width: 44px; height: 44px; background-color: {{ $user->avatar_color }};">
                                {{ $user->initials }}
                            </div>
                        @endif
                        <div class="truncate">
                            <strong class="small d-block text-heading text-truncate"
                                style="max-width: 120px;">{{ $user->name }}</strong>
                            <small class="text-muted d-block text-truncate extra-small"
                                style="max-width: 120px;">{{ $user->email }}</small>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="col-md-2 col-6">
                        <label class="d-md-none text-muted extra-small fw-bold d-block mb-1">CONTACT</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-phone-call fs-5 text-primary"></i>
                            <span class="text-muted small">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Vehicle --}}
                    <div class="col-md-3 col-6 mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block mb-1">VEHICLE</label>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-car fs-5 text-primary"></i>
                            <div>
                                <span class="text-muted small d-block">{{ $user->vehicle_number ?? '-' }}</span>
                                @if ($user->license_number)
                                    <small class="text-muted extra-small">License: {{ $user->license_number }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2 col-3 mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block mb-1">STATUS</label>
                        <span class="d-flex align-items-center gap-2">
                            <span
                                class="badge badge-dot bg-{{ $user->status === 'active' ? 'success' : 'secondary' }}"></span>
                            <span class="fw-semibold text-uppercase extra-small">
                                {{ $user->status === 'active' ? 'ON DUTY' : 'OFFLINE' }}
                            </span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2 col-3 text-end mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block mb-1">ACTIONS</label>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary"
                                title="Edit Driver">
                                <i class="bx bx-edit fs-6"></i>
                            </a>

                            <button wire:click="logout({{ $user->id }})"
                                wire:confirm="Are you sure you want to log out this user from all sessions?"
                                class="btn btn-sm btn-outline-warning" title="Revoke Sessions">
                                <i class="bx bx-log-out-circle fs-6"></i>
                            </button>

                            @if (!$user->isSuperAdmin() && !Illuminate\Support\Str::contains(strtolower($user->name), 'superadmin') && !Illuminate\Support\Str::contains(strtolower($user->email), 'superadmin'))
                                <button wire:click="delete({{ $user->id }})"
                                    wire:confirm="Are you sure you want to delete this driver?"
                                    class="btn btn-sm btn-outline-danger" title="Delete Driver">
                                    <i class="bx bx-trash fs-6"></i>
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