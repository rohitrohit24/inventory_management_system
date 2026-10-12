<div>
    @if ($showModal)
        <div wire:transition class="modal fade show d-block lw-modal" tabindex="-1" id="invoiceShowModal"
            style="background: rgba(0,0,0,0.8); overflow-y: auto;"
            aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark text-white border border-secondary shadow-lg">

                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fs-5"><i class="bi bi-box-seam text-success me-2"></i> Invoice Items Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="close"></button>
                    </div>

                    <div class="modal-body text-start">
                        @if ($invoice)
                            <div class="row p-3 rounded mb-3 mx-0 bg-aside">
                                <div class="col-6">
                                    <strong>INVOICE NO:</strong> <span
                                        class="text-warning">{{ $invoice->invoice_no }}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <strong>SUPPLIER:</strong> <span
                                        class="text-info">{{ $invoice->supplier->company_name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-dark table-bordered m-0 align-middle">
                                    <thead class="text-dark fw-bold">
                                        <tr>
                                            <th>PRODUCT ID</th>
                                            <th>QUANTITY</th>
                                            <th>COST PRICE</th>
                                            <th>TOTAL COST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($productsArray as $item)
                                            @php
                                                $qty = floatval($item['quantity'] ?? 0);
                                                $price = floatval($item['cost_price'] ?? 0);
                                                $rowTotal = $qty * $price;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary px-3 py-2 font-monospace fs-6">
                                                        {{ $item['productId'] ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td class="text-warning fw-bold fs-5">{{ $qty }}</td>
                                                <td>₹{{ number_format($price, 2) }}</td>
                                                <td class="text-success fw-bold">₹{{ number_format($rowTotal, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted fs-6">
                                                    <i class="bi bi-exclamation-circle me-1"></i> No items found inside this
                                                    JSON data.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="spinner-border text-success" role="status"></div>
                                <p class="mt-2 text-muted font-monospace">Fetching encrypted JSON array from DB...</p>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary px-4 shadow" wire:click="close">Close
                            Window</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

