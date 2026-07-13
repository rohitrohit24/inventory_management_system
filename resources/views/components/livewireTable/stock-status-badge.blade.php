@if ($quantity > $alert_quantity)
    <x-badge_button custom="text-info border-info">
        In Stock
    </x-badge_button>
@elseif ($quantity > 0 && $quantity <= $alert_quantity)
    <x-badge_button custom="text-warning border-warning">
        Low Stock
    </x-badge_button>
@else
    <x-badge_button custom="text-danger border-danger">
        Out of Stock
    </x-badge_button>
@endif
