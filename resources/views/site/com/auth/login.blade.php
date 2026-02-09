@extends('site.com.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 rounded-5 auth-card overflow-hidden">
                    <div class="card-body p-xl-5 p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold font-1 text-primary-color mb-2">Welcome Back</h2>
                            <p class="text-muted small">Enter your credentials to join your safe space</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-4 small mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-primary-color small">Email
                                    Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-4 border-2"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email"
                                        class="form-control form-control-lg border-start-0 rounded-end-4 border-2 fs-6"
                                        id="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="name@example.com">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password"
                                    class="form-label fw-semibold text-primary-color small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-4 border-2"><i
                                            class="bi bi-lock text-muted"></i></span>
                                    <input type="password"
                                        class="form-control form-control-lg border-start-0 rounded-end-4 border-2 fs-6"
                                        id="password" name="password" required placeholder="••••••••">
                                </div>
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small text-muted" for="remember">
                                        Keep me signed in
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-primary-color text-decoration-none small fw-bold">Forgot?</a>
                                @endif
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary-solid btn-lg rounded-pill fw-bold shadow-sm">
                                    Sign In <i class="bi bi-arrow-right-short ms-2"></i>
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <p class="mb-0 text-muted small">New here? <a href="{{ route('register') }}"
                                    class="text-primary-color fw-bold text-decoration-none">Create an account</a></p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('com.home') }}"
                        class="text-decoration-none text-muted small hover-primary transition-all">
                        <i class="bi bi-house-door me-1"></i> Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-text {
            border-color: #dee2e6;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
        }

        .hover-primary:hover {
            color: var(--primary-color) !important;
        }

        .transition-all {
            transition: all 0.2s ease;
        }
    </style>
@endsection