<div>
    @if ($isOpen)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" style="background: rgba(0,0,0,0.5); z-index: 1060;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-slate text-light">
                    <div class="modal-header bg-aside">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Supplier</h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="update">
                        <div class="modal-body bg-aside" style="max-height: 75vh; overflow-y: auto;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Supplier Name</label>
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Company Name</label>
                                    <input type="text" class="form-control" wire:model="company_name">
                                    @error('company_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">GST Number</label>
                                    <input type="text" class="form-control" wire:model="gst_number">
                                    @error('gst_number')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Phone</label>
                                    <input type="text" class="form-control" wire:model="phone">
                                    @error('phone')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
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
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" wire:model="email">
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" class="form-control" wire:model="address">
                                    @error('address')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-aside">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"><i
                                    class="fas fa-times me-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-1"></i> Save
                                Supplier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

