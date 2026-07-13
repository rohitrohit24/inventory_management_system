<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.5);">
    <div
        class="modal-dialog modal-dialog-centered text-start @if ($size) {{ $size }} @endif">
        <div class="modal-content bg-card border-slate text-light">

            <div class="modal-header border-slate">
                <h1 class="modal-title fs-5">{{ $title }}</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data">
                @csrf
                {{-- @if ($formMethod)
                    @method('{{ $formMethod }}')
                @endif --}}
                <div class="modal-body">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="modal-footer border-slate">
                        {{ $footer }}
                    </div>
                @endisset
            </form>
        </div>
    </div>
</div>
