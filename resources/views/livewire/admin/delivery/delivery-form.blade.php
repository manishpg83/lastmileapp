<div class="container-xxl container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">{{ $isEdit ? 'Edit Delivery' : 'Add Delivery' }}</h5>
            <a href="{{ route('deliveries.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>

        <div class="card-body pt-0">
            <form wire:submit.prevent="save" class="row g-3">

                <div class="col-12 mt-4 bg-label-primary p-3 rounded mb-2">
                    <h6 class="mb-0 text-primary fw-bold"><i class="bx bx-info-circle me-1"></i> Basic Information</h6>
                </div>

                {{-- Docket Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Docket Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('docket_number') is-invalid @enderror"
                        wire:model="docket_number" placeholder="Enter docket number">
                    @error('docket_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" wire:model="status">
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4 bg-label-primary p-3 rounded mb-2">
                    <h6 class="mb-0 text-primary fw-bold"><i class="bx bx-user me-1"></i> Customer & Assignment</h6>
                </div>

                {{-- Customer Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Customer Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                        wire:model="customer_name" placeholder="Enter customer name">
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone"
                        placeholder="Enter phone number">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Company Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Company Name</label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                        wire:model="company_name" placeholder="Enter company name">
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Assign Driver --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Assign Driver</label>
                    <select class="form-select @error('driver_id') is-invalid @enderror" wire:model="driver_id">
                        <option value="">Select a Driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}
                                ({{ $driver->vehicle_number ?? 'No Vehicle' }})
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Assign Date & Time --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Assign Date & Time</label>
                    <input type="datetime-local" class="form-control @error('assigned_at') is-invalid @enderror"
                        wire:model="assigned_at">
                    @error('assigned_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4 bg-label-primary p-3 rounded mb-2">
                    <h6 class="mb-0 text-primary fw-bold"><i class="bx bx-map me-1"></i> Location & Notes</h6>
                </div>

                {{-- Pincode --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pincode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                        wire:model="pincode" placeholder="Enter pincode">
                    @error('pincode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                        placeholder="Enter email address">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Delivery Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" wire:model="address" rows="3"
                        placeholder="Enter full address"></textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Notes --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Additional Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" wire:model="notes" rows="2"
                        placeholder="Any delivery instructions..."></textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="col-12 mt-4 pt-3 border-top">
                    <button wire:click="save" type="button" class="btn btn-primary me-2">
                        <i class="bx bx-save me-1"></i>
                        {{ $isEdit ? 'Update Delivery' : 'Create Delivery' }}
                    </button>
                    <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-x me-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
