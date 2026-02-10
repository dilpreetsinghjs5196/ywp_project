@extends('site.com.layouts.app')

@section('title', 'Register')

@section('content')
    @php
        $bgImagePath = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);
    @endphp
    <!-- Hero Section -->
    <section class="section position-relative"
        style="background: url('{{ $bgFullUrl }}'); background-size: cover; background-position: center; height: 40vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
            <div
                class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
                <h1 class="display-2 mb-0" style="font-weight: 900;">
                    Create Account</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Register
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Register Content -->
    <section class="section py-5">
        <div class="b-container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                        <h3 class="font-1 fw-bold text-center mb-2">Join Our Community</h3>
                        <p class="text-center text-muted mb-4">Create an account to save your cart and track your wellness
                            journey.</p>

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-pill px-4 mb-4" role="alert">
                                <ul class="mb-0 small">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('com.register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small text-muted ms-3">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill px-4"
                                    placeholder="Enter your full name" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small text-muted ms-3">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-4"
                                    placeholder="Enter your email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small text-muted ms-3">Password</label>
                                <input type="password" name="password" class="form-control rounded-pill px-4"
                                    placeholder="Minimum 8 characters" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small text-muted ms-3">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-pill px-4"
                                    placeholder="Re-enter your password" required>
                            </div>

                            <button type="submit" class="btn btn-primary-solid w-100 rounded-pill py-3 shadow mb-4">
                                Register Account <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            <div class="text-center">
                                <p class="small text-muted mb-0">Already have an account? <a href="{{ route('com.login') }}"
                                        class="text-primary-color fw-bold text-decoration-none">Login Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
@endsection