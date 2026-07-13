@if ($status == 1)
    <x-badge_button custom="text-info border-info">
        Active
    </x-badge_button>
@else
    <x-badge_button custom="text-danger border-danger">
        InActive
    </x-badge_button>
@endif
