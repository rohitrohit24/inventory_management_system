@extends('admin.layout.view')
@section('content')
    <h1 class="text-accent">rohit</h1>

    <x-buttons variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
        Save
    </x-buttons>

    <x-badge_button custom="text-warning rounded-pill  border border-warning">
        pernding
    </x-badge_button>

    <div class="col-md-3">
        <x-form.input type="text" placeholder="welcome" label="name" name="name" id="name" required="required"
            custom="text-white">
        </x-form.input>
        <x-form.select custom="" label="product" name="product" id="product">
            <option value="">one</option>
            <option value="">two</option>
        </x-form.select>
        <x-form.textarea custom="" label="product" rows="3" id="product" name="product">
        </x-form.textarea>
        <x-form.file custom="" label="product" accept="jpg" id="product" name="product">
        </x-form.file>
        <div class="col-md-5 d-flex ">
            <x-form.checkbox custom="" label="product" value="1" id="product" name="product">
            </x-form.checkbox>
            <x-form.checkbox custom="" checked="true" label="product" value="1" id="product" name="product">
            </x-form.checkbox>
        </div>
        <div class="col-md-5 d-flex ">
            <x-form.radio custom="" label="product" value="1" id="product" name="product">
            </x-form.radio>
            <x-form.radio custom="" label="product" value="1" id="product" name="product">
            </x-form.radio>
        </div>
    </div>
    <x-action-buttons type="button" title="edit" modal="modal" modal_id="#rohit"
        custom="btn-sm action-buttons btn-outline-info">
        <i class="bi bi-pencil"></i>
    </x-action-buttons>
    <div class="col-md-3">

        <button type="button" class="btn mb-4 btn-primary" data-bs-toggle="modal" data-bs-target="#rohit">
            Launch demo modal
        </button>
        {{-- @if ($admin)
            <x-alert type="danger">
                error
            </x-alert>
        @endif --}}
    </div>
    <div class="col-md-3 my-5">
        <x-cards class="" icon="bi bi-google" title="products" value="45" treandClass=""
            trendIcon="bi-graph-up-arrow" treandText="12% last month">
        </x-cards>

    </div>
    <div class="col-md-3">

        <x-product_cards class="" icon="bi bi-google" title="products" subtitle="category" value="500"
            stockvalue="45 total stock">
            <x-slot:card_button>
                <x-buttons variant="btn-primary" custom="btn-md shadow-lg">
                    view
                </x-buttons>
            </x-slot:card_button>
        </x-product_cards>
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
            Open first modal
        </button>
        <x-alert_popup popupid="exampleModalToggle" icon="bi-exclamation-triangle" title="products">
            delete

            <x-slot:popup_button>
                <button class="btn btn-danger">
                    cencel
                </button>
                <button class="btn btn-danger">
                    confirm
                </button>
            </x-slot:popup_button>

        </x-alert_popup>
    </div>


    <x-modal id="rohit" title="Add Product" action="" method="POST">

        <x-form.input type="text" placeholder="welcome" label="name" name="name" id="name" required="required"
            custom="text-white" />

        <x-slot:footer>

            <x-buttons variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Save
            </x-buttons>

        </x-slot:footer>

    </x-modal>
@endsection
