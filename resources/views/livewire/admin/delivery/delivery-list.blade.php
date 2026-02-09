<div class="container-xxl container-p-y">

    {{-- Alert Messages --}}
    @if (session()->has('message'))
        <div class="alert alert-{{ session('messageType') }} alert-dismissible fade show" role="alert">
            <i class="bx {{ session('messageType') == 'success' ? 'bx-check-circle' : 'bx-error-circle' }} me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 py-3">
            <div>
                <h4 class="mb-0 fw-bold">Deliveries</h4>
                <small class="text-muted">Manage all shipments and assignments</small>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center">




                {{-- Search Box --}}
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                        placeholder="Search deliveries...">
                    @if ($search)
                        <button wire:click="$set('search', '')" class="btn btn-outline-secondary" type="button">
                            <i class="bx bx-x"></i>
                        </button>
                    @endif
                </div>

                {{-- Add Button --}}
                <a href="{{ route('deliveries.create') }}" class="btn btn-primary text-nowrap">
                    <i class="bx bx-plus me-1"></i> Add Delivery
                </a>
            </div>
        </div>

        @if (count($selectedDeliveries) > 0)
            <div class="card-body border-top bg-white py-2">


                <div class="d-flex flex-row align-items-center gap-3 overflow-auto">
                    {{-- Assign Driver --}}
                    <div class="input-group input-group-sm">
                        <select wire:model="bulkDriverId" class="form-select" style="max-width: 150px;">
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignDriver" class="btn btn-primary">Assign</button>
                    </div>

                    <div class="vr mx-1"></div>

                    {{-- Update Status --}}
                    <div class="input-group input-group-sm">
                        <select wire:model="bulkStatus" class="form-select" style="max-width: 130px;">
                            <option value="">Status</option>
                            <option value="pending">Pending</option>
                            <option value="assigned">Assigned</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="undelivered">Undelivered</option>
                            <option value="passed">Passed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <button wire:click="bulkUpdateStatus" class="btn btn-info">Update</button>
                    </div>

                    {{-- Delete & Clear --}}
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <button wire:click="bulkDelete"
                            wire:confirm="Are you sure you want to delete selected deliveries?"
                            class="btn btn-danger btn-sm text-nowrap me-2">
                            <i class="bx bx-trash"></i>
                        </button>

                        <div class="vr me-2"></div>

                        <span class="badge bg-primary text-nowrap">{{ count($selectedDeliveries) }} Selected</span>
                        <button wire:click="$set('selectedDeliveries', [])"
                            class="btn btn-sm btn-outline-secondary bg-white text-secondary border-0 text-nowrap"
                            title="Clear Selection">
                            <i class="bx bx-x"></i> Clear
                        </button>
                    </div>
                </div>
        @endif

        <div class="card-body p-0">

            {{-- Header Row --}}
            <div class="d-none d-md-flex px-4 py-3 border-bottom fw-semibold text-muted fs-6 uppercase g-0">
                <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" wire:model.live="selectAll">
                    </div>
                    DETAILS
                </div>
                <div class="col-md-2">DOCKET / PHONE</div>
                <div class="col-md-2">GATI STATUS</div>
                <div class="col-md-1 text-center">POD</div>
                <div class="col-md-2">STATUS</div>
                <div class="col-md-2">ASSIGN DRIVER</div>
                <div class="col-md-1 text-end">ACTIONS</div>
            </div>

            {{-- Rows --}}
            @forelse($deliveries as $delivery)
                <div class="row align-items-center px-4 py-3 border-bottom g-0 bg-white"
                    style="background-color: white;">

                    {{-- Customer Details --}}
                    <div class="col-md-2 col-6 d-flex align-items-center gap-1">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" wire:model.live="selectedDeliveries"
                                value="{{ $delivery->id }}">
                        </div>
                        <div class="truncate">
                            <strong class="extra-small d-block text-heading text-truncate"
                                style="max-width: 100px;">{{ $delivery->customer_name }}</strong>
                            <small class="text-muted d-block text-truncate extra-small"
                                style="max-width: 100px;">{{ $delivery->company_name ?: 'No Company' }}</small>
                        </div>
                    </div>

                    {{-- Docket / Phone --}}
                    <div class="col-md-2 col-6">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">DOCKET/PHONE</label>
                        <div class="d-flex flex-column">
                            <span class="text-dark fw-bold extra-small">{{ $delivery->docket_number }}</span>
                            <small class="text-muted extra-small"><i
                                    class="bx bx-phone-call me-1"></i>{{ $delivery->phone }}</small>
                        </div>
                    </div>

                    {{-- Gati Status --}}
                    <div class="col-md-2 col-4 mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">GATI STATUS</label>
                        @if ($delivery->status === 'delivered')
                            <span class="badge bg-label-success extra-small px-2 py-1">Done</span>
                        @else
                            <span class="badge bg-label-secondary extra-small px-2 py-1">In Progress</span>
                        @endif
                    </div>

                    {{-- POD --}}
                    <div class="col-md-1 col-4 mt-3 mt-md-0 text-md-center">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">POD</label>
                        @if ($delivery->pod_image)
                            <a href="{{ $delivery->pod_image_url }}" target="_blank"
                                class="btn btn-sm btn-icon btn-label-info">
                                <i class="bx bx-image-alt fs-5"></i>
                            </a>
                        @else
                            <span class="text-muted opacity-50"><i class="bx bx-minus"></i></span>
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2 col-4 mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">STATUS</label>
                        <span class="d-flex align-items-center gap-1">
                            <span class="badge badge-dot bg-{{ $delivery->status_color }}"></span>
                            <span class="fw-bold text-uppercase extra-small text-{{ $delivery->status_color }}">
                                {{ $delivery->status }}
                            </span>
                        </span>
                    </div>

                    {{-- Driver Assignment --}}
                    <div class="col-md-2 col-6 mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">ASSIGN DRIVER</label>
                        <select class="form-select form-select-sm extra-small" style="max-width: 130px;"
                            wire:change="assignSingleDriver({{ $delivery->id }}, $event.target.value)"
                            wire:loading.attr="disabled">
                            <option value="">Select</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ $delivery->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-1 col-6 text-end mt-3 mt-md-0">
                        <label class="d-md-none text-muted extra-small fw-bold d-block">ACTIONS</label>
                        <div class="d-flex justify-content-end gap-1">
                            <a href="{{ route('deliveries.edit', $delivery) }}"
                                class="btn btn-sm btn-icon btn-label-primary" title="Edit">
                                <i class="bx bx-edit-alt"></i>
                            </a>

                            <button wire:click="delete({{ $delivery->id }})" wire:confirm="Are you sure?"
                                class="btn btn-sm btn-icon btn-label-danger" title="Delete">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </div>

                </div>
            @empty
                <div class="p-5 text-center">
                    <i class="bx bx-package display-3 text-muted opacity-50"></i>
                    <p class="text-muted mt-3 mb-0 fs-6">
                        @if ($search)
                            No deliveries found matching "{{ $search }}"
                        @else
                            No deliveries found
                        @endif
                    </p>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if ($deliveries->hasPages())
            <div class="card-footer">
                {{ $deliveries->links() }}
            </div>
        @endif
    </div>

</div>
