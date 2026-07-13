@extends('admin.layout.view')
@section('title')
    Add Sales Product Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Sales Items Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Sales Items</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <a href="{{ route('sales.view') }}" class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm btn-accent">
                        <i class="bi me-2 bi-arrow-left"></i> Back Sales
                    </a>
                </x-slot:buttons>
            </x-breadcrumb>
            <div class="col-12 rounded-3 bg-aside">
                <form action="{{ route('sales.store') }}" onsubmit="salesdata()" method="POST">
                    @csrf
                    <div class="row p-3">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="col-md-6 col-12 mb-2">
                            <x-form.input type="text" placeholder="Enter Customer Name" label="Customer Name"
                                name="customer_name" id="customer_name" custom="text-white" />
                        </div>

                        <div class="col-md-6 col-12 mb-2">
                            <x-form.input type="date" placeholder="Select Sale Date" label="Sale Date" name="sale_date"
                                id="sale_date" required="required" custom="text-white" />
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-md-4 col-12 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Discount" name="discount"
                                id="discount" custom="text-white" />
                        </div>

                        <div class="col-md-4 col-12 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Grand Total"
                                name="grand_total" id="grand_total" custom="text-white" readonly />
                        </div>

                        <div class="col-md-4 col-12 mb-2">
                            <x-form.select custom="" label="Payment Method" name="payment_method" required="required"
                                id="payment_method">
                                <option value="Cash" selected>Cash</option>
                                <option value="Card">Card</option>
                                <option value="Online">Online/Bank Transfer</option>
                            </x-form.select>
                        </div>
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
                                <option value="{{ $product->id }}" data_price="{{ $product->selling_price ?? 0 }}">
                                    {{ $product->name }} ({{ $product->selling_price }})
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.select custom="" label="Select Category" name="category_id" id="category_id">
                            <option value="" selected disabled>Choose Category</option>
                            @foreach (App\Models\Categorie::all() as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Quantity" label="Quantity" name="quantity"
                            id="quantity" custom="text-white" />
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Unit Price"
                            name="unit_price" id="unit_price" custom="text-white" />
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Tax (%)" name="tax"
                            id="tax" custom="text-white" />
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <x-form.input type="number" step="0.01" placeholder="0.00" label="Total (with tax)"
                            name="item_total" id="item_total" custom="text-white" readonly />
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
                                    <th>PRODUCT NAME</th>
                                    <th>CATEGORY</th>
                                    <th>QUANTITY</th>
                                    <th>UNIT PRICE</th>
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
                <h1 id="demo"></h1>

            </div>
        </div>
    </div>
    <script>
        // const productPrices = {
        //     @foreach (App\Models\product::all() as $product)
        //         "{{ $product->id }}": {{ $product->selling_price ?? 0 }},
        //     @endforeach
        // };
    </script>


    <script>
        let sale_invoice_no = "";
        document.getElementById("item_total").readOnly = true;
        document.getElementById("grand_total").readOnly = true;

        function createinvoice() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const randomNumber = Math.floor(1000 + Math.random() * 9000);

            sale_invoice_no = `INV-${hours}${minutes}-${seconds}-${randomNumber}`;
            document.getElementById("sale_invoice_no").value = sale_invoice_no;
            if (sale_invoice_no) {
                alert("Invoice Created Successfully");
            }
        }

        document.getElementById("product_id").addEventListener("change", function() {
            let selectElement = this;
            let selectedOption = selectElement.options[selectElement.selectedIndex];

            let unitPriceInput = document.getElementById("unit_price");

            let price = selectedOption.getAttribute("data_price");

            if (price && price !== "0") {
                unitPriceInput.value = parseFloat(price).toFixed(2);
            } else {
                unitPriceInput.value = "0.00";
            }
        });

        function storedata(event) {
            if (event) event.preventDefault();

            let productId = document.getElementById("product_id").value;
            let categoryId = document.getElementById("category_id").value;
            // let tax = document.getElementById("tax").value;
            let quantity = document.getElementById("quantity").value;




            if (productId === "" || categoryId === "" || quantity === "") {
                alert("Please Enter Product Details!");
                return;
            }

            if (!sale_invoice_no) {
                createinvoice();
            }

            let dataobject = {
                productId,
                categoryId,
                quantity,
                tax,
            };

            let data = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            data.push(dataobject);
            localStorage.setItem(sale_invoice_no, JSON.stringify(data));

            document.getElementById('product_id').value = "";
            document.getElementById('category_id').value = "";
            document.getElementById('quantity').value = "";
            document.getElementById('unit_price').value = "";

            showdata();
        }

        function salesdata() {
            if (!sale_invoice_no) return;
            let products_array = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            let jsonString = JSON.stringify(products_array);
            document.getElementById("product_data").value = jsonString;
        }

        function showdata() {
            let countElement = document.getElementById("product_count");
            if (!sale_invoice_no) {
                if (countElement) countElement.innerHTML = "0 Products";
                return;
            }

            let newtotal = 0;
            let data = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];

            if (countElement) {
                countElement.innerHTML = data.length + " Products";
            }

            let table = "";
            for (let i = 0; i < data.length; i++) {
                let row_total = data[i].quantity * data[i].tax;
                newtotal += row_total;
                table += `
                <tr>
                    <td>${data[i].productId.name}</td>
                    <td>${data[i].categoryId}</td>
                    <td>${data[i].quantity}</td>
                    <td>${row_total}</td>
                    <td><button onclick="deleteproduct('${data[i].productId}')" type="button" class="btn btn-primary"><i class="bi bi-eraser-fill"></i></button></td>
                </tr>
                `;
            }
            document.getElementById("showtable").innerHTML = table;
            // if (document.getElementById("item_total")) {
            //     document.getElementById("item_total").value = newtotal.toFixed(2);
            // }

            // let total_amount = document.getElementById("item_total");
            // if (item_total) item_total.value = newtotal;

            // let paidInput = document.getElementById("paid_amount");
            // let dueInput = document.getElementById("due_amount");

            // if (paidInput && dueInput) {
            //     let paid = parseFloat(paidInput.value) || 0;

            //     if (paid > newtotal) {
            //         paidInput.value = newtotal;
            //         paid = newtotal;
            //     }

            //     let calculatedDue = newtotal - paid;
            //     dueInput.value = calculatedDue < 0 ? 0 : calculatedDue;
            // }
        }

        function deleteproduct(productId) {
            let items = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            items = items.filter(item => item.productId !== productId);
            localStorage.setItem(sale_invoice_no, JSON.stringify(items));
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
