<div>
    @if ($isOpen)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-slate text-light bg-aside">

                    <div class="modal-header border-secondary">
                        <h5 class="modal-title">
                            <i class="bi bi-currency-rupee text-info me-2"></i> Update Invoice Payment
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>

                    <form wire:submit.prevent="updatePayment">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Purchases Date</label>
                                <input type="date" class="form-control bg-dark text-white border-secondary"
                                    wire:model="purchases_date" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Total Amount (₹)</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary"
                                    wire:model="total_amount" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-info">Paid Amount (₹)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-info border-info">₹</span>
                                    <input type="number" step="0.01"
                                        class="form-control bg-dark text-white border-info"
                                        wire:model.live="paid_amount" placeholder="Enter amount to pay">
                                </div>
                                @error('paid_amount')
                                    <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-warning">Due Amount (₹)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary">₹</span>
                                    <input type="number" class="form-control bg-dark text-white border-secondary"
                                        wire:model="due_amount" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-info px-4 text-white">
                                <i class="fas fa-save me-1"></i> Save Payment
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>

