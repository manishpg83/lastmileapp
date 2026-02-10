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




                {{-- Date Range Filter --}}
                <div class="input-group" style="max-width: 250px;" wire:ignore>
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="text" id="dateRangePicker" class="form-control" placeholder="Select Date Range"
                        wire:model.live="dateRange">
                </div>

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

                {{-- Excel Upload & Add Button --}}
                <div class="d-flex gap-2">
                    <a href="{{ route('uploads.index') }}" class="btn btn-label-success text-nowrap">
                        <i class="bx bx-upload me-1"></i> Upload Excel
                    </a>
                    <a href="{{ route('deliveries.create') }}" class="btn btn-primary text-nowrap">
                        <i class="bx bx-plus me-1"></i> Add Delivery
                    </a>
                </div>
            </div>
        </div>

        @if (count($selectedDeliveries) > 0)
            <div class="card-body border-top bg-white py-2">


                <div class="d-flex flex-row align-items-center gap-3 overflow-auto mb-2 mt-2">
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
                            <option value="pending">Not Assigned</option>
                            <option value="assigned">Assigned</option>
                            <option value="delivered">Delivered</option>
                            <option value="undelivered">Undelivered</option>
                        </select>
                        <button wire:click="bulkUpdateStatus" class="btn btn-info">Update</button>
                    </div>

                    <div class="vr mx-1"></div>

                    {{-- Update Gati Status --}}
                    <div class="input-group input-group-sm">
                        <select wire:model="bulkGatiStatus" class="form-select" style="max-width: 130px;">
                            <option value="">Gati Status</option>
                            <option value="1">Mark Done</option>
                            <option value="0">Mark In Progress</option>
                        </select>
                        <button wire:click="bulkUpdateGatiStatus" class="btn btn-warning">Update</button>
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

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0 bg-white" style="min-width: 1200px;">
                <thead class="bg-white border-bottom">
                    <tr class="text-muted extra-small text-uppercase fw-semibold">
                        <th style="width: 50px;" class="ps-4">
                            <input class="form-check-input" type="checkbox" wire:model.live="selectAll">
                        </th>
                        <th style="width: 200px;">DETAILS</th>
                        <th style="width: 200px;">DATE</th>
                        <th style="width: 200px;">DOCKET / PHONE</th>
                        <th style="width: 150px;">GATI STATUS</th>
                        <th style="width: 100px;" class="text-center">POD</th>
                        <th style="width: 150px;">STATUS</th>
                        <th style="width: 200px;">ASSIGN DRIVER</th>
                        <th style="width: 100px;" class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- Rows --}}
                    @forelse($deliveries as $delivery)
                        <tr>
                            <td class="ps-4">
                                <div class="form-check me-2">
                                    <input class="form-check-input" type="checkbox"
                                        wire:model.live="selectedDeliveries" value="{{ $delivery->id }}">
                                </div>
                            </td>
                            <td>
                                <div class="truncate">
                                    <strong class="extra-small d-block text-heading text-truncate"
                                        style="max-width: 150px;">{{ $delivery->customer_name }}</strong>
                                    <small class="text-muted d-block text-truncate extra-small"
                                        style="max-width: 150px;">{{ $delivery->company_name ?: 'No Company' }}</small>
                                </div>
                            </td>

                            {{-- Date --}}
                            <td>
                                <span class="text-dark extra-small">
                                    {{ $delivery->assigned_at ? $delivery->assigned_at->format('d M Y') : 'N/A' }}
                                </span>
                            </td>

                            {{-- Docket / Phone --}}
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-dark fw-bold extra-small">{{ $delivery->docket_number }}</span>
                                    <small class="text-muted extra-small"><i
                                            class="bx bx-phone-call me-1"></i>{{ $delivery->phone }}</small>
                                </div>
                            </td>

                            {{-- Gati Status --}}
                            <td>
                                <div class="form-check form-switch d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="gatiSwitch{{ $delivery->id }}"
                                        {{ $delivery->synced_to_third_party ? 'checked' : '' }}
                                        wire:click="toggleGatiStatus({{ $delivery->id }})">
                                    <label class="form-check-label extra-small" for="gatiSwitch{{ $delivery->id }}">
                                        {!! $delivery->synced_to_third_party
                                            ? '<span class="text-success fw-bold">Done</span>'
                                            : '<span class="text-warning fw-bold">In Progress</span>' !!}
                                    </label>
                                </div>
                            </td>

                            {{-- POD --}}
                            <td class="text-center">
                                @if ($delivery->pod_image)
                                    <a href="{{ $delivery->pod_image_url }}" target="_blank"
                                        class="btn btn-sm btn-icon btn-label-info">
                                        <i class="bx bx-image-alt fs-5"></i>
                                    </a>
                                @else
                                    <span class="text-muted opacity-50"><i class="bx bx-minus"></i></span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="d-flex align-items-center gap-1">
                                    <span class="badge badge-dot bg-{{ $delivery->status_color }}"></span>
                                    <span
                                        class="fw-bold text-uppercase extra-small text-{{ $delivery->status_color }}">
                                        {{ $delivery->status_text }}
                                    </span>
                                </span>
                            </td>

                            {{-- Driver Assignment --}}
                            <td>
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
                            </td>

                            {{-- Actions --}}
                            <td class="text-end pe-4">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-5 text-center">
                                <i class="bx bx-package display-3 text-muted opacity-50"></i>
                                <p class="text-muted mt-3 mb-0 fs-6">
                                    @if ($search)
                                        No deliveries found matching "{{ $search }}"
                                    @else
                                        No deliveries found
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($deliveries->hasPages())
            <div class="card-footer bg-white border-top py-3">
                {{ $deliveries->links() }}
            </div>
        @endif
    </div>

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('dateRange', dateStr);
                }
            });
        });
    </script>
@endpush
