@extends('admin.layout.view')
@section('title')
    Total Invoice Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Invoices Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Total Invoice</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <a href="{{ route('totalinvoice.add_product') }}"
                        class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm btn-accent">
                        <i class="bi bi-plus-lg me-2"></i> Create Invoice
                    </a>
                </x-slot:buttons>

            </x-breadcrumb>
            {{-- <x-buttons variant="btn-primary" type="button" modal="modal" modalid="#rohit12"
                custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Add Total Invoice
            </x-buttons> --}}
            {{-- <x-modal id="rohit12" action="{{ route('purchases.store') }}" method="POST" title="Add Purchases"
                size="modal-xl">
                <div class="row p-3">
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.select custom="" label="Supplier" name="supplier_id" id="supplier_id"
                            required="required">
                            <option value="" disabled selected>Select Supplier</option>
                            @foreach (App\Models\Supplier::all() as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Invoice Number" label="Invoice No" name="invoice_no"
                            id="invoice_no" required="required" custom="text-white" />
                    </div>


                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="date" placeholder="Select Date" label="Purchase Date" name="purchases_date"
                            id="purchases_date" required="required" custom="text-white" />
                    </div>


                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Total Amount"
                            name="total_amount" id="total_amount" required="required" custom="text-white" />
                    </div>

                    
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Paid Amount"
                            name="paid_amount" id="paid_amount" required="required" custom="text-white" />
                    </div>


                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Due Amount" name="due_amount"
                            id="due_amount" required="required" custom="text-white" />
                    </div>

                    
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.select custom="" label="Status" name="status" id="status">
                            <option value="pending" selected>Pending</option>
                            <option value="ordered">Ordered</option>
                            <option value="received">Received</option>
                            <option value="partial">Partial</option>
                            <option value="paid">Paid</option>
                        </x-form.select>
                    </div>
                </div>

                <x-slot:footer>
                    <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Submit
                    </x-buttons>
                </x-slot:footer>
            </x-modal> --}}
            <div class="col-md-12 bg-aside rounded-3 p-3 table-responsive border border-slate">
                <div class="text-end pb-3">
                    <a href="{{ route('totalinvoice.paid_invoice') }}" class="btn btn-accent me-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Paid Invoices
                    </a>
                    <a href="{{ route('totalinvoice.unpaid_invoice') }}" class="btn btn-accent">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> Unpaid Invoices
                    </a>
                </div>
                <livewire:total_invoice-table />
                <livewire:invoice-show-modal />
                <livewire:delete-modal-table />
                <livewire:invoice-pay-modal />
            </div>
            {{-- <x-modal id="showInvoiceItemsModal" title="📦 Invoice Products List" size="modal-lg">
                <div class="p-2 mb-3 bg-secondary rounded text-white px-3">
                    <strong>Invoice No:</strong> <span id="modal_invoice_display" class="fw-bold"></span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover bg-aside table-dark table-bordered m-0">
                        <thead>
                            <tr>
                                <th>PRODUCT ID</th>
                                <th>QUANTITY</th>
                                <th>COST PRICE</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody id="modal_products_table_body">
                        </tbody>
                    </table>
                </div>
                <x-slot:footer>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </x-slot:footer>
            </x-modal> --}}
        </div>
    </div>
    {{-- <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-invoice-show-modal', (eventData) => {
                // Livewire v3 data check array wrapper handles
                let data = eventData[0] ? eventData[0] : eventData;
                dd($data);

                let invoiceNo = data.invoiceNo;
                let rawItems = data.items;

                // 1. Text display set karein
                document.getElementById('modal_invoice_display').innerText = invoiceNo;

                let productsArray = [];
                try {
                    // Agar data pehle se object nahi h toh parse karein
                    productsArray = typeof rawItems === 'string' ? JSON.parse(rawItems) : rawItems;
                } catch (e) {
                    console.error("JSON parsing error:", e);
                    productsArray = [];
                }

                let tableHtml = "";

                if (productsArray && productsArray.length > 0) {
                    productsArray.forEach(item => {
                        let qty = parseFloat(item.quantity) || 0;
                        let price = parseFloat(item.cost_price) || 0;
                        let total = qty * price;

                        tableHtml += `
                    <tr>
                        <td><span class="badge bg-primary px-2 py-1">${item.productId}</span></td>
                        <td>${qty}</td>
                        <td>${price.toFixed(2)}</td>
                        <td><strong>${total.toFixed(2)}</strong></td>
                    </tr>
                    `;
                    });
                } else {
                    tableHtml =
                        `<tr><td colspan="4" class="text-center text-muted">No products found in this invoice.</td></tr>`;
                }

                // 2. Table content update karein
                document.getElementById('modal_products_table_body').innerHTML = tableHtml;

                // 3. ✨ MODAL OPEN GUARANTEE CODE: 
                // Agar normal initialization fail ho jaye, toh ye direct element ko dhoondh kar show kar dega
                let modalElement = document.getElementById('showInvoiceItemsModal');
                if (modalElement) {
                    let modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (!modalInstance) {
                        modalInstance = new bootstrap.Modal(modalElement);
                    }
                    modalInstance.show();
                } else {
                    console.error("Modal element nahi mila! ID check karein.");
                }
            });
        });
    </script> --}}
    {{-- <script>
        function storedata() {
            let invoice_no = document.getElementById("invoice_no").value.trim();
            let productId = document.getElementById("product_id").value;
            let quantity = document.getElementById("quantity").value;
            let cost_price = document.getElementById("cost_price").value;
            if (invoice_no === "") {
                alert("Please Enter Ivoice Number!");
                return;
            }

            let dataobject = {
                invoice_no,
                productId,
                quantity,
                cost_price
            };

            let data = JSON.parse(localStorage.getItem(invoice_no)) || [];

            if (productId === "" || quantity === "" || cost_price === "") {
                alert("Please Enter Product Details!");
                return;
            }

            data.push(dataobject);
            localStorage.setItem(invoice_no, JSON.stringify(data));

            console.log(`invoice`, dataobject);

            document.getElementById('product_id').value = "";
            document.getElementById('quantity').value = "";
            document.getElementById('cost_price').value = "";
            showdata();

        }

        function invoicedata() {
            let invoice_no = document.getElementById("invoice_no").value.trim();
            let products_array = JSON.parse(localStorage.getItem(invoice_no)) || [];
            let jsonString = JSON.stringify(products_array);
            document.getElementById("product_data").value = jsonString;
        }

        function showdata() {
            let invoice_no = document.getElementById("invoice_no").value.trim();
            let newtotal = 0;
            let data = JSON.parse(localStorage.getItem(invoice_no)) || [];
            let table = "";
            for (i = 0; i < data.length; i++) {
                let rowt = data[i].quantity * data[i].cost_price;
                newtotal += rowt;
                table += `
            <tr>
                <td>${data[i].productId}</td>
                <td>${data[i].quantity}</td>
                <td>${data[i].cost_price}</td>
                <td>${total = data[i].cost_price * data[i].quantity}</td>
                <td><button id="a" onclick="deleteproduct('${data[i].productId}')" type="button" class="btn btn-primary"><i class="bi bi-eraser-fill"></i></button></td>
            </tr>
            `;
            }
            document.getElementById("showtable").innerHTML = table;
            let total_amount = document.getElementById("total_amount");

            total_amount.value = newtotal;
        }
        showdata();

        function deleteproduct(productId) {
            let invoice_no = document.getElementById("invoice_no").value.trim();
            let items = JSON.parse(localStorage.getItem(invoice_no)) || [];

            items = items.filter(item => item.productId !== productId);
            localStorage.setItem(invoice_no, JSON.stringify(items));
            showdata();
        }

        let totalInput = document.getElementById("total_amount");
        let paidInput = document.getElementById("paid_amount");
        let dueInput = document.getElementById("due_amount");
        paidInput.addEventListener("input", function() {
            let total = totalInput.value;
            let paid = paidInput.value;
            let due_amount = total - paid;
            dueInput.value = due_amount;
        });
    </script> --}}
@endsection
