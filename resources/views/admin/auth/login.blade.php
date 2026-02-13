<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - YWP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #044A80;
            --secondary-color: #ffbf00;
        }

        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.8rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #033a66;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(4, 74, 128, 0.1);
        }
    </style>
</head>

<body>
    <div class="login-card card">
        <div class="login-header">
            <h3 class="mb-0 fw-bold">YWP Admin</h3>
            <p class="mb-0 opacity-75 small">Sign in to your dashboard</p>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger small mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i
                                class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0"
                            placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i
                                class="bi bi-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0"
                            placeholder="••••••••" required>
                    </div>
                </div>
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small" for="remember">Remember me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Login to Dashboard</button>
                <div class="text-center">
                    <a href="{{ route('com.home') }}" class="small text-muted text-decoration-none"><i
                            class="bi bi-arrow-left me-1"></i> Back to Website</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>