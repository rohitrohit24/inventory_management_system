<div class="mb-3">

    <label class="form-label text-muted small ls-2 text-uppercase fw-bold">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="form-select {{ $custom }}">
        {{ $slot }}
    </select>

</div>
