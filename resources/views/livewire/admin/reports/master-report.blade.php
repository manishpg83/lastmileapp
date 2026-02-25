<style>
    .master-report-wrap .table th,
    .master-report-wrap .table td {
        font-size: 0.9rem !important;
        padding: 0.45rem 0.65rem !important;
        vertical-align: middle;
    }

    .master-report-wrap .table thead th {
        font-size: 0.9rem !important;
        text-transform: uppercase;
        font-weight: 600;
        color: #6c757d;
        white-space: nowrap;
    }

    .master-report-wrap .badge {
        font-size: 0.7rem !important;
    }

    .master-report-wrap .avatar-sm {
        width: 1.6rem !important;
        height: 1.6rem !important;
        font-size: 0.65rem !important;
    }
</style>

<div class="container-xxl container-p-y">
    <div class="card master-report-wrap">
        <div class="card-header border-bottom">
            <h4 class="card-title mb-0">Master Report</h4>
        </div>

        <div class="card-body mt-3">
            <div class="row g-3">
                <!-- Search and Primary Filters -->
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Search Deliveries</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control form-control-sm"
                            wire:model.live.debounce.500ms="search" placeholder="Docket, Phone, Pincode...">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold">Date Range</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                        <input type="text" class="form-control form-control-sm flatpickr" wire:model.live="dateRange"
                            placeholder="Select date range" id="dateRangePicker">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold">Min Packets</label>
                    <input type="number" class="form-control form-control-sm"
                        wire:model.live.debounce.500ms="minPackets" placeholder="Min">
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold">Max Packets</label>
                    <input type="number" class="form-control form-control-sm"
                        wire:model.live.debounce.500ms="maxPackets" placeholder="Max">
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold">Partner Status</label>
                    <select class="form-select form-select-sm" wire:model.live="partnerStatus">
                        <option value="">All Status</option>
                        <option value="1">Synced</option>
                        <option value="0">Not Synced</option>
                    </select>
                </div>

                <!-- Multi-select Filters -->
                <div class="col-md-3">
                    <div wire:ignore>
                        <label class="form-label small fw-bold">Filter Customers</label>
                        <select class="form-select select2" wire:model.live="selectedCustomers" multiple
                            id="customersSelect" data-placeholder="Choose Customers">
                            @foreach ($customers as $customer)
                                @if ($customer)
                                    <option value="{{ $customer }}">{{ $customer }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div wire:ignore>
                        <label class="form-label small fw-bold">Filter Companies</label>
                        <select class="form-select select2" wire:model.live="selectedCompanies" multiple
                            id="companiesSelect" data-placeholder="Choose Companies">
                            @foreach ($companies as $company)
                                @if ($company)
                                    <option value="{{ $company }}">{{ $company }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div wire:ignore>
                        <label class="form-label small fw-bold">Filter Drivers</label>
                        <select class="form-select select2" wire:model.live="selectedDrivers" multiple
                            id="driversSelect" data-placeholder="Choose Drivers">
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver['id'] }}">{{ $driver['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div wire:ignore>
                        <label class="form-label small fw-bold">Delivery Status</label>
                        <select class="form-select select2" wire:model.live="selectedStatuses" multiple
                            id="statusesSelect" data-placeholder="Choose Statuses">
                            <option value="pending">Pending</option>
                            <option value="assigned">Assigned</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="undelivered">Undelivered</option>
                            <option value="passed">Passed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 text-end d-flex justify-content-end gap-2 mt-2">
                    <button class="btn btn-sm btn-label-secondary" wire:click="resetFilters">
                        <i class="bx bx-reset me-1"></i> Reset
                    </button>
                    <div class="vr mx-2"></div>
                    <button class="btn btn-sm btn-label-success" wire:click="export('excel')">
                        <i class="bx bxs-file-export me-1"></i> Excel
                    </button>
                    <button class="btn btn-sm btn-label-info" wire:click="export('csv')">
                        <i class="bx bx-file me-1"></i> CSV
                    </button>
                    <button class="btn btn-sm btn-label-danger" wire:click="export('pdf')">
                        <i class="bx bxs-file-pdf me-1"></i> PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap mt-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Driver Name</th>
                        <th>Customer Name</th>
                        <th>Company Name</th>
                        <th>Docket Number</th>
                        <th>Packets</th>
                        <th>Phone</th>
                        <th>Pincode</th>
                        <th>Delivery Date</th>
                        <th>Passed By</th>
                        <th>Partner Status</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" wire:loading.class="opacity-50">
                    @forelse($deliveries as $delivery)
                        <tr>
                            <td>
                                @if ($delivery->driver)
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                {{ substr($delivery->driver->name, 0, 2) }}
                                            </span>
                                        </div>
                                        <span class="fw-medium">{{ $delivery->driver->name }}</span>
                                    </div>
                                @else
                                    <span class="badge bg-label-secondary">Unassigned</span>
                                @endif
                            </td>
                            <td>{{ $delivery->customer_name ?? '-' }}</td>
                            <td>{{ $delivery->company_name ?? '-' }}</td>
                            <td><strong>{{ $delivery->docket_number }}</strong></td>
                            <td>{{ $delivery->package ?? '-' }}</td>
                            <td>{{ $delivery->phone ?? '-' }}</td>
                            <td>{{ $delivery->pincode ?? '-' }}</td>
                            <td>
                                @if ($delivery->delivered_at)
                                    {{ $delivery->delivered_at->format('M d, Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @php
                                    $passedBy = '-';
                                    if ($delivery->status === 'passed') {
                                        $passedLog = $delivery->statusHistory->where('new_status', 'passed')->first();
                                        if ($passedLog && $passedLog->changed_by) {
                                            $user = \App\Models\User::find($passedLog->changed_by);
                                            $passedBy = $user ? $user->name : 'Unknown';
                                        }
                                    }
                                @endphp
                                {{ $passedBy }}
                            </td>
                            <td>
                                @if ($delivery->synced_to_third_party)
                                    <span class="badge bg-label-success">Synced</span>
                                @else
                                    <span class="badge bg-label-warning">Not Synced</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-label-{{ $delivery->status_color }}">
                                    {{ $delivery->status_text }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bx bx-file fs-1 text-muted mb-3"></i>
                                    <h5>No deliveries found</h5>
                                    <p class="text-muted">Adjust your filters to see more results.</p>
                                </div>
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

@script
    <script>
        // Initialize date picker
        flatpickr("#dateRangePicker", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                $wire.set('dateRange', dateStr);
            }
        });

        // Initialize Select2 with Bootstrap 5 theme
        const initSelect2 = () => {
            $('.select2').each(function() {
                $(this).select2({
                    theme: 'bootstrap-5',
                    placeholder: $(this).data('placeholder') || 'Select options',
                    allowClear: true,
                    closeOnSelect: false,
                    width: '100%'
                });
            });
        };

        initSelect2();

        // Bind Select2 sets to Livewire
        $(document).on('change', '.select2', function(e) {
            var id = $(this).attr('id');
            var data = $(this).val();

            if (id === 'customersSelect') $wire.set('selectedCustomers', data);
            if (id === 'companiesSelect') $wire.set('selectedCompanies', data);
            if (id === 'driversSelect') $wire.set('selectedDrivers', data);
            if (id === 'statusesSelect') $wire.set('selectedStatuses', data);
        });

        // Re-initialize plugins after Livewire update
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initSelect2();
        });
    </script>
@endscript
