<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>

    <div class="wrapper">
        <!-- Mobile Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar Area -->
        <aside id="sidebar">
            <div class="sidebar-brand d-flex align-items-center justify-content-between">
                <div class="text-center">
                    <i class="bi bi-box-seam-fill text-accent me-2 fs-3"></i>
                    InventoryAdmin
                </div>
                <!-- Close Button for Mobile -->
                <button type="button" class="btn-close btn-close-white d-lg-none" id="sidebarCloseBtn"
                    aria-label="Close"></button>
            </div>
            <div class="py-3">
                <p class="px-4 mt-4 mb-2 mute-text">Overview</p>

                <a href="{{ route('dashboard.view') }}" class="nav-link-sidebar">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>

                <p class="px-4 mt-4 mb-2 mute-text">User Control</p>
                <a href="#" class="nav-link-sidebar">
                    <i class="bi bi-people-fill"></i> Users
                </a>

                <p class="px-4 mt-4 mb-2 mute-text">Inventory</p>
                <a href="{{ route('categorie.view') }}" class="nav-link-sidebar">
                    <i class="bi bi-tags-fill"></i> Categories
                </a>
                <a href="{{ route('product.view') }}" class="nav-link-sidebar">
                    <i class="bi bi-box-seam-fill"></i> Products
                </a>
                <a href="{{ route('supplier.view') }}" class="nav-link-sidebar">
                    <i class="bi bi-truck"></i> Suppliers
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i class="bi bi-archive-fill"></i> Stocks
                </a>
                <p class="px-4 mt-4 mb-2 mute-text">Invoices</p>
                <a href="#invoicesDropdown" class="nav-link-sidebar d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="invoicesDropdown">
                    <span><i class="bi bi-receipt-cutoff me-2"></i> All Invoices</span>
                    <i class="bi bi-chevron-down dropdown-arrow"></i>
                </a>

                <div class="collapse px-3" id="invoicesDropdown">
                    <a href="{{ route('totalinvoice.view') }}" class="nav-link-sidebar ps-4 py-2 d-block small">
                        <i class="bi bi-cart-plus-fill me-2"></i> Total Invoices
                    </a>
                    <a href="{{ route('totalinvoice.paid_invoice') }}" class="nav-link-sidebar ps-4 py-2 d-block small">
                        <i class="bi bi-cash-stack me-2"></i> Paid Invoices
                    </a>
                    <a href="{{ route('totalinvoice.unpaid_invoice') }}"
                        class="nav-link-sidebar ps-4 py-2 d-block small">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> Unpaid Invoices
                    </a>
                    <a href="{{ route('totalinvoice.add_product') }}" class="nav-link-sidebar ps-4 py-2 d-block small">
                        <i class="bi bi-list-task me-2"></i> Add Product Invoice
                    </a>
                </div>

                <p class="px-4 mt-4 mb-2 mute-text">Sales</p>
                <a href="{{ route('sales.view') }}" class="nav-link-sidebar">
                    <i class="bi bi-receipt"></i> Sale
                </a>
                <a href="{{ route('sales.items') }}" class="nav-link-sidebar">
                    <i class="bi bi-list-stars"></i> Sales Items
                </a>

                <p class="px-4 mt-4 mb-2 mute-text">Documents</p>
                <a href="#" class="nav-link-sidebar">
                    <i class="bi bi-file-earmark-text-fill"></i> Invoices
                </a>
                <a href="#" class="nav-link-sidebar">
                    <i class="bi bi-graph-up-arrow"></i> Reports
                </a>

                <p class="px-4 mt-4 mb-2 mute-text">System</p>
                <a href="#" class="nav-link-sidebar">
                    <i class="bi bi-gear-fill"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main>
            <!-- Header -->
            <header>
                <div class="d-flex align-items-center">
                    <button id="sidebarToggle" class="btn btn-link text-light d-lg-none me-3 p-0 text-decoration-none">
                        <i class="bi bi-list fs-2"></i>
                    </button>
                    <h5 class="mb-0 fw-bold text-light text-truncate d-none d-lg-block" style="min-width: 200px;">
                        @yield('header_title', 'Dashboard Overview')
                    </h5>
                </div>

                <!-- Search Option -->
                <div class="flex-grow-1 mx-3 mx-lg-4 d-none d-sm-block">
                    <div class="position-relative" style="max-width: 400px;">
                        <input type="text" class="form-control border-slate rounded-pill ps-4 pe-5 py-2"
                            placeholder="Search Products...">
                        <button
                            class="btn btn-link text-muted position-absolute end-0 top-50 translate-middle-y text-decoration-none pe-3"
                            type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Search Icon -->
                <button class="btn btn-link d-sm-none p-0 text-decoration-none me-auto ms-2">
                    <i class="bi bi-search fs-5"></i>
                </button>

                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <!-- Rounded Button Component -->
                    <x-admin.button variant="accent" class="shadow-sm d-none d-md-inline-flex py-1 px-3"
                        icon="bi bi-plus-lg" text="Create" style="font-size: 0.9rem;" />


                    <div class="position-relative cursor-pointer d-none d-sm-block ms-2">
                        <i class="bi bi-bell text-muted fs-5"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-accent border border-dark rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-dark bg-transparent border-0 p-0 d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-accent text-white d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; font-weight: bold; font-size: 1rem;">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </div>
                            <div class="text-start d-none d-md-block">
                                <span class="d-block text-white fw-medium lh-1"
                                    style="font-size: 0.9rem;">{{ Auth::guard('admin')->user()->name }}</span>
                                <span class="d-block text-muted mt-1" style="font-size: 0.75rem;">Administrator</span>
                            </div>
                            <i class="bi bi-chevron-down ms-1 text-muted d-none d-sm-block"
                                style="font-size: 0.8rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-slate shadow-lg mt-2">
                            <li><a class="dropdown-item py-2" href="#"><i
                                        class="bi bi-person me-2 text-muted"></i> My Profile</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i
                                        class="bi bi-shield-lock me-2 text-muted"></i> Security</a></li>
                            <li>
                                <hr class="dropdown-divider border-slate">
                            </li>
                            <li>
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger"><i
                                            class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Dynamic Content -->
            @yield('content')

        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts for Responsiveness -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            function toggleSidebar() {
                sidebar.classList.toggle("show");
                sidebarOverlay.classList.toggle("show");
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", toggleSidebar);
            }

            if (sidebarCloseBtn) {
                sidebarCloseBtn.addEventListener("click", toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener("click", toggleSidebar);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
