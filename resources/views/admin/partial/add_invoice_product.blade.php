@extends('admin.layout.view')
@section('title')
    Add Invoice Products Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Add Invoice Product Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Add Product</span>
                </x-breadcrumb-item>
            </x-breadcrumb>

            <div class="col-12 rounded-3 bg-aside">
                <form action="{{ route('totalinvoice.store') }}" onsubmit="invoicedata()" method="POST">
                    @csrf
                    <div class="row p-3">
                        <input type="hidden" name="product_data" id="product_data">
                        <input type="hidden" id="invoice_no" name="invoice_no">

                        <div class="col-md-6 col-12 mb-2">
                            <x-form.select custom="" label="Select Supplier" name="supplier_id" required="required"
                                id="supplier_id">
                                <option value="" selected disabled>Choose Supplier</option>
                                @foreach (App\Models\Supplier::all() as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <x-form.input type="date" placeholder="Select Purchase Date" label="Purchase Date"
                                name="purchases_date" id="purchases_date" required="required" custom="text-white" />
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-md-4 col-12 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Total Amount"
                                name="total_amount" id="total_amount" custom="text-white" readonly />
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Paid Amount"
                                name="paid_amount" id="paid_amount" custom="text-white" />
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Due Amount"
                                name="due_amount" id="due_amount" custom="text-white" readonly="readonly" />
                        </div>
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                    </div>

                    <div class="col-md-12 p-3 text-end border-bottom border-secondary">
                        <x-buttons variant="btn-primary" type="submit" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                            Total Bill
                        </x-buttons>
                    </div>
                </form>

                <div class="row p-3 mt-2">
                    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">Add Items to List</h5>
                        <button id="product_count" class="btn btn-accent px-4" type="button" data-bs-toggle="modal"
                            data-bs-target="#products">
                            0 Products
                        </button>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.select custom="" label="Select Product" name="product_id" id="product_id">
                            <option value="" selected disabled>Choose Product</option>
                            @foreach (App\Models\product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Quantity" label="Quantity" name="quantity"
                            id="quantity" custom="text-white" />
                    </div>
                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Cost Price" name="cost_price"
                            id="cost_price" custom="text-white" />
                    </div>

                    <div class="col-md-12 text-end col-12 my-3">
                        <button onclick="storedata(event)" class="btn btn-accent px-5" type="button">
                            Add Product
                        </button>
                    </div>
                </div>

                <x-modal id="products" title="🛒 Invoice Added Products" size="modal-lg">
                    <div class="table-responsive">
                        <table class="table table-hover bg-aside table-dark table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>QUANTITY</th>
                                    <th>COST PRICE</th>
                                    <th>TOTAL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="showtable"></tbody>
                        </table>
                    </div>
                    <x-slot:footer>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </x-slot:footer>
                </x-modal>

            </div>
        </div>
    </div>

    <script>
        let invoice_no = "";
        document.getElementById("total_amount").readOnly = true;
        document.getElementById("due_amount").readOnly = true;

        function createinvoice() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const randomNumber = Math.floor(1000 + Math.random() * 9000);

            invoice_no = `INV-${hours}${minutes}-${seconds}-${randomNumber}`;
            document.getElementById("invoice_no").value = invoice_no;
            if (invoice_no) {
                alert("Invoice Created Successfully");
            }
        }

        function storedata(event) {
            if (event) event.preventDefault();

            let productId = document.getElementById("product_id").value;
            let quantity = document.getElementById("quantity").value;
            let cost_price = document.getElementById("cost_price").value;

            if (productId === "" || quantity === "" || cost_price === "") {
                alert("Please Enter Product Details!");
                return;
            }

            if (!invoice_no) {
                createinvoice();
            }

            let dataobject = {
                productId,
                quantity,
                cost_price
            };

            let data = JSON.parse(localStorage.getItem(invoice_no)) || [];
            data.push(dataobject);
            localStorage.setItem(invoice_no, JSON.stringify(data));

            document.getElementById('product_id').value = "";
            document.getElementById('quantity').value = "";
            document.getElementById('cost_price').value = "";

            showdata();
        }

        function invoicedata() {
            if (!invoice_no) return;
            let products_array = JSON.parse(localStorage.getItem(invoice_no)) || [];
            let jsonString = JSON.stringify(products_array);
            document.getElementById("product_data").value = jsonString;
        }

        function showdata() {
            let countElement = document.getElementById("product_count");
            if (!invoice_no) {
                if (countElement) countElement.innerHTML = "0 Products";
                return;
            }

            let newtotal = 0;
            let data = JSON.parse(localStorage.getItem(invoice_no)) || [];

            if (countElement) {
                countElement.innerHTML = data.length + " Products";
            }

            let table = "";
            for (let i = 0; i < data.length; i++) {
                let rowt = data[i].quantity * data[i].cost_price;
                newtotal += rowt;
                table += `
                <tr>
                    <td>${data[i].productId}</td>
                    <td>${data[i].quantity}</td>
                    <td>${data[i].cost_price}</td>
                    <td>${rowt}</td>
                    <td><button onclick="deleteproduct('${data[i].productId}')" type="button" class="btn btn-primary"><i class="bi bi-eraser-fill"></i></button></td>
                </tr>
                `;
            }
            document.getElementById("showtable").innerHTML = table;

            let total_amount = document.getElementById("total_amount");
            if (total_amount) total_amount.value = newtotal;

            let paidInput = document.getElementById("paid_amount");
            let dueInput = document.getElementById("due_amount");

            if (paidInput && dueInput) {
                let paid = parseFloat(paidInput.value) || 0;

                if (paid > newtotal) {
                    paidInput.value = newtotal;
                    paid = newtotal;
                }

                let calculatedDue = newtotal - paid;
                dueInput.value = calculatedDue < 0 ? 0 : calculatedDue;
            }
        }

        function deleteproduct(productId) {
            let items = JSON.parse(localStorage.getItem(invoice_no)) || [];
            items = items.filter(item => item.productId !== productId);
            localStorage.setItem(invoice_no, JSON.stringify(items));
            showdata();
        }

        let totalInput = document.getElementById("total_amount");
        let paidInput = document.getElementById("paid_amount");
        let dueInput = document.getElementById("due_amount");

        if (paidInput) {
            paidInput.addEventListener("input", function() {
                let total = totalInput ? (parseFloat(totalInput.value) || 0) : 0;
                let paid = parseFloat(paidInput.value) || 0;

                if (paid > total) {
                    paidInput.value = total;
                    paid = total;
                }

                if (dueInput) {
                    let calculatedDue = total - paid;
                    dueInput.value = calculatedDue < 0 ? 0 : calculatedDue;
                }
            });
        }
    </script>
@endsection
