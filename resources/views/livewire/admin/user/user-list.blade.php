<div class="container-xxl container-p-y">

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0 fw-bold">Drivers</h4>
            
            <div class="d-flex gap-2 align-items-center">
                {{-- Search Box --}}
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text">
                        <i class="bx bx-search"></i>
                    </span>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        class="form-control" 
                        placeholder="Search drivers...">
                    @if($search)
                        <button wire:click="$set('search', '')" class="btn btn-outline-secondary" type="button">
                            <i class="bx bx-x"></i>
                        </button>
                    @endif
                </div>

                {{-- Add Button --}}
                <a href="{{ route('users.create') }}" class="btn btn-primary">
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
                    <div class="col-md-3 d-flex align-items-center gap-3">
                        {{-- Avatar with initials fallback --}}
                        @if($user->profile_image_url)
                            <img src="{{ $user->profile_image_url }}"
                                 class="rounded-circle border border-2"
                                 width="48"
                                 height="48"
                                 style="object-fit: cover;"
                                 alt="{{ $user->name }}">
                        @else
                            <div class="rounded-circle border border-2 d-flex align-items-center justify-content-center fw-bold text-white fs-6"
                                 style="width: 48px; height: 48px; background-color: {{ $user->avatar_color }};">
                                {{ $user->initials }}
                            </div>
                        @endif

                        <div>
                            <strong class="fs-5 d-block">{{ $user->name }}</strong>
                            <small class="text-muted">{{ $user->email }}</small>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="col-md-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-phone-call fs-4 text-primary"></i>
                            <span class="text-muted">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Vehicle --}}
                    <div class="col-md-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-car fs-4 text-primary"></i>
                            <div>
                                <span class="text-muted d-block">{{ $user->vehicle_number ?? '-' }}</span>
                                @if($user->license_number)
                                    <small class="text-muted">License: {{ $user->license_number }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2">
                        <span class="d-flex align-items-center gap-2">
                            <span class="badge badge-dot bg-{{ $user->status === 'active' ? 'success' : 'secondary' }}"></span>
                            <span class="fw-semibold text-uppercase small">
                                {{ $user->status === 'active' ? 'ON DUTY' : 'OFFLINE' }}
                            </span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2 text-end">
                        <a href="{{ route('users.edit', $user) }}"
                           class="btn btn-sm btn-outline-primary me-2"
                           title="Edit Driver">
                            <i class="bx bx-edit fs-5"></i>
                        </a>

                        <button wire:click="delete({{ $user->id }})"
                                wire:confirm="Are you sure you want to delete this driver?"
                                class="btn btn-sm btn-outline-danger"
                                title="Delete Driver">
                            <i class="bx bx-trash fs-5"></i>
                        </button>
                    </div>

                </div>
            @empty
                <div class="p-5 text-center">
                    <i class="bx bx-user-x display-3 text-muted opacity-50"></i>
                    <p class="text-muted mt-3 mb-0 fs-6">
                        @if($search)
                            No drivers found matching "{{ $search }}"
                        @else
                            No drivers found
                        @endif
                    </p>
                    @if($search)
                        <button wire:click="$set('search', '')" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bx bx-x me-1"></i> Clear Search
                        </button>
                    @endif
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>