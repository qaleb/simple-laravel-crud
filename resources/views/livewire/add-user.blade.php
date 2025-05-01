<div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">{{ $updateMode ? 'Edit User' : 'Add User' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Favourite Color</label>
                        <input type="text" wire:model="favourite_color" class="form-control">
                        @error('favourite_color') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $updateMode ? 'Update' : 'Save' }}
                    </button>
                    @if($updateMode)
                    <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>