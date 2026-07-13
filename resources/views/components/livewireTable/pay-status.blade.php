@if ($due_amount <= 0)
    <x-badge_button custom="text-info border-info">
        Paid
    </x-badge_button>
@elseif ($due_amount > 1)
    <x-badge_button custom="text-warning border-warning">
        UnPaid
    </x-badge_button>
@endif
