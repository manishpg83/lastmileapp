<div class="container-xxl container-p-y">

    {{-- Tabs --}}
    @include('admin.partials.account-tabs')

    @if (session()->has('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif


    <div class="card mb-6">
        <h5 class="card-header">Change Password</h5>

        <div class="card-body pt-1">
            <form wire:submit.prevent="updatePassword" novalidate>

                <div class="row">
                    <div class="mb-6 col-md-6 form-password-toggle">
                        <label class="form-label">Current Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('currentPassword') is-invalid @enderror"
                                wire:model.defer="currentPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        @error('currentPassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-6 col-md-6 form-password-toggle">
                        <label class="form-label">New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                wire:model.defer="newPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        @error('newPassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6 col-md-6 form-password-toggle">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                                wire:model.defer="confirmPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        @error('confirmPassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h6 class="text-body">Password Requirements:</h6>
                <ul class="ps-4 mb-0">
                    <li class="mb-4">Minimum 8 characters long - the more, the better</li>
                    <li class="mb-4">At least one lowercase character</li>
                    <li>At least one number, symbol, or whitespace character</li>
                </ul>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3">
                        Save changes
                    </button>
                    <button type="reset" class="btn btn-label-secondary">
                        Reset
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
