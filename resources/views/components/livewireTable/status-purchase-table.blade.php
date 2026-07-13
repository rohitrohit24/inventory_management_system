<div x-data="{ open: false }" @click.away="open = false" style="position: relative; display: inline-block;">

    <button @click="open = !open" type="button"
        class="btn btn-sm dropdown-toggle {{ $status == 'paid' ? 'text-info border-info' : ($status == 'pending' ? 'text-danger border-danger' : 'text-secondary border-secondary') }}">
        {{ ucfirst($status) }}
    </button>

    <div x-show="open" class="shadow rounded"
        style="position: absolute; top: 100%; right: 0; background: #212529; border: 1px solid #454d55; min-width: 120px; z-index: 9999; padding: 5px 0; margin-top: 5px; display: none;"
        :style="open ? 'display: block !important;' : 'display: none !important;'">

        <button class="dropdown-item text-info py-2 px-3"
            style="width: 100%; text-align: left; background: none; border: none;"
            wire:click="updateStatus({{ $rowId }}, 'paid'); open = false;">
            Paid
        </button>

        <button class="dropdown-item text-danger py-2 px-3"
            style="width: 100%; text-align: left; background: none; border: none;"
            wire:click="updateStatus({{ $rowId }}, 'pending'); open = false;">
            Pending
        </button>

        <button class="dropdown-item text-secondary py-2 px-3"
            style="width: 100%; text-align: left; background: none; border: none;"
            wire:click="updateStatus({{ $rowId }}, 'cancelled'); open = false;">
            Cancelled
        </button>
    </div>
</div>
