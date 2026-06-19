<div class="container-xxl container-p-y">


    {{-- Alert Messages --}}
    @if (session()->has('message'))
        <div class="alert alert-{{ session('messageType') }} alert-dismissible fade show" role="alert">
            <i class="bx {{ session('messageType') == 'success' ? 'bx-check-circle' : 'bx-error-circle' }} me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card deliveries-wrap">

        {{-- ── Card Header ── --}}
        <div class="card-header d-flex flex-row justify-content-between align-items-center gap-2">
            <div>
                <h4 class="mb-0 fw-bold">Deliveries</h4>
                <small class="text-muted">Manage all shipments and assignments</small>
            </div>

            <div class="header-filters">

                {{-- Date Range Filter --}}
                <div class="input-group date-group" wire:ignore>
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="text" id="dateRangePicker" class="form-control" placeholder="Select Date Range">
                    <button type="button" class="btn btn-outline-secondary" id="resetDate">Reset</button>
                </div>

                {{-- Search Box --}}
                <div class="input-group search-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                        placeholder="Search deliveries...">
                    @if ($search)
                        <button wire:click="$set('search', '')" class="btn btn-outline-secondary" type="button">
                            <i class="bx bx-x"></i>
                        </button>
                    @endif
                </div>

                {{-- Buttons --}}
                <a href="{{ route('uploads.index') }}" class="btn btn-label-success text-nowrap">
                    <i class="bx bx-upload me-1"></i> Upload Excel
                </a>
                <a href="{{ route('deliveries.create') }}" class="btn btn-primary text-nowrap">
                    <i class="bx bx-plus me-1"></i> Add Delivery
                </a>

            </div>
        </div>

        {{-- ── Bulk Action Bar ── --}}
        @if (count($selectedDeliveries) > 0)
            <div class="card-body border-top bg-white py-2">
                <div class="d-flex flex-row align-items-center gap-3 overflow-auto mb-2 mt-2">

                    {{-- Assign Driver --}}
                    <div class="input-group input-group-sm">
                        <select wire:model="bulkDriverId" class="form-select" style="max-width: 140px;">
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
                        <select wire:model="bulkStatus" class="form-select" style="max-width: 120px;">
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
                        <select wire:model="bulkGatiStatus" class="form-select" style="max-width: 120px;">
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
            </div>
        @endif

        {{-- ── Table ── --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 bg-white" style="width: 100%; table-layout: fixed;">
                <thead class="bg-white border-bottom">
                    <tr class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">
                        <th style="width: 5%;" class="ps-4">
                            <input class="form-check-input" type="checkbox" wire:model.live="selectAll">
                        </th>
                        <th style="width: 13%;">DETAILS</th>
                        <th style="width: 8%;">DATE</th>
                        <th style="width: 14%;">DOCKET / PHONE</th>
                        <th style="width: 5%;" class="text-center">PKG</th>
                        <th style="width: 13%;">PARTNER STATUS</th>
                        <th style="width: 7%;" class="text-center">POD</th>
                        <th style="width: 14%;">DELIVERY STATUS</th>
                        <th style="width: 11%;">ASSIGN DRIVER</th>
                        <th style="width: 10%;" class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">

                    @forelse($deliveries as $delivery)
                        <tr wire:key="delivery-{{ $delivery->id }}">
                            {{-- Checkbox --}}
                            <td class="ps-4">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectedDeliveries"
                                    value="{{ $delivery->id }}">
                            </td>

                            {{-- Details --}}
                            <td class="col-details">
                                <strong>{{ $delivery->customer_name }}</strong>
                                <small>{{ $delivery->company_name ?: 'No Company' }}</small>
                            </td>

                            {{-- Date --}}
                            <td>
                                {{ $delivery->assigned_at ? $delivery->assigned_at->format('d M Y') : 'N/A' }}
                            </td>

                            {{-- Docket / Phone --}}
                            <td>
                                <span class="d-block">{{ $delivery->docket_number }}</span>
                                <small class="text-muted">
                                    <i class="bx bx-phone-call me-1"></i>{{ $delivery->phone ?: '—' }}
                                </small>
                            </td>

                            {{-- Package --}}
                            <td>{{ $delivery->package }}</td>

                            {{-- Partner / Gati Status --}}
                            <td>
                                <div class="form-check form-switch d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="gatiSwitch{{ $delivery->id }}"
                                        {{ $delivery->synced_to_third_party ? 'checked' : '' }}
                                        wire:click="toggleGatiStatus({{ $delivery->id }})">
                                    <label class="form-check-label" for="gatiSwitch{{ $delivery->id }}">
                                        @if ($delivery->synced_to_third_party)
                                            <span class="text-success">Done</span>
                                        @else
                                            <span class="text-warning">In Progress</span>
                                        @endif
                                    </label>
                                </div>
                            </td>

                            {{-- POD --}}
                            <td class="text-center">
                                @if ($delivery->pod_image)
                                    <a href="{{ $delivery->pod_image_url }}" target="_blank"
                                        class="btn btn-sm btn-icon btn-label-info">
                                        <i class="bx bx-image-alt"></i>
                                    </a>
                                @else
                                    <span class="text-muted opacity-50">—</span>
                                @endif
                            </td>

                            {{-- Delivery Status --}}
                            <td>
                                <span class="d-flex align-items-center gap-1">
                                    <span class="badge-dot bg-{{ $delivery->status_color }}"></span>
                                    <span class="text-{{ $delivery->status_color }}">
                                        {{ $delivery->status_text }}
                                    </span>
                                </span>
                            </td>

                            {{-- Assign Driver --}}
                            <td>
                                <select class="form-select form-select-sm driver-select"
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
                                    {{-- <button wire:click="delete({{ $delivery->id }})" wire:confirm="Are you sure?"
                                        class="btn btn-sm btn-icon btn-label-danger" title="Delete">
                                        <i class="bx bx-trash"></i>
                                    </button> --}}
                                    <button type="button" class="btn btn-icon btn-sm btn-label-danger"
                                        onclick="confirmDelete('{{ $delivery->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-5 text-center">
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

        <div
            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Show</span>
                <select class="form-select form-select-sm" wire:model.live="perPage" style="width: auto;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="text-muted small">entries</span>
            </div>

            @if ($deliveries->hasPages())
                <div>
                    {{ $deliveries->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@push('scripts')
    <style>
        /* ── Deliveries Table – matches 100% zoom layout ── */

        /* Table cell spacing – reduced vertical padding so rows are tighter but text is readable */
        .deliveries-wrap .table th,
        .deliveries-wrap .table td {
            padding: 0.6rem 0.65rem !important;
            font-size: 0.82rem !important;
            white-space: nowrap;
            vertical-align: middle;
        }

        .deliveries-wrap .table th.ps-4,
        .deliveries-wrap .table td.ps-4 {
            padding-left: 1rem !important;
        }

        .deliveries-wrap .table th.pe-4,
        .deliveries-wrap .table td.pe-4 {
            padding-right: 1rem !important;
        }

        /* thead label size */
        .deliveries-wrap thead tr {
            font-size: 0.7rem !important;
        }

        /* No horizontal scroll */
        .deliveries-wrap .table-responsive {
            overflow-x: hidden !important;
        }

        /* Customer name + company truncation */
        .deliveries-wrap .col-details strong {
            display: block;
            max-width: 145px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.82rem;
        }

        .deliveries-wrap .col-details small {
            display: block;
            max-width: 145px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.75rem;
            color: #9b9bab;
        }

        /* Driver select */
        .deliveries-wrap .driver-select {
            max-width: 130px !important;
            font-size: 0.8rem !important;
            padding: 0.25rem 0.5rem !important;
        }

        /* Action icon buttons */
        .deliveries-wrap .btn-icon {
            width: 1.75rem !important;
            height: 1.75rem !important;
            padding: 0 !important;
            font-size: 0.85rem !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Status badge dot */
        .deliveries-wrap .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        /* Card header – single compact line */
        .deliveries-wrap .card-header {
            padding: 0.5rem 1rem !important;
            flex-wrap: nowrap !important;
            gap: 0.5rem !important;
        }

        .deliveries-wrap .card-header h4 {
            font-size: 1.5rem !important;
            white-space: nowrap;
        }

        .deliveries-wrap .card-header small {
            font-size: 0.9rem !important;
            white-space: nowrap;
        }

        /* Header filters row */
        .deliveries-wrap .header-filters {
            display: flex;
            flex-wrap: nowrap;
            gap: 0.4rem;
            align-items: center;
        }

        .deliveries-wrap .header-filters .date-group {
            min-width: 200px;
            max-width: 210px;
        }

        .deliveries-wrap .header-filters .date-group .form-control,
        .deliveries-wrap .header-filters .date-group .btn,
        .deliveries-wrap .header-filters .date-group .input-group-text {
            font-size: 0.78rem !important;
            padding: 0.3rem 0.5rem !important;
        }

        .deliveries-wrap .header-filters .search-group {
            min-width: 175px;
            max-width: 210px;
            flex: 1;
        }

        .deliveries-wrap .header-filters .search-group .form-control,
        .deliveries-wrap .header-filters .search-group .input-group-text {
            font-size: 0.78rem !important;
            padding: 0.3rem 0.5rem !important;
        }

        .deliveries-wrap .header-filters .btn {
            font-size: 0.78rem !important;
            padding: 0.3rem 0.65rem !important;
        }
    </style>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Delete Delivery?',
                text: 'Are you sure you want to delete this delivery?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', id);
                }
            });
        }
        document.addEventListener('livewire:initialized', () => {
            const resetBtn = document.getElementById('resetDate');
            const picker = flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('dateRange', dateStr);
                }
            });

            resetBtn.addEventListener('click', function() {
                picker.clear();
                @this.set('dateRange', null);
            });
        });
    </script>
@endpush
