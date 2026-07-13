@extends('admin.layout.view')
@section('title')
    Sales Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div class="row g-3">
            <x-breadcrumb class="mb-0" heading="Sales Overview">
                <x-breadcrumb-item href="{{ route('dashboard.view') }}" custom="fw-medium text-decoration-none hover-accent">
                    Dashboard /
                </x-breadcrumb-item>

                <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                    <span class="text-accent fw-bold">Sales</span>
                </x-breadcrumb-item>
                <x-slot:buttons>
                    <a href="{{ route('sales.items') }}"
                        class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm btn-accent">
                        <i class="bi bi-plus-lg me-2"></i> Sale Product
                    </a>
                </x-slot:buttons>
            </x-breadcrumb>


            <div class="col-md-12 bg-aside rounded-3 p-3 table-responsive">
                <livewire:sales-table>
                    <livewire:global-modal />
                    <livewire:delete-modal-table>
                        {{-- <livewire:invoice-show-modal>
                            <livewire:invoice-pay-modal> --}}

            </div>
        </div>
    </div>
@endsection
