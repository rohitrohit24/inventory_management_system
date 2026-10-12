@extends('admin.layout.view')
@section('title')
    Products Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Products Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Products</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <x-buttons modal="modal" variant="btn-primary" type="button" modalid="#rohit12"
                        custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Add Products
                    </x-buttons>
                </x-slot:buttons>

            </x-breadcrumb>
            <div id="showmessage">

            </div>

            <x-modal id="rohit12" formid="productform" title="Add Products" size="modal-xl">
                <div class="row p-3">
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Product Name" label="Product Name" name="name"
                            id="name" required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Quantity" label="Product Quantity" name="quantity"
                            id="quantity" required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.select custom="" label="Category" name="category_id" id="category_id">
                            <option selected disabled>Select Categories</option>
                            @foreach (App\Models\Categorie::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Sku" label="Sku Code" name="sku" id="sku"
                            required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Barcode" label="BarCode" name="barcode"
                            id="barcode" required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Cost Price" label="Cost Price" name="cost_price"
                            id="cost_price" required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Alert Quantity" label="Alert Quantity"
                            name="alert_quantity" id="alert_quantity" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Tax Rate" label="Tax Rate" name="tax_rate"
                            id="tax_rate" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Selling Price" label="Selling Price"
                            name="selling_price" id="selling_price" required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Description" label="Description" name="description"
                            id="description" custom="text-white" />
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <x-form.file custom="" label="Product Image" accept="jpg,png," id="image"
                            name="image">
                        </x-form.file>
                    </div>
                </div>
                <x-slot:footer>
                    <button type="button" id="triggerModalClose" data-bs-dismiss="modal" class="d-none"></button>
                    <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Submit
                    </x-buttons>
                </x-slot:footer>
            </x-modal>
            <div class="col-md-12 bg-aside rounded-3 p-3 table-responsive border border-slate">
                <livewire:product-table />
                <livewire:product-modal-table />
                <livewire:delete-modal-table />
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let productform = document.getElementById('productform');
        productform.addEventListener('submit', async function(e) {
            e.preventDefault();
            let alert = document.getElementById('showmessage');
            alert.innerText = "data sending...";

            const formdata = new FormData(productform);

            const URL = '/product/store';

            try {
                const response = await fetch(URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    },
                    body: formdata
                })
                const result = await response.json();
                if (response.ok) {
                    alert.style.color = "green";
                    alert.innerText = `Success: ${result.message}`;
                    productform.reset();
                    Livewire.dispatch('refreshTable');
                    const closeBtn = document.getElementById('triggerModalClose');
                    if (closeBtn) closeBtn.click();
                } else {
                    throw new Error(result.message || 'Server standard error');
                }
            } catch (error) {
                console.error("Error details:", error);
                alert.style.color = "red";
                alert.innerText = `Oops! ${error.message}`;
            }

        })
    </script>
@endpush
