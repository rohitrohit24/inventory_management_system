<div>
    @if ($isOpen)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" style="background: rgba(0,0,0,0.5); z-index: 1055;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-slate text-light">

                    <div class="modal-header bg-aside">
                        <h5 class="modal-title">
                            <i class="fas fa-edit me-2"></i> {{ $title }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>

                    <form wire:submit.prevent="update">
                        <div class="modal-body bg-aside" style="max-height: 75vh; overflow-y: auto;">

                            <div class="row g-3">
                                @foreach ($data as $key => $value)
                                    @if (in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at']))
                                        @continue
                                    @endif

                                    <div class="col-md-6">
                                        <label class="form-label text-capitalize fw-semibold text-secondary-light">
                                            {{ str_replace('_', ' ', $key) }}
                                        </label>

                                        <input type="text" class="form-control bg-dark text-light border-slate"
                                            wire:model="data.{{ $key }}">
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="modal-footer bg-aside">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-accent">
                                <i class="fas fa-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

