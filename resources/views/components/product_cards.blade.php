<div class="stat-card">
    <div class="d-flex align-items-center mb-3">
        <div class="stat-icon me-3"
            style="color: {{ $iconColor ?? '#06b6d4' }}; background-color: {{ $iconBg ?? 'rgba(6, 182, 212, 0.1)' }};">
            <i class="{{ $icon }}"></i>
        </div>
        <p class="text-muted mb-0 fw-semibold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">
            {{ $title }}</p>
    </div>
    <div>
        <p class="text-muted mb-0 fw-semibold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
            {{ $subtitle }}</p>
    </div>
    <div class="pt-3">
        <h2 class="fw-bold mb-0 text-white">{{ $value }}</h2>
        <h4 class="fw-bold my-3 text-white">
            @if ($stockvalue)
                {{ $stockvalue }}
            @endif
        </h4>
        <div class="text-end">
            {{ $card_button }}
        </div>
    </div>
</div>
