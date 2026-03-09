<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Reasons List
    </h4>

    <div class="card">
        <h5 class="card-header border-bottom mb-3 text-danger">
            <i class="bx bx-error-circle me-1"></i> Undelivered Reasons Master
        </h5>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <form wire:submit.prevent="addReason" class="d-flex flex-column flex-sm-row gap-2">
                        <input type="text" wire:model="newReason" class="form-control"
                            placeholder="Type a new failure reason..." required>
                        <button type="submit" class="btn btn-primary text-nowrap">
                            <i class="bx bx-plus me-1"></i> Add Reason
                        </button>
                    </form>
                    @error('newReason')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="list-group list-group-flush">
                @foreach ($reasons as $index => $reason)
                    <div class="list-group-item d-flex align-items-center bg-light mb-2 rounded border-0">
                        <span class="badge bg-label-secondary me-3 rounded p-2 text-muted">{{ $loop->iteration }}</span>
                        <span class="fw-semibold text-heading flex-grow-1">{{ $reason->title }}</span>
                        <button type="button" class="btn btn-icon btn-sm btn-label-danger"
                            onclick="confirmDelete('{{ $reason->id }}', '{{ $reason->title }}')">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="alert alert-primary d-flex align-items-center mt-4" role="alert">
                <i class="bx bxs-info-circle me-2"></i>
                <div>
                    <h6 class="alert-heading mb-1 text-primary">Why this master matters?</h6>
                    <small>Standardized failure reasons help in generating monthly performance reports and identifying
                        root causes in specific logistics routes.</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function confirmDelete(id, title) {
            Swal.fire({
                title: 'Delete Reason?',
                text: `Are you sure you want to delete "${title}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteReason', id);
                }
            });
        }
    </script>
@endpush