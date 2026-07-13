<div class="col-md-12 d-flex align-items-center justify-content-between p-4 rounded-4 shadow-sm bg-gradient-header">
    <div>

        <h2 class="fs-5 fw-bold mute-text mb-1">{{ $heading }}</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{ $slot }}
            </ol>
        </nav>
    </div>
    <div>
        {{ $buttons }}
    </div>

</div>
