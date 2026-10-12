<div>
    @if ($isOpen)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" style="background: rgba(0,0,0,0.5); z-index: 1060;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-slate text-light">
                    <div class="modal-header bg-aside">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Category</h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="update">
                        <div class="modal-body bg-aside" style="max-height: 75vh; overflow-y: auto;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Category Name</label>
                                    <input type="text" class="form-control" wire:model="name"
                                        placeholder="Enter category name">
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select class="form-select" wire:model="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea class="form-control" wire:model="description" rows="3" placeholder="Enter description..."></textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-aside">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"><i
                                    class="fas fa-times me-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Save
                                Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

