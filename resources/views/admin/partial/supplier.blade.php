@extends('admin.layout.view')
@section('title')
    Supplier Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Supplier Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Supplier</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <x-buttons variant="btn-primary" type="button" modal="modal" modalid="#rohit12"
                        custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Add Supplier
                    </x-buttons>
                </x-slot:buttons>

            </x-breadcrumb>
            <x-modal id="rohit12" action="{{ route('supplier.store') }}" method="POST" title="Add Supplier"
                size="modal-xl">
                <div class="row p-3">
                    <!-- 1. Supplier Name -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Supplier Name" label="Supplier Name" name="name"
                            id="name" required="required" custom="text-white" />
                    </div>

                    <!-- 2. Phone Number -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Phone Number" label="Phone Number" name="phone"
                            id="phone" custom="text-white" />
                    </div>

                    <!-- 3. Email Address -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="email" placeholder="Enter Email Address" label="Email Address" name="email"
                            id="email" custom="text-white" />
                    </div>

                    <!-- 4. Company Name -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Company Name" label="Company Name"
                            name="company_name" id="company_name" custom="text-white" />
                    </div>

                    <!-- 5. GST Number -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter GST Number" label="GST Number" name="gst_number"
                            id="gst_number" required="required" custom="text-white" />
                    </div>

                    <!-- 6. Status Dropdown -->
                    <div class="col-md-6 col-12 mb-2">
                        <x-form.select custom="" label="Status" name="status" id="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </x-form.select>
                    </div>

                    <!-- 7. Address -->
                    <div class="col-md-12 col-12 mb-2">
                        <x-form.input type="text" placeholder="Enter Full Address" label="Address" name="address"
                            id="address" required="required" custom="text-white" />
                    </div>
                </div>

                <x-slot:footer>
                    <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Submit
                    </x-buttons>
                </x-slot:footer>
            </x-modal>
            <div class="col-md-12 bg-aside rounded-3 p-3 table-responsive border border-slate">
                <livewire:supplier-table />
                <livewire:supplier-modal-table />
                <livewire:delete-modal-table />
            </div>
        </div>
    </div>
@endsection
