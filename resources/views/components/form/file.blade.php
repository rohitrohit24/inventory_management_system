<div class="mb-3">

    <label class="form-label text-muted small ls-2 text-uppercase fw-bold">{{ $label }}</label>

    <input type="file" name="{{ $name }}" id="{{ $id }}" accept="{{ $accept ?? '.png,.jpg,.jpeg' }}"
        class="form-control {{ $custom }}">

</div>
