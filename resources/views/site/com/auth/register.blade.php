@extends('site.com.layouts.auth')

@section('title', 'Sign Up')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 rounded-5 auth-card overflow-hidden">
                    <div class="card-body p-xl-5 p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold font-1 text-primary-color mb-2">Create Account</h2>
                            <p class="text-muted small">Begin your wellness journey with us today</p>
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

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-primary-color small">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-4 border-2"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input type="text"
                                        class="form-control form-control-lg border-start-0 rounded-end-4 border-2 fs-6"
                                        id="name" name="name" value="{{ old('name') }}" required autofocus
                                        placeholder="John Doe">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-primary-color small">Email
                                    Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-4 border-2"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email"
                                        class="form-control form-control-lg border-start-0 rounded-end-4 border-2 fs-6"
                                        id="email" name="email" value="{{ old('email') }}" required
                                        placeholder="name@example.com">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
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
                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation"
                                        class="form-label fw-semibold text-primary-color small">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 rounded-start-4 border-2"><i
                                                class="bi bi-check2-circle text-muted"></i></span>
                                        <input type="password"
                                            class="form-control form-control-lg border-start-0 rounded-end-4 border-2 fs-6"
                                            id="password_confirmation" name="password_confirmation" required
                                            placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary-solid btn-lg rounded-pill fw-bold shadow-sm">
                                    Create Account <i class="bi bi-person-plus ms-2"></i>
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <p class="mb-0 text-muted small">Already have an account? <a href="{{ route('login') }}"
                                    class="text-primary-color fw-bold text-decoration-none">Sign In instead</a></p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 text-white">
                    <p class="small opacity-75">By signing up, you agree to our Terms of Service and Privacy Policy.</p>
                    <a href="{{ route('com.home') }}"
                        class="text-decoration-none text-white small hover-primary transition-all">
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
            background: white;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .transition-all {
            transition: all 0.2s ease;
        }
    </style>
@endsection