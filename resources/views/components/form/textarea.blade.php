<div class="mb-3">

    <label class="form-label text-muted small ls-2 text-uppercase fw-bold">{{ $label }}</label>

    <textarea name="{{ $name }}" rows="{{ $rows ?? 4 }}" class="form-control {{ $custom }}">
        {{ old($name, $slot) }}
    </textarea>

</div>
