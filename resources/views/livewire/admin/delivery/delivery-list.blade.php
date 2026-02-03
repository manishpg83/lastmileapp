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
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <div>
                <h4 class="mb-0 fw-bold">Deliveries</h4>
                <small class="text-muted">Manage all shipments and assignments</small>
            </div>

            <div class="d-flex gap-2 align-items-center">
                @if (count($selectedDeliveries) > 0)
                    <div class="d-flex align-items-center gap-2 border-end pe-2 me-2">
                        <select wire:model="bulkDriverId" class="form-select form-select-sm" style="width: 200px;">
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="assignDriver" class="btn btn-primary btn-sm">Assign</button>
                        <small class="text-muted ms-2">{{ count($selectedDeliveries) }} Selected</small>
                    </div>
                @endif

                {{-- Search Box --}}
                <div class="input-group" style="width: 300px;">
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
                <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add Delivery
                </a>
            </div>
        </div>

        <div class="card-body p-0">

            {{-- Header Row --}}
            <div class="d-none d-md-flex px-4 py-3 border-bottom fw-semibold text-muted fs-6 uppercase g-0">
                <div class="col-md-3 d-flex align-items-center">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" wire:model.live="selectAll">
                    </div>
                    DELIVERY DETAILS
                </div>
                <div class="col-md-3">ASSIGN DRIVER</div>
                <div class="col-md-2">DOCKET / PHONE</div>
                <div class="col-md-2">STATUS</div>
                <div class="col-md-2 text-end">ACTIONS</div>
            </div>

            {{-- Rows --}}
            @forelse($deliveries as $delivery)
                <div class="row align-items-center px-4 py-3 border-bottom g-0">

                    {{-- Customer Details --}}
                    <div class="col-md-3 d-flex align-items-center gap-2">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" wire:model.live="selectedDeliveries"
                                value="{{ $delivery->id }}">
                        </div>
                        <div class="avatar avatar-md me-2">
                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                <i class="bx bx-package fs-4"></i>
                            </span>
                        </div>
                        <div class="truncate">
                            <strong class="fs-6 d-block text-heading text-truncate"
                                style="max-width: 150px;">{{ $delivery->customer_name }}</strong>
                            <small class="text-muted d-block text-truncate"
                                style="max-width: 150px;">{{ $delivery->company_name ?: 'No Company' }}</small>
                        </div>
                    </div>

                    {{-- Driver Assignment --}}
                    <div class="col-md-3 pe-3">
                        <select class="form-select form-select-sm"
                            wire:change="assignSingleDriver({{ $delivery->id }}, $event.target.value)"
                            wire:loading.attr="disabled">
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ $delivery->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Docket / Phone --}}
                    <div class="col-md-2">
                        <div>
                            <span class="text-dark d-block fw-bold small">{{ $delivery->docket_number }}</span>
                            <small class="text-muted small"><i
                                    class="bx bx-phone-call me-1"></i>{{ $delivery->phone }}</small>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2">
                        <span class="d-flex align-items-center gap-1">
                            <span class="badge badge-dot bg-{{ $delivery->status_color }}"></span>
                            <span class="fw-semibold text-uppercase extra-small text-{{ $delivery->status_color }}">
                                {{ str_replace('_', ' ', $delivery->status) }}
                            </span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2 text-end">
                        <a href="{{ route('deliveries.edit', $delivery) }}"
                            class="btn btn-sm btn-icon btn-label-primary me-1" title="Edit Delivery">
                            <i class="bx bx-edit-alt"></i>
                        </a>

                        <button wire:click="delete({{ $delivery->id }})"
                            wire:confirm="Are you sure you want to delete this delivery?"
                            class="btn btn-sm btn-icon btn-label-danger" title="Delete Delivery">
                            <i class="bx bx-trash"></i>
                        </button>
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
