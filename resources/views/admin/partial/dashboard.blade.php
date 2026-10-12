@extends('admin.layout.view')

@section('title')
    Dashboard - Inventory Management System
@endsection

@section('header_title')
    Dashboard Overview
@endsection

@section('content')
    <div class="container-fluid p-4">
        <!-- Welcome Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded-4 bg-gradient-header position-relative overflow-hidden shadow-sm">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative"
                        style="z-index: 2;">
                        <div>
                            <h3 class="fw-bold text-white mb-1">
                                Welcome Back, {{ Auth::guard('admin')->user()->name ?? 'Administrator' }} 👋
                            </h3>
                            <p class="text-muted mb-0 small">
                                Here is an overview of your inventory system status, products, invoices, and suppliers.
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('totalinvoice.add_product') }}" class="btn btn-accent px-3 py-2 text-nowrap">
                                <i class="bi bi-plus-circle me-1"></i> Create Invoice
                            </a>
                            <a href="{{ route('product.view') }}" class="btn btn-outline-light px-3 py-2 text-nowrap"
                                style="border-color: #334155;">
                                <i class="bi bi-box-seam me-1"></i> Add Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Cards Row -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <x-cards icon="bi bi-box-seam-fill" title="Total Products" value="{{ $stats['total_products'] ?? 0 }}"
                    trendClass="text-accent" trendIcon="bi bi-box"
                    treandText="{{ $stats['total_stock'] ?? 0 }} Units In Stock" iconColor="#06b6d4"
                    iconBg="rgba(6, 182, 212, 0.15)">
                </x-cards>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <x-cards icon="bi bi-tags-fill" title="Categories" value="{{ $stats['total_categories'] ?? 0 }}"
                    trendClass="text-info" trendIcon="bi bi-folder-check" treandText="Active Categories" iconColor="#a855f7"
                    iconBg="rgba(168, 85, 247, 0.15)">
                </x-cards>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <x-cards icon="bi bi-truck" title="Suppliers" value="{{ $stats['total_suppliers'] ?? 0 }}"
                    trendClass="text-warning" trendIcon="bi bi-people" treandText="Registered Vendors" iconColor="#f59e0b"
                    iconBg="rgba(245, 158, 11, 0.15)">
                </x-cards>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <x-cards icon="bi bi-receipt-cutoff" title="Total Invoices" value="{{ $stats['total_invoices'] ?? 0 }}"
                    trendClass="text-success" trendIcon="bi bi-check-circle"
                    treandText="Paid: {{ $stats['paid_invoices'] ?? 0 }} | Unpaid: {{ $stats['unpaid_invoices'] ?? 0 }}"
                    iconColor="#10b981" iconBg="rgba(16, 185, 129, 0.15)">
                </x-cards>
            </div>
        </div>

        <!-- Middle Content: Recent Products & Quick Actions -->
        <div class="row g-3 mb-4">
            <!-- Recent Products Overview -->
            <div class="col-12 col-lg-8">
                <div class="bg-aside border border-slate rounded-4 p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-slate">
                        <div>
                            <h5 class="fw-bold text-white mb-0">
                                <i class="bi bi-clock-history text-accent me-2"></i> Recent Products
                            </h5>
                            <small class="text-muted">Latest inventory items added to the system</small>
                        </div>
                        <a href="{{ route('product.view') }}"
                            class="btn btn-sm btn-outline-info rounded-pill px-3 py-1 fw-semibold"
                            style="font-size: 0.8rem;">
                            View All Products <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    @if (isset($stats['recent_products']) && count($stats['recent_products']) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stats['recent_products'] as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if ($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name }}" class="rounded-circle"
                                                            style="width: 32px; height: 32px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded-circle bg-accent text-white d-flex align-items-center justify-content-center fw-bold"
                                                            style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                            {{ strtoupper(substr($product->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <span
                                                            class="fw-semibold text-white d-block">{{ $product->name }}</span>
                                                        <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-accent">
                                                    {{ $product->category->name ?? 'General' }}
                                                </span>
                                            </td>
                                            <td class="fw-medium text-light">
                                                ₹{{ number_format($product->cost_price ?? 0, 2) }}</td>
                                            <td class="fw-bold text-accent">
                                                ₹{{ number_format($product->selling_price ?? 0, 2) }}</td>
                                            <td>
                                                @if (($product->quantity ?? 0) <= ($product->alert_quantity ?? 5))
                                                    <span class="badge badge-danger">Low Stock
                                                        ({{ $product->quantity }})
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">{{ $product->quantity }} in
                                                        Stock</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-3">No products available in inventory yet.</p>
                            <a href="{{ route('product.view') }}" class="btn btn-accent btn-sm px-4">
                                <i class="bi bi-plus-lg me-1"></i> Add First Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Management & Stats -->
            <div class="col-12 col-lg-4">
                <div
                    class="bg-aside border border-slate rounded-4 p-4 h-100 shadow-sm d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-white mb-3 pb-2 border-bottom border-slate">
                            <i class="bi bi-lightning-charge-fill text-warning me-2"></i> Quick Shortcuts
                        </h5>

                        <div class="d-grid quick-shortcuts gap-2 mb-4">
                            <a href="{{ route('product.view') }}"
                                class="btn  text-start p-3 border-slate d-flex align-items-center justify-content-between rounded-3 hover-accent">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon" style="width: 38px; height: 38px; font-size: 1.1rem;">
                                        <i class="bi bi-box-seam-fill"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">Manage Products</span>
                                        <small class="text-muted">Add, view or update items</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>

                            <a href="{{ route('categorie.view') }}"
                                class="btn text-start p-3 border-slate d-flex align-items-center justify-content-between rounded-3 hover-accent">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon"
                                        style="width: 38px; height: 38px; font-size: 1.1rem; color: #a855f7; background-color: rgba(168, 85, 247, 0.15);">
                                        <i class="bi bi-tags-fill"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">Categories</span>
                                        <small class="text-muted">Organize stock categories</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>

                            <a href="{{ route('totalinvoice.view') }}"
                                class="btn text-start p-3 border-slate d-flex align-items-center justify-content-between rounded-3 hover-accent">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon"
                                        style="width: 38px; height: 38px; font-size: 1.1rem; color: #10b981; background-color: rgba(16, 185, 129, 0.15);">
                                        <i class="bi bi-receipt-cutoff"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">View Invoices</span>
                                        <small class="text-muted">Check paid & unpaid bills</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>

                            <a href="{{ route('supplier.view') }}"
                                class="btn text-start p-3 border-slate d-flex align-items-center justify-content-between rounded-3 hover-accent">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon"
                                        style="width: 38px; height: 38px; font-size: 1.1rem; color: #f59e0b; background-color: rgba(245, 158, 11, 0.15);">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div>
                                        <span class="fw-semibold d-block">Suppliers</span>
                                        <small class="text-muted">Vendor & supplier directory</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 bg-card border border-slate text-center">
                        <small class="text-muted d-block mb-1 text-uppercase fw-semibold"
                            style="letter-spacing: 0.5px;">System Status</small>
                        <span class="badge badge-success fs-6"><i class="bi bi-check-circle-fill me-1"></i> Inventory
                            Ready & Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
