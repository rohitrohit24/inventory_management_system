<div class="form-check mb-3">

    <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked($checked)
        class="form-check-input {{ $custom }}">

    <label class="form-label text-muted small pe-3 ls-2 text-uppercase fw-bold">{{ $label }}</label>

</div>
