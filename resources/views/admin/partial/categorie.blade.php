@extends('admin.layout.view')
@section('title')
    Categories Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Categories Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Categories</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <x-buttons variant="btn-primary" type="button" modal="modal" modalid="#rohit12"
                        custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                        Add Categories
                    </x-buttons>
                </x-slot:buttons>

            </x-breadcrumb>
        </div>
    </div>
    <x-modal id="rohit12" action="{{ route('categorie.store') }}" method="POST" title="Add Categories" size="modal-lg">
        <x-form.input type="text" placeholder="Enter Category Name" label="name" name="name" id="name"
            required="required" custom="text-white" />
        <x-form.input type="text" placeholder="Enter Category Description" label="Description" name="description"
            id="description" required="required" custom="text-white" />
        <x-slot:footer>
            <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Submit
            </x-buttons>
        </x-slot:footer>
    </x-modal>
    <div class="col-md-12 p-3 table-responsive">
        <livewire:categorie-table>
            <livewire:category-modal-table>
                <livewire:delete-modal-table>
    </div>
@endsection
