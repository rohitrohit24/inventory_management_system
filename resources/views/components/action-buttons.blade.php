<div>
    <button type="{{ $type }}" class="btn {{ $variant }} {{ $custom }}"
        data-bs-toggle="{{ $modal }}" data-bs-target="#{{ $modalid }}"
        @if ($title) title="{{ $title }}" @endif>
        {{ $slot }}
    </button>
</div>
