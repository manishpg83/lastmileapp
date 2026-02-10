<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Settings
    </h4>

    <div class="row">
        <!-- Profile Settings -->
        <div class="col-md-12">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <h5 class="card-header">Profile Settings</h5>
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" alt="user-avatar" class="d-block rounded-circle"
                                height="100" width="100" id="uploadedAvatar" />
                        @elseif($current_avatar_url)
                            <img src="{{ $current_avatar_url }}" alt="user-avatar" class="d-block rounded-circle"
                                height="100" width="100" id="uploadedAvatar" />
                        @else
                            <div class="avatar avatar-xl h-px-100 w-px-100 fs-1">
                                <span class="avatar-initial rounded-circle bg-label-warning text-warning fw-bold">
                                    {{ substr(Auth::user()->name ?? 'Admin', 0, 2) }}
                                </span>
                            </div>
                        @endif

                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 my-3" tabindex="0">
                                <span class="d-none d-sm-block">Change Avatar</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" wire:model="avatar" id="upload" class="account-file-input"
                                    hidden accept="image/png, image/jpeg" />
                            </label>

                            <p class="text-muted mb-0">JPG, GIF or PNG. 1MB Max.</p>
                            @error('avatar')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-0">

                    <div class="card-body">
                        <form wire:submit.prevent="saveProfile">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input class="form-control" type="text" wire:model="first_name" id="firstName"
                                        autofocus />
                                    @error('first_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" wire:model="last_name" id="lastName" />
                                    @error('last_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" wire:model="email" id="email" />
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        {{-- <span class="input-group-text">IN (+91)</span> --}}
                                        <input type="text" wire:model="phone" id="phone" class="form-control"
                                            placeholder="+91 98765 43210" />
                                    </div>
                                    @error('phone')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control"
                                        value="{{ ucfirst(str_replace('_', ' ', $role)) }}" disabled readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Language</label>
                                    <select id="language" wire:model="language" class="select2 form-select">
                                        <option value="en">English (UK)</option>
                                        <option value="es">Spanish</option>
                                        <option value="hi">Hindi</option>
                                    </select>
                                    @error('language')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="card mb-4 d-none">
                    <h5 class="card-header">Notification Preferences</h5>
                    <div class="card-body">
                        <span class="d-block mb-3">Choose how you want to be notified about shipment updates.</span>

                        <div class="d-flex mb-3 align-items-center justify-content-between">
                            <div>
                                <h6 class="mb-0 fw-semibold">Email Notifications</h6>
                                <small class="text-muted">Receive daily summaries and critical alerts via
                                    email.</small>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="email_notifications"
                                    id="emailSwitch">
                            </div>
                        </div>

                        <div class="d-flex mb-3 align-items-center justify-content-between">
                            <div>
                                <h6 class="mb-0 fw-semibold">SMS Alerts</h6>
                                <small class="text-muted">Get Instant SMS for driver status changes.</small>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="sms_alerts"
                                    id="smsSwitch">
                            </div>
                        </div>

                        <div class="d-flex mb-3 align-items-center justify-content-between">
                            <div>
                                <h6 class="mb-0 fw-semibold">Delivery Confirmations</h6>
                                <small class="text-muted">Notify when a shipment is marked delivered.</small>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="delivery_confirmations"
                                    id="deliverySwitch">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security -->
                <div class="card mb-4">
                    <h5 class="card-header">Security</h5>
                    <div class="card-body">
                        <span class="d-block mb-3">Update your password and security settings.</span>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input class="form-control" type="password" wire:model="current_password"
                                    id="currentPassword" placeholder="••••••••" />
                                @error('current_password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input class="form-control" type="password" wire:model="new_password"
                                    id="newPassword" />
                                @error('new_password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" wire:model="new_password_confirmation"
                                    id="confirmPassword" />
                            </div>
                        </div>
                        <button type="button" wire:click="updatePassword"
                            class="btn btn-outline-secondary mt-2">Update Password</button>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-4">
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
