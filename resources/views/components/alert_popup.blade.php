<div class="modal fade" id="{{ $popupid }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-none">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{ $title }}</h1>
            </div> --}}
            <div class="text-end p-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="stat-icon text-center mb-2">
                        <i class="{{ $icon }} {{ $iconColor ?? '' }} {{ $iconBg ?? '' }}"></i>
                    </div>
                </div>
                <h5>{{ $title }}</h5>
                {{ $slot }}
            </div>
            <div class="modal-footer d-flex justify-content-center ailgn-items-center">
                {{ $popup_button }}
            </div>
        </div>
    </div>
</div>
