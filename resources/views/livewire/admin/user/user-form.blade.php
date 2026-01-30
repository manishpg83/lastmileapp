<div class="container-xxl container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $user ? 'Edit Driver' : 'Add Driver' }}</h5>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="save" class="row g-3">

                {{-- Profile Image --}}
                <div class="col-md-12 text-center mb-3">
                    <div class="mb-3">
                        @if($profile_image)
                            <img src="{{ $profile_image->temporaryUrl() }}"
                                 class="rounded-circle border border-3 border-light shadow-sm"
                                 width="120"
                                 height="120"
                                 style="object-fit: cover;">
                        @elseif($existing_image)
                            <img src="{{ asset('storage/'.$existing_image) }}"
                                 class="rounded-circle border border-3 border-light shadow-sm"
                                 width="120"
                                 height="120"
                                 style="object-fit: cover;">
                        @else
                            @php
                                $displayName = $name ?? ($user ? $user->name : 'NA');
                                $words = explode(' ', trim($displayName));
                                $initials = count($words) >= 2 
                                    ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                    : strtoupper(substr($displayName, 0, 2));
                                $bgColor = $user ? $user->avatar_color : '#6c757d';
                            @endphp
                            <div class="rounded-circle border border-3 border-light shadow-sm d-inline-flex align-items-center justify-content-center fw-bold text-white fs-2"
                                 style="width: 120px; height: 120px; background-color: {{ $bgColor }};">
                                {{ $initials }}
                            </div>
                        @endif
                    </div>
                    <label for="profile_image" class="btn btn-outline-primary btn-sm mb-2">
                        <i class="bx bx-camera me-1"></i> Change Avatar
                    </label>
                    <input type="file" wire:model="profile_image" class="d-none" id="profile_image" accept="image/*">
                    <p class="text-muted small mb-0">JPG, GIF or PNG. 1MB Max.</p>
                    @error('profile_image') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Enter driver name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="Enter email address">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="Enter phone number">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Password --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Password 
                        @if(!$user) <span class="text-danger">*</span> @endif
                        @if($user) <span class="text-muted small">(Leave blank to keep current)</span> @endif
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="{{ $user ? 'Enter new password or leave blank' : 'Enter password' }}">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Role --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" wire:model="role">
                        <option value="super_admin">Super Admin</option>
                        <option value="manager">Manager</option>
                        <option value="driver">Driver</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" wire:model="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Vehicle Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Vehicle Number</label>
                    <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror" wire:model="vehicle_number" placeholder="Enter vehicle number">
                    @error('vehicle_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- License Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">License Number</label>
                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" wire:model="license_number" placeholder="Enter license number">
                    @error('license_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bx bx-save me-1"></i>
                        {{ $user ? 'Update Driver' : 'Create Driver' }}
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-x me-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>