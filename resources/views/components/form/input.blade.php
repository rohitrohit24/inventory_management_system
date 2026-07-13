<div class="mb-3">

    @if ($label)
        <label class="form-label text-muted small ls-2 text-uppercase fw-bold">{{ $label }}</label>
    @endif

    @if ($icon)
        <i class="{{ $icon }} input-icon"></i>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        class="form-control {{ $custom }}" value="{{ $value }}" {{ $required }}
        @if ($readonly) {{ $readonly }} @endif>
    @error($name)
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>
