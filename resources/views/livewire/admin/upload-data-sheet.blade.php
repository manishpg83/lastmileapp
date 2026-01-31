<div class="container-xxl container-p-y">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-1">Upload Data Sheet</h4>
            <p class="text-body-secondary mb-4">Upload your Excel or CSV file containing customer names, dockets, and addresses.</p>

            @if ($message)
                <div class="alert alert-{{ $messageType }} alert-dismissible mb-4" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form wire:submit.prevent="upload">
                <div class="border border-2 border-dashed rounded p-5 mb-4 text-center"
                     x-data="{ dragging: false }"
                     x-on:dragover.prevent="dragging = true"
                     x-on:dragleave.prevent="dragging = false"
                     x-on:drop.prevent="dragging = false">
                    <input type="file"
                           x-ref="fileInput"
                           wire:model="file"
                           accept=".xlsx,.xls,.csv"
                           class="d-none"
                           id="upload-file">
                    <i class="bx bx-file-blank bx-lg text-body-secondary mb-3 d-block"></i>
                    <p class="mb-2">Click or drag file to this area</p>
                    <p class="text-body-secondary small mb-3">Support for .xlsx, .xls, .csv (Max 10MB)</p>
                    <label for="upload-file" class="btn btn-primary">Select File</label>
                    @error('file')
                        <p class="text-danger small mt-2 mb-0">{{ $message }}</p>
                    @enderror
                    @if ($file)
                        <p class="text-success small mt-2 mb-0" wire:loading.remove wire:target="file">
                            <i class="bx bx-check-circle me-1"></i> {{ $file->getClientOriginalName() }}
                        </p>
                    @endif
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="mb-3">Required Columns</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Customer Name
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bx bx-check-circle text-success me-2"></i>
                                Docket Number
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
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Instructions</h6>
                        <p class="text-body-secondary small mb-0">
                            Ensure all required fields are present in the first sheet. Systems will auto-assign "Pending" status to all records.
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                            class="btn btn-primary"
                            wire:loading.attr="disabled"
                            wire:target="upload,file"
                            @disabled(!$file)>
                        <span wire:loading.remove wire:target="upload">
                            <i class="bx bx-upload me-1"></i> Upload
                        </span>
                        <span wire:loading wire:target="upload">Processing…</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
