<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Today's Active Shipments</h5>
            <small class="text-muted">Displaying {{ $shipments->total() }} assigned shipments for today</small>
        </div>
        <div class="d-flex gap-2">
            <button wire:click="export" wire:loading.attr="disabled" class="btn btn-label-secondary btn-sm">
                <span wire:loading.remove>Export XLS</span>
                <span wire:loading>Exporting...</span>
            </button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr class="text-uppercase small fw-bold">
                    <th class="ps-4">CUSTOMER</th>
                    <th>DOCKET #</th>
                    <th>PINCODE</th>
                    <th>DRIVER</th>
                    <th>DELIVERY STATUS</th>
                    <th>GATI STATUS</th>
                    <th>POD</th>
                    <th class="pe-4">UPDATED</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($shipments as $shipment)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex flex-column">
                                <span class="fw-medium text-heading">{{ $shipment->customer_name }}</span>
                                <small class="text-warning">{{ $shipment->phone }}</small>
                            </div>
                        </td>
                        <td><span class="text-heading fw-medium">{{ $shipment->docket_number }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class='bx bx-map me-1 text-muted'></i>
                                <span>{{ $shipment->pincode }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        {{ substr($shipment->driver->name, 0, 1) }}
                                    </span>
                                </div>
                                <span class="fw-medium">{{ $shipment->driver->name }}</span>
                            </div>
                        </td>
                        <td>
                            @switch($shipment->status)
                                @case('delivered')
                                    <span class="badge bg-label-success">DELIVERED</span>
                                @break

                                @case('undelivered')
                                    <span class="badge bg-label-danger">UNDELIVERED</span>
                                @break

                                @case('pending')
                                    <span class="badge bg-label-warning">PENDING</span>
                                @break

                                @case('assigned')
                                    <span class="badge bg-label-info">ASSIGNED</span>
                                @break

                                @case('passed')
                                    <span class="badge bg-label-secondary">PASSED</span>
                                @break

                                @default
                                    <span
                                        class="badge bg-label-dark">{{ strtoupper(str_replace('_', ' ', $shipment->status)) }}</span>
                            @endswitch
                        </td>
                        <td>
                            @if ($shipment->status === 'delivered')
                                <span class="badge bg-success rounded-pill">
                                    <i class='bx bx-check me-1'></i> Done
                                </span>
                            @else
                                <span class="badge bg-label-warning rounded-pill">
                                    <i class='bx bx-refresh me-1'></i> In Progress
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($shipment->hasPOD())
                                <a href="{{ $shipment->pod_image_url }}" target="_blank"
                                    class="badge bg-dark rounded px-2 text-white">POD</a>
                            @else
                                <div class="avatar avatar-xs">
                                    <span class="avatar-initial rounded-circle bg-label-secondary">
                                        <i class='bx bx-time'></i>
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="pe-4"><span
                                class="text-muted">{{ $shipment->updated_at?->format('h:i A') ?? '-' }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $shipments->links() }}
    </div>
</div>
