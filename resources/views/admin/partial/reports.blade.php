@extends('admin.layout.view')

@section('title')
    Reports - Inventory Management System
@endsection

@section('header_title')
    Reports Overview
@endsection

@section('content')
    <div class="container-fluid p-4">
        <!-- Middle Content: Recent Products & Quick Actions -->
        <div class="row g-3 mb-4">
            <div class="container-fluid p-4">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="p-4 rounded-4 bg-gradient-header position-relative overflow-hidden shadow-sm">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative"
                                style="z-index: 2;">
                                <div>
                                    <h3 class="fw-bold text-white mb-1">
                                        Sales & Revenue Report 📊
                                    </h3>
                                    <p class="text-muted mb-0 small">
                                        Filter and view all your sales transactions based on dates.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="bg-aside border border-slate rounded-4 p-4 shadow-sm">
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom border-slate">
                                <h5 class="fw-bold text-white mb-0">
                                    <i class="bi bi-funnel text-accent me-2"></i> Filter Sales
                                </h5>
                            </div>

                            <form action="{{ route('reports.sales') }}" method="GET" class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase"
                                        style="letter-spacing: 0.5px;">Start Date</label>
                                    <!-- Dark theme styling for input -->
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" required
                                        class="form-control shadow-none"
                                        style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid #334155; color: white;">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label text-muted small fw-semibold text-uppercase"
                                        style="letter-spacing: 0.5px;">End Date</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" required
                                        class="form-control shadow-none"
                                        style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid #334155; color: white;">
                                </div>

                                <div class="col-md-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-accent px-4 py-2">
                                        <i class="bi bi-search me-1"></i> Search
                                    </button>
                                    <a href="{{ route('reports.sales') }}" class="btn btn-outline-light px-4 py-2"
                                        style="border-color: #334155;">
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="bg-aside border border-slate rounded-4 p-4 h-100 shadow-sm">
                            <div
                                class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-slate">
                                <div>
                                    <h5 class="fw-bold text-white mb-0">
                                        <i class="bi bi-receipt-cutoff text-accent me-2"></i> Transactions List
                                    </h5>
                                </div>
                                @if (request('start_date') && request('end_date'))
                                    <span class="badge badge-success fs-6">
                                        Showing: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M') }} to
                                        {{ \Carbon\Carbon::parse(request('end_date'))->format('d M, Y') }}
                                    </span>
                                @endif
                            </div>

                            @if (isset($sales) && count($sales) > 0)
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Customer Name</th>
                                                <th>Sale Date</th>
                                                <th>Payment Method</th>
                                                <th>Discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="fw-semibold text-white d-block">{{ $sale->invoice_no }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-light">{{ $sale->customer_name ?? 'N/A' }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-muted">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-M-Y') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($sale->payment_method == 'Cash')
                                                            <span
                                                                class="badge badge-success">{{ $sale->payment_method }}</span>
                                                        @else
                                                            <!-- Use your theme's warning badge style -->
                                                            <span class="badge"
                                                                style="background-color: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid #f59e0b;">{{ $sale->payment_method }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="fw-bold text-accent">
                                                        ₹{{ number_format($sale->discount, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <!-- Empty State matching your theme -->
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-3">No sales records found for the selected dates.</p>
                                    @if (request('start_date'))
                                        <a href="{{ route('reports.sales') }}" class="btn btn-outline-light btn-sm px-4"
                                            style="border-color: #334155;">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Clear Filters
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endsection
