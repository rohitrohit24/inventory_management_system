<div>
    <button type="{{ $type ?? 'submit' }}" @if ($modal) data-bs-toggle="{{ $modal }}" @endif
        @if ($modalid) data-bs-target="{{ $modalid }}" @endif
        class="btn btn-accent {{ $variant }} {{ $custom }}">

        @if ($icon)
            <i class="{{ $icon }} pe-1"></i>
        @endif

        {{ $slot->isEmpty() ? 'Submit' : $slot }}

    </button>
</div>
