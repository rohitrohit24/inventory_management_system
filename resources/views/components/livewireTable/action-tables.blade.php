<div class="d-flex gap-2">

    <x-action-buttons type="button" title="edit" modal="modal" modalid="{{ $product->id }}"
        custom="btn-sm action-buttons btn-outline-info">
        <i class="bi bi-pencil"></i>
    </x-action-buttons>

    <x-action-buttons type="button" variant="danger" modal="modal" modalid="delete{{ $product->id }}" title="edit"
        custom="btn-sm action-buttons btn-outline-danger">
        <i class="bi bi-trash"></i>
    </x-action-buttons>

    <x-modal id="{{ $product->id }}" action="{{ route('product.update', $product->id) }}" method="POST"
        title="Edit Product" size="modal-xl">
        @csrf
        @method('PUT')
        <div class="row p-3">
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="text" placeholder="Enter Product Name" value="{{ $product->name }}"
                    label="Product Name" name="name" id="name" required="required" custom="text-white" />
            </div>
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="number" placeholder="Enter Quantity" label="Product Quantity"
                    value="{{ $product->quantity }}" name="quantity" id="quantity" required="required"
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
                <x-form.input type="text" placeholder="Enter Sku" label="Sku Code" value="{{ $product->sku }}"
                    name="sku" id="sku" required="required" custom="text-white" />
            </div>
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="text" placeholder="Enter Barcode" label="BarCode"
                    value="{{ $product->barcode }}" name="barcode" id="barcode" required="required"
                    custom="text-white" />
            </div>
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="number" placeholder="Enter Cost Price" label="Cost Price"
                    value="{{ $product->cost_price }}" name="cost_price" id="cost_price" required="required"
                    custom="text-white" />
            </div>
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="number" placeholder="Enter Alert Quantity" value="{{ $product->alert_quantity }}"
                    label="Alert Quantity" name="alert_quantity" id="alert_quantity" custom="text-white" />
            </div>
            <div class="col-md-6 col-12 mb-2">
                <x-form.input type="number" placeholder="Enter Selling Price" label="Selling Price"
                    value="{{ $product->selling_price }}" name="selling_price" id="selling_price" required="required"
                    custom="text-white" />
            </div>
            <div class="col-md-12 col-12 mb-2">
                <x-form.input type="text" placeholder="Enter Description" value="{{ $product->description }}"
                    label="Description" name="description" id="description" custom="text-white" />
            </div>
            <div class="col-md-12 col-12 mb-2">
                <x-form.file custom="" label="Product Image" value="{{ $product->image }}" accept="jpg,png,"
                    id="image" name="image" />
            </div>
        </div>
        <x-slot:footer>
            <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Update Product
            </x-buttons>
        </x-slot:footer>
    </x-modal>

    <x-alert_popup popupid="delete{{ $product->id }}" iconColor="text-danger" iconBg="bg-danger-subtle"
        icon="bi-exclamation-triangle" title="products">
        delete

        <x-slot:popup_button>
            <button class="btn btn-secondary">
                cencel
            </button>
            <button class="btn btn-danger">
                confirm
            </button>
        </x-slot:popup_button>

    </x-alert_popup>


</div>
