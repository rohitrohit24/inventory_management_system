<div>
    @if ($isOpen)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content  border-slate text-light">

                    <div class="modal-header bg-aside">
                        <h5 class="modal-title">
                            <i class="fas fa-edit me-2"></i> Edit Product
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>

                    <form wire:submit.prevent="update">
                        <div class="modal-body bg-aside" style="max-height: 75vh; overflow-y: auto;">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input type="text" class="form-control" wire:model="name"
                                        placeholder="Enter product name">
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Category</label>
                                    <select class="form-select" wire:model="category">
                                        <option value="">Select Category</option>

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">SKU (Stock Keeping Unit)</label>
                                    <input type="text" class="form-control" wire:model="sku" placeholder="Enter SKU">
                                    @error('sku')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Barcode</label>
                                    <input type="text" class="form-control" wire:model="barcode"
                                        placeholder="Enter barcode">
                                    @error('barcode')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Cost Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" step="0.01" class="form-control"
                                            wire:model="cost_price" placeholder="0.00">
                                    </div>
                                    @error('cost_price')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tax Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control" wire:model="tax_rate"
                                            placeholder="0.00">
                                    </div>
                                    @error('tax_rate')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Selling Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" step="0.01" class="form-control"
                                            wire:model="selling_price" placeholder="0.00">
                                    </div>
                                    @error('selling_price')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Quantity (Stock)</label>
                                    <input type="number" class="form-control" wire:model="quantity" placeholder="0">
                                    @error('quantity')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Alert Quantity</label>
                                    <input type="number" class="form-control" wire:model="alert_quantity"
                                        placeholder="Low stock alert limit">
                                    @error('alert_quantity')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
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
                                    <textarea class="form-control" wire:model="description" rows="3" placeholder="Enter product details..."></textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer bg-aside">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save me-1"></i> Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
