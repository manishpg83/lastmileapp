@extends('layouts.app')

@section('content')
<div class="container-xxl container-p-y">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-1">Upload Data Sheet</h4>
            <p class="text-body-secondary mb-4">Upload your Excel or CSV file containing customer names, dockets, and addresses.</p>

            @if (session('message'))
                <div class="alert alert-{{ session('messageType', 'info') }} alert-dismissible mb-4" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="border border-2 border-dashed rounded p-5 mb-4 text-center">
                    <input type="file"
                           name="file"
                           id="upload-file"
                           accept=".xlsx,.xls,.csv"
                           class="d-none"
                           required>
                    <i class="bx bx-file-blank bx-lg text-body-secondary mb-3 d-block"></i>
                    <p class="mb-2">Click or drag file to this area</p>
                    <p class="text-body-secondary small mb-3">Support for .xlsx, .xls, .csv (Max 10MB)</p>
                    <label for="upload-file" class="btn btn-primary">Select File</label>
                    <p class="text-muted small mt-2 mb-0" id="file-name"></p>
                    @error('file')
                        <p class="text-danger small mt-2 mb-0">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="mb-3">Required Columns</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Docket Number
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Customer Name
                            </li>
                             <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Company Name
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Delivery Address
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Phone Number
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Pincode
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Pkg
                            </li>
                        </ul>
                        <p class="small text-body-secondary mt-2">
                            <a href="{{ asset('demo-deliveries.xlsx') }}" download class="text-primary">Download sample Excel</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Instructions</h6>
                        <p class="text-body-secondary small mb-0">
                            Ensure all required fields are present in the first sheet. First row must be the header with exact column names. Systems will auto-assign "Pending" status to all records.
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-upload me-1"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('upload-file').addEventListener('change', function () {
    var name = this.files.length ? this.files[0].name : '';
    document.getElementById('file-name').textContent = name ? '\u2713 ' + name : '';
});
</script>
@endpush
@endsection
