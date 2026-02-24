<div class="container-xxl container-p-y">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <h4 class="mb-0 fw-bold">
                Driver Logs : <span class="badge ms-1" style="background-color: #0d9488;">{{ $driver->name }}</span>
            </h4>
            <div class="d-flex gap-2 align-items-center">
                <input type="date" wire:model.live="dateFrom" class="form-control" placeholder="From Date">
                <span>to</span>
                <input type="date" wire:model.live="dateTo" class="form-control" placeholder="To Date">
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Trip Time</th>
                            <th>Images</th>
                            <th>Start KM</th>
                            <th>End KM</th>
                            <th>Total Distance</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trips as $index => $trip)
                            <tr class="align-middle">
                                <td>{{ $trip['date'] ?? '' }}</td>
                                <td>
                                    <div class="d-flex flex-column align-items-center">
                                        @if ($trip['start'])
                                            <small class="text-success fw-bold">
                                                <i class="bx bx-up-arrow-alt"></i>
                                                {{ $trip['start']->created_at->format('H:i') }}
                                            </small>
                                        @endif

                                        @if ($trip['end'])
                                            <small class="text-danger fw-bold">
                                                <i class="bx bx-down-arrow-alt"></i>
                                                {{ $trip['end']->created_at->format('H:i') }}
                                            </small>
                                        @else
                                            <small class="text-muted small">Ongoing...</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        @if ($trip['start'] && $trip['start']->image)
                                            <a href="{{ Storage::url('driver_logs/' . $trip['start']->image) }}"
                                                target="_blank" class="btn btn-icon btn-label-success"
                                                title="View Start Photo">
                                                <i class="bx bx-image-alt"></i>
                                            </a>
                                        @endif
                                        @if ($trip['end'] && $trip['end']->image)
                                            <a href="{{ Storage::url('driver_logs/' . $trip['end']->image) }}"
                                                target="_blank" class="btn btn-icon btn-label-danger"
                                                title="View End Photo">
                                                <i class="bx bx-image-alt"></i>
                                            </a>
                                        @elseif ($trip['end'])
                                            <span class="text-muted small align-self-center">No Pic</span>
                                        @elseif (!$trip['end'])
                                            <span class="badge bg-label-warning text-uppercase align-self-center"
                                                style="font-size: 0.65rem;">Active</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="width: 120px;">
                                    @if ($trip['start'])
                                        <input type="number" step="0.01"
                                            class="form-control form-control-sm text-center fw-bold border-success-subtle"
                                            wire:model="kmInputs.{{ $trip['start']->id }}" placeholder="Start KM">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td style="width: 120px;">
                                    @if ($trip['end'])
                                        <input type="number" step="0.01"
                                            class="form-control form-control-sm text-center fw-bold border-danger-subtle"
                                            wire:model="kmInputs.{{ $trip['end']->id }}" placeholder="End KM">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($trip['end'] && $trip['end']->distance !== null)
                                        <div class="d-flex flex-column align-items-center">
                                            <span
                                                class="fw-bold text-primary">{{ number_format($trip['end']->distance, 2) }}
                                                km</span>
                                        </div>
                                    @elseif ($trip['end'])
                                        <span class="badge bg-label-secondary" style="font-size: 0.65rem;">Needs
                                            KM</span>
                                    @else
                                        <span class="text-muted small">Ongoing</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($trip['start'] && $trip['end'])
                                        @php
                                            $diff = $trip['start']->created_at->diff($trip['end']->created_at);
                                            $h = $diff->h + $diff->days * 24;
                                            $duration = $h . 'h ' . $diff->i . 'm';
                                        @endphp
                                        <span class="text-dark fw-medium small">{{ $duration }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($trip['start'])
                                        <button class="btn btn-sm btn-primary"
                                            wire:click="verifyTrip({{ $trip['start']->id }}, {{ isset($trip['end']) ? $trip['end']->id : 'null' }})">
                                            Save
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center p-5">
                                    <p class="text-muted mb-0">No driver logs found for the selected period.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pagination->links() }}
            </div>
        </div>
    </div>
</div>
