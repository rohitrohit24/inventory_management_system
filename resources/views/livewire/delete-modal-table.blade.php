<div>
    @if ($isOpen)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content  bg-aside  border-0 shadow">

                    <div class="text-end p-2">
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-aside text-center pt-0">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="stat-icon text-center bg-danger-subtle mb-3">
                                <i class="bi bi-exclamation-triangle text-danger" style="font-size: 2rem;"></i>
                            </div>
                        </div>

                        <h4 class="mb-2 fw-bold text-white">{{ $title }}</h4>

                        <p class="text-muted mb-4">{{ $message }}</p>
                    </div>

                    <div class="modal-footer d-flex justify-content-center border-0 pb-4">
                        <button type="button" class="btn btn-secondary px-4 me-2" wire:click="closeModal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger px-4" wire:click="delete">
                            Yes, Delete It!
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>

