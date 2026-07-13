<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            /* Slate 900 for a premium dark feel */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }

        .card {
            background-color: #1e293b;
            /* Slate 800 */
            border: 1px solid #334155;
            /* Slate 700 */
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        /* Custom accent color (Cyan) */
        .text-accent {
            color: #06b6d4 !important;
            /* Cyan 500 */
        }

        .btn-accent {
            background-color: #06b6d4;
            border-color: #06b6d4;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: #0891b2;
            /* Cyan 600 */
            border-color: #0891b2;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
        }

        .input-group-text {
            background-color: #334155;
            border-color: #475569;
            color: #94a3b8;
        }

        .form-control {
            background-color: #0f172a;
            border-color: #475569;
            color: #f8fafc;
        }

        .form-control:focus {
            background-color: #0f172a;
            border-color: #06b6d4;
            box-shadow: 0 0 0 0.25rem rgba(6, 182, 212, 0.25);
            color: #f8fafc;
        }

        .form-check-input:checked {
            background-color: #06b6d4;
            border-color: #06b6d4;
        }

        .input-icon {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white"><i class="bi bi-shield-lock-fill text-accent me-2"></i>Admin Panel</h2>
            <p class="text-secondary">Secure access to your application</p>
        </div>

        <div class="card">
            <div class="card-body p-4 p-sm-5">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                        <div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.auth') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label text-light fw-medium">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope input-icon"></i></span>
                            <input type="email" class="form-control form-control-lg fs-6" id="email"
                                name="email" value="{{ old('email') }}" placeholder="admin@example.com" required
                                autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-light fw-medium">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key input-icon"></i></span>
                            <input type="password" class="form-control form-control-lg fs-6" id="password"
                                name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-secondary" for="remember">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <x-admin.button type="submit" variant="accent" class="btn-lg" icon="bi bi-box-arrow-in-right" text="Login" />
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <small class="text-muted">&copy; {{ date('Y') }} All rights reserved.</small>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
