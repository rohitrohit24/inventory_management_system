<div>
    <li class="breadcrumb-item {{ $active ? 'active' : '' }}"
        @if ($active) aria-current="page" @endif>

        @if (!$active)
            <a href="{{ $href }}" class="{{ $custom }}">{{ $slot }}</a>
        @else
            {{ $slot }}
        @endif

    </li>
</div>
