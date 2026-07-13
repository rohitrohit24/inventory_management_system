@props([
    'variant' => 'accent',
    'icon' => null,
    'text' => null,
    'href' => null,
    'type' => 'button'
])

@php
    $variantClass = match($variant) {
        'accent' => 'btn-accent',
        'outline-secondary' => 'btn-outline-secondary',
        'outline-light' => 'btn-outline-light',
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success' => 'btn-success',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        'light' => 'btn-light',
        'dark' => 'btn-dark',
        'link' => 'btn-link',
        default => 'btn-' . $variant,
    };

    $classes = 'btn ' . $variantClass . ' d-inline-flex align-items-center justify-content-center gap-2 transition-all';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        @if($text)
            <span>{{ $text }}</span>
        @else
            {{ $slot }}
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        @if($text)
            <span>{{ $text }}</span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
