<div class="container-xxl flex-grow-1 container-p-y">
    @include('admin.partials.account-tabs')
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control" wire:model.defer="name">
                </div>

                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input class="form-control" wire:model.defer="email">
                </div>

                <button class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>