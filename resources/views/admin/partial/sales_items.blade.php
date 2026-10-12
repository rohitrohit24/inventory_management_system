@extends('admin.layout.view')
@section('title')
    Add Sales Invoice
@endsection

@section('content')
    <div class="container-fluid p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif

        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Create Invoice">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>
                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">New Sale</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <a href="{{ route('sales.view') }}"
                        class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm btn-secondary">
                        <i class="bi me-2 bi-arrow-left"></i> Back to Sales
                    </a>
                </x-slot:buttons>
            </x-breadcrumb>

            <div class="col-12 rounded-3 bg-aside p-4">
                <form action="{{ route('sales.store') }}" onsubmit="salesdata()" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="product_data" id="product_data">
                    <input type="hidden" name="sale_invoice_no" id="sale_invoice_no">
                    <input type="hidden" id="invoice_no" name="invoice_no">

                    <!-- 1. TOP SECTION: CUSTOMER & INVOICE DETAILS -->
                    <div class="row border-bottom border-secondary pb-3 mb-4">
                        <h5 class="text-white mb-3"><i class="bi bi-person-lines-fill text-accent me-2"></i> Customer
                            Details</h5>
                        <div class="col-md-6 col-12 mb-2">
                            <x-form.input type="text" placeholder="Enter Customer Name" label="Customer Name"
                                name="customer_name" id="customer_name" custom="text-white" required="required" />
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <x-form.input type="date" placeholder="Select Sale Date" label="Sale Date" name="sale_date"
                                id="sale_date" required="required" custom="text-white" value="{{ date('Y-m-d') }}" />
                        </div>
                    </div>

                    <!-- 2. MIDDLE SECTION: ADD ITEMS (INLINE)      -->
                    <h5 class="text-white mb-3"><i class="bi bi-cart-plus-fill text-accent me-2"></i> Add Products</h5>
                    <div class="row align-items-center p-3 rounded mb-3">

                        <div class="col-md-3 mb-2">
                            <x-form.select custom="" label="Select Product" name="product_id" id="product_id">
                                <option value="" selected disabled>Choose Product</option>
                                @foreach (App\Models\product::all() as $product)
                                    <option value="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->selling_price ?? 0 }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-2 mb-2">
                            <x-form.select custom="" label="Category" name="temp_category_id" id="category_id">
                                <option value="" selected disabled>Choose...</option>
                                @foreach (App\Models\Categorie::all() as $Category)
                                    <option value="{{ $Category->id }}" data-name="{{ $Category->name }}">
                                        {{ $Category->name }}</option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-md-1 mb-2">
                            <x-form.input type="number" placeholder="Qty" label="Qty" name="temp_quantity"
                                id="quantity" custom="text-white" value="1" min="1" />
                        </div>

                        <div class="col-md-2 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Price"
                                name="temp_unit_price" id="unit_price" custom="text-white" />
                        </div>

                        <div class="col-md-1 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0" label="Tax(%)" name="temp_tax"
                                id="tax" custom="text-white" value="0" />
                        </div>

                        <div class="col-md-2 mb-2">
                            <x-form.input type="number" step="0.01" placeholder="0.00" label="Total"
                                name="temp_item_total" id="item_total" custom="text-white" readonly />
                        </div>

                        <div class="col-md-1 mt-2 mb-2 text-end">
                            <button onclick="storedata(event)" class="btn btn-accent w-100" type="button"
                                title="Add to List">
                                <i class="bi bi-plus-lg fs-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- LIVE TABLE FOR ADDED PRODUCTS -->
                    <div class="table-responsive mb-4">
                        <table class="table table-hover table-dark table-bordered m-0 align-middle">
                            <thead class="table-active text-accent">
                                <tr>
                                    <th>PRODUCT NAME</th>
                                    <th>CATEGORY</th>
                                    <th class="text-end">PRICE</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-end">TAX (%)</th>
                                    <th class="text-end">ITEM TOTAL</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="showtable">
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">No products added yet.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-end border-top border-secondary pt-4 mt-2">
                        <div class="col-md-12 col-12 p-4 rounded">
                            <h5 class="text-white mb-3 border-bottom pb-2">Payment Summary</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Sub Total:</span>
                                <span class="text-white fw-bold" id="display_sub_total">0.00</span>
                            </div>

                            <div class="mb-3">
                                <x-form.input type="number" step="0.01" placeholder="0.00" label="Discount Amount"
                                    name="discount" id="discount" custom="text-white text-end" value="0" />
                            </div>

                            <div class="mb-3">
                                <x-form.select custom="" label="Payment Method" name="payment_method"
                                    required="required" id="payment_method">
                                    <option value="Cash" selected>Cash</option>
                                    <option value="Card">Card</option>
                                    <option value="Online">Online/Bank Transfer</option>
                                </x-form.select>
                            </div>

                            <div class="mb-3 border-top border-secondary pt-3">
                                <x-form.input type="number" step="0.01" placeholder="0.00"
                                    label="Grand Total (Final)" name="grand_total" id="grand_total"
                                    custom="text-white fs-4 fw-bold text-end text-accent" readonly />
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-lg fw-bold">
                                    <i class="bi bi-receipt me-2"></i> Save & Generate Invoice
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        let sale_invoice_no = "";

        // Auto Generate Invoice Number on Load
        document.addEventListener("DOMContentLoaded", function() {
            createinvoice();
            showdata();
        });

        function createinvoice() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const randomNumber = Math.floor(1000 + Math.random() * 9000);

            // Generate only if it doesn't exist
            if (!sale_invoice_no) {
                sale_invoice_no = `INV-${hours}${minutes}-${seconds}-${randomNumber}`;
                document.getElementById("sale_invoice_no").value = sale_invoice_no;
                document.getElementById("invoice_no").value = sale_invoice_no;
            }
        }

        function calculateItemTotal() {
            let unitprice = parseFloat(document.getElementById("unit_price").value) || 0;
            let quantity = parseFloat(document.getElementById("quantity").value) || 0;
            let tax_percent = parseFloat(document.getElementById("tax").value) || 0;

            let base_total = unitprice * quantity;
            let tax_amount = (base_total * tax_percent) / 100;
            let final_total = base_total + tax_amount;

            document.getElementById("item_total").value = final_total.toFixed(2);
        }

        // Event Listeners for auto-calculation
        document.getElementById("product_id").addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let price = selectedOption.getAttribute("data-price");
            document.getElementById("unit_price").value = price ? parseFloat(price).toFixed(2) : "0.00";
            calculateItemTotal();
        });

        document.getElementById("quantity").addEventListener("input", calculateItemTotal);
        document.getElementById("unit_price").addEventListener("input", calculateItemTotal);
        document.getElementById("tax").addEventListener("input", calculateItemTotal);

        function storedata(event) {
            if (event) event.preventDefault();

            let productDropdown = document.getElementById("product_id");
            let categoryDropdown = document.getElementById("category_id");

            let productId = productDropdown.value;
            let productName = productDropdown.options[productDropdown.selectedIndex]?.getAttribute("data-name") || "";

            let categoryId = categoryDropdown.value;
            let categoryName = categoryDropdown.options[categoryDropdown.selectedIndex]?.getAttribute("data-name") || "";

            let unitprice = document.getElementById("unit_price").value;
            let itemtotal = document.getElementById("item_total").value;
            let tax = document.getElementById("tax").value;
            let quantity = document.getElementById("quantity").value;

            if (productId === "" || categoryId === "" || quantity === "" || quantity <= 0) {
                alert("Please enter valid product details and quantity!");
                return;
            }

            if (!sale_invoice_no) createinvoice();

            let dataobject = {
                productId,
                productName,
                categoryId,
                categoryName,
                unitprice: parseFloat(unitprice).toFixed(2),
                quantity,
                tax: parseFloat(tax).toFixed(2),
                itemtotal: parseFloat(itemtotal).toFixed(2)
            };

            let data = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            data.push(dataobject);
            localStorage.setItem(sale_invoice_no, JSON.stringify(data));

            // Reset Inputs after adding
            productDropdown.value = "";
            categoryDropdown.value = "";
            document.getElementById('unit_price').value = "";
            document.getElementById('quantity').value = "1";
            document.getElementById('tax').value = "";
            document.getElementById('item_total').value = "";

            showdata();
        }

        function showdata() {
            if (!sale_invoice_no) return;
            let data = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            let table = "";
            let sub_total = 0;

            if (data.length === 0) {
                document.getElementById("showtable").innerHTML =
                    `<tr><td colspan="7" class="text-center text-muted py-3">No products added yet.</td></tr>`;
            } else {
                for (let i = 0; i < data.length; i++) {
                    sub_total += parseFloat(data[i].itemtotal);
                    table += `
                    <tr>
                        <td>${data[i].productName}</td>
                        <td>${data[i].categoryName}</td>
                        <td class="text-end">${data[i].unitprice}</td>
                        <td class="text-center">${data[i].quantity}</td>
                        <td class="text-end">${data[i].tax}%</td>
                        <td class="text-end fw-bold text-accent">${data[i].itemtotal}</td>
                        <td class="text-center">
                            <button onclick="deleteproduct(${i})" type="button" class="btn btn-sm btn-danger rounded-circle shadow-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `;
                }
                document.getElementById("showtable").innerHTML = table;
            }

            // Update Totals
            document.getElementById("display_sub_total").innerText = sub_total.toFixed(2);
            calculateGrandTotal(sub_total);
        }

        // Remove Single Product
        function deleteproduct(index) {
            let items = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            items.splice(index, 1);
            localStorage.setItem(sale_invoice_no, JSON.stringify(items));
            showdata();
        }

        function calculateGrandTotal(sub_total = null) {
            if (sub_total === null) {
                sub_total = parseFloat(document.getElementById("display_sub_total").innerText) || 0;
            }
            let discount = parseFloat(document.getElementById("discount").value) || 0;

            let final_total = sub_total - discount;
            if (final_total < 0) final_total = 0;

            document.getElementById("grand_total").value = final_total.toFixed(2);
        }

        document.getElementById("discount").addEventListener("input", function() {
            calculateGrandTotal();
        });

        function salesdata() {
            if (!sale_invoice_no) return;
            let products_array = JSON.parse(localStorage.getItem(sale_invoice_no)) || [];
            if (products_array.length === 0) {
                alert("Cannot generate empty invoice!");
                event.preventDefault();
                return;
            }
            document.getElementById("product_data").value = JSON.stringify(products_array);
        }
    </script>
@endsection
