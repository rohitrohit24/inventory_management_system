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

            <x-modal id="rohit12" action="{{ route('product.store') }}" method="POST" title="Add Products"
                size="modal-xl">
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
                    <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Submit
                    </x-buttons>
                </x-slot:footer>
            </x-modal>
            <div class="col-md-12 bg-aside rounded-3 p-3 table-responsive">
                <livewire:product-table>
                    <livewire:product-modal-table>
                        <livewire:delete-modal-table>

            </div>

            {{-- <x-modal id="{{ $product->id }}" action="{{ route('product.update', $product->id) }}" method="POST"
                title="Edit Product" size="modal-xl">
                @csrf
                @method('PUT')
                <div class="row p-3">
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Product Name" value="{{ $product->name ?? '' }}"
                            label="Product Name" name="name" id="name" required="required"
                            custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Quantity" label="Product Quantity"
                            value="{{ $product->quantity ?? '' }}" name="quantity" id="quantity" required="required"
                            custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.select custom="" label="Category" name="category_id" id="category_id">
                            <option disabled>Select Categories</option>
                            @foreach (App\Models\Categorie::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Sku" label="Sku Code"
                            value="{{ $product->sku ?? '' }}" name="sku" id="sku" required="required"
                            custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Barcode" label="BarCode"
                            value="{{ $product->barcode ?? '' }}" name="barcode" id="barcode" required="required"
                            custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Cost Price" label="Cost Price"
                            value="{{ $product->cost_price ?? '' }}" name="cost_price" id="cost_price"
                            required="required" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Alert Quantity"
                            value="{{ $product->alert_quantity ?? '' }}" label="Alert Quantity" name="alert_quantity"
                            id="alert_quantity" custom="text-white" />
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="number" placeholder="Enter Selling Price" label="Selling Price"
                            value="{{ $product->selling_price ?? '' }}" name="selling_price" id="selling_price"
                            required="required" custom="text-white" />
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Description"
                            value="{{ $product->description ?? '' }}" label="Description" name="description"
                            id="description" custom="text-white" />
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <x-form.file custom="" label="Product Image" value="{{ $product->image ?? '' }}"
                            accept="jpg,png," id="image" name="image" />
                    </div>
                </div>
                <x-slot:footer>
                    <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Update Product
                    </x-buttons>
                </x-slot:footer>
            </x-modal> --}}
        </div>
    </div>
@endsection
{{-- 
@include('livewire-tables::datatable')
<div id="productEditModalWrapper">
    @if ($editingProduct)
        <x-modal id="productEditModal" action="{{ route('product.update', $editingProduct->id) }}" method="POST"
            title="Edit Product" size="modal-xl">
            @csrf
            @method('PUT')
            <div class="row p-3">
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="text" placeholder="Enter Product Name" value="{{ $editingProduct->name }}"
                        label="Product Name" name="name" id="name" required="required" custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="number" placeholder="Enter Quantity" label="Product Quantity"
                        value="{{ $editingProduct->quantity }}" name="quantity" id="quantity" required="required"
                        custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.select custom="" label="Category" name="category_id" id="category_id">
                        <option disabled>Select Categories</option>
                        @foreach (App\Models\Categorie::all() as $category)
                            <option value="{{ $category->id }}"
                                {{ $editingProduct->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="text" placeholder="Enter Sku" label="Sku Code"
                        value="{{ $editingProduct->sku }}" name="sku" id="sku" required="required"
                        custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="text" placeholder="Enter Barcode" label="BarCode"
                        value="{{ $editingProduct->barcode }}" name="barcode" id="barcode" required="required"
                        custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="number" placeholder="Enter Cost Price" label="Cost Price"
                        value="{{ $editingProduct->cost_price }}" name="cost_price" id="cost_price" required="required"
                        custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="number" placeholder="Enter Alert Quantity"
                        value="{{ $editingProduct->alert_quantity }}" label="Alert Quantity" name="alert_quantity"
                        id="alert_quantity" custom="text-white" />
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <x-form.input type="number" placeholder="Enter Selling Price" label="Selling Price"
                        value="{{ $editingProduct->selling_price }}" name="selling_price" id="selling_price"
                        required="required" custom="text-white" />
                </div>
                <div class="col-md-12 col-12 mb-2">
                    <x-form.input type="text" placeholder="Enter Description"
                        value="{{ $editingProduct->description }}" label="Description" name="description"
                        id="description" custom="text-white" />
                </div>
                <div class="col-md-12 col-12 mb-2">
                    <x-form.file custom="" label="Product Image" value="{{ $editingProduct->image }}"
                        accept="jpg,png," id="image" name="image" />
                </div>
            </div>
            <x-slot:footer>
                <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                    Update Product
                </x-buttons>
            </x-slot:footer>
        </x-modal>
    @endif
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('open-edit-modal', () => {

            setTimeout(() => {
                const modalElement = document.getElementById('productEditModal');
                if (modalElement) {
                    const bootstrapModal = new bootstrap.Modal(modalElement);
                    bootstrapModal.show();
                }
            }, 100);
        });
    });
</script> --}}
