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
            <h4 class="mb-0 fw-bold">Deliveries</h4>

            <div class="d-flex gap-2 align-items-center">
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
            <div class="d-none d-md-flex px-4 py-3 border-bottom fw-semibold text-muted fs-6 uppercase">
                <div class="col-md-3">DELIVERY DETAILS</div>
                <div class="col-md-2">DRIVER</div>
                <div class="col-md-3">DOCKET / PHONE</div>
                <div class="col-md-2">STATUS</div>
                <div class="col-md-2 text-end">ACTIONS</div>
            </div>

            {{-- Rows --}}
            @forelse($deliveries as $delivery)
                <div class="row align-items-center px-4 py-4 border-bottom g-0">

                    {{-- Customer Details --}}
                    <div class="col-md-3 d-flex align-items-center gap-3">
                        <div class="avatar avatar-md">
                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                <i class="bx bx-package fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <strong class="fs-5 d-block text-heading">{{ $delivery->customer_name }}</strong>
                            <small class="text-muted d-block truncate"
                                style="max-width: 200px;">{{ $delivery->company_name ?: 'No Company' }}</small>
                        </div>
                    </div>

                    {{-- Driver --}}
                    <div class="col-md-2">
                        @if ($delivery->driver)
                            <div class="d-flex align-items-center gap-2">
                                <span class="avatar avatar-xs">
                                    <span class="avatar-initial rounded-circle bg-label-info">
                                        {{ substr($delivery->driver->name, 0, 1) }}
                                    </span>
                                </span>
                                <span class="text-muted fw-medium">{{ $delivery->driver->name }}</span>
                            </div>
                        @else
                            <span class="text-muted small">Unassigned</span>
                        @endif
                    </div>

                    {{-- Docket / Phone --}}
                    <div class="col-md-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-barcode-reader fs-4 text-primary"></i>
                            <div>
                                <span class="text-muted d-block fw-bold">{{ $delivery->docket_number }}</span>
                                <small class="text-muted"><i
                                        class="bx bx-phone-call me-1"></i>{{ $delivery->phone }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2">
                        <span class="d-flex align-items-center gap-2">
                            <span class="badge badge-dot bg-{{ $delivery->status_color }}"></span>
                            <span class="fw-semibold text-uppercase small text-{{ $delivery->status_color }}">
                                {{ str_replace('_', ' ', $delivery->status) }}
                            </span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2 text-end">
                        <a href="{{ route('deliveries.edit', $delivery) }}" class="btn btn-sm btn-outline-primary me-2"
                            title="Edit Delivery">
                            <i class="bx bx-edit fs-5"></i>
                        </a>

                        <button wire:click="delete({{ $delivery->id }})"
                            wire:confirm="Are you sure you want to delete this delivery?"
                            class="btn btn-sm btn-outline-danger" title="Delete Delivery">
                            <i class="bx bx-trash fs-5"></i>
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
