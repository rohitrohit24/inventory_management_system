<div>
    <div class="table-responsive mt-4">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    {{-- <th>Invoice No</th> --}}
                    <th>Cost Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchaseItems as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['productId'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        {{-- <td>{{ $item['invoice_no'] }}</td> --}}
                        <td>{{ number_format($item['cost_price'], 2) }}</td>
                        <td>{{ number_format($item['quantity'] * $item['cost_price'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No items added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
