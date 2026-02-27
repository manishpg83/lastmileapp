<div class="container-xxl container-p-y">
    <div class="card driver-report-wrap">
        <div class="card-header border-bottom">
            <h4 class="card-title mb-0">Driver Wise Report (Daily Logs)</h4>
        </div>

        <div class="card-body mt-3">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Search Driver</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control form-control-sm"
                            wire:model.live.debounce.500ms="search" placeholder="Driver name...">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold">Date Range</label>
                    <input type="text" class="form-control form-control-sm flatpickr" wire:model.live="dateRange"
                        placeholder="Select date range" id="dateRangePicker">
                </div>

                <div class="col-md-4">
                    <div wire:ignore>
                        <label class="form-label small fw-bold">Select Drivers</label>
                        <select class="form-select select2" wire:model.live="selectedDrivers" multiple
                            id="driversSelect" data-placeholder="Select Multiple Drivers">
                            @foreach ($driversList as $drv)
                                <option value="{{ $drv->id }}">{{ $drv->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-sm btn-label-secondary w-100" wire:click="resetFilters">
                        <i class="bx bx-reset me-1"></i> Reset
                    </button>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold">Duration (Hrs) Limit</label>
                    <div class="input-group input-group-sm">
                        <input type="number" step="0.1" class="form-control"
                            wire:model.live.debounce.500ms="minHours" placeholder="Min">
                        <input type="number" step="0.1" class="form-control"
                            wire:model.live.debounce.500ms="maxHours" placeholder="Max">
                        <span class="input-group-text">Hrs</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold">Distance (KM) Limit</label>
                    <div class="input-group input-group-sm">
                        <input type="number" step="0.1" class="form-control" wire:model.live.debounce.500ms="minKm"
                            placeholder="Min">
                        <input type="number" step="0.1" class="form-control" wire:model.live.debounce.500ms="maxKm"
                            placeholder="Max">
                        <span class="input-group-text">KM</span>
                    </div>
                </div>

                <div class="col-md-4 text-end d-flex justify-content-end gap-2 align-items-end">
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
                        <th>Date</th>
                        <th>Hours Logged</th>
                        <th>Distance (KM)</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" wire:loading.class="opacity-50">
                    @forelse($reportData as $row)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <span class="avatar-initial rounded-circle bg-label-primary">
                                            {{ substr($row->driver_name, 0, 2) }}
                                        </span>
                                    </div>
                                    <span class="fw-medium">{{ $row->driver_name }}</span>
                                </div>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->log_date)->format('M d, Y') }}
                            </td>

                            <td>
                                {{ $row->formatted_hours }} ({{ $row->hours }}h)
                            </td>

                            <td>
                                <strong>{{ number_format($row->km, 2) }} km</strong>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bx bx-time-five fs-1 text-muted mb-3"></i>
                                    <h5>No logs found</h5>
                                    <p class="text-muted">Adjust your filters or date range.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-white fw-bold border-2">
                    <tr>
                        <td colspan="2" class="text-end">Page Total:</td>
                        <td>{{ $totals['formatted_hours'] }} ({{ $totals['hours'] }}h)</td>
                        <td><strong>{{ number_format($totals['km'], 2) }} km</strong></td>
                    </tr>
                </tfoot>
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

            @if ($reportData->hasPages())
                <div>
                    {{ $reportData->links() }}
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

        // Bind Select2 to Livewire
        $('#driversSelect').on('change', function(e) {
            var data = $(this).val();
            $wire.set('selectedDrivers', data);
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
