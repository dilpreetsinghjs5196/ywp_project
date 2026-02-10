@extends('site.com.layouts.app')

@section('title', 'My Profile')

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
                    My Profile</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="section py-5">
        <div class="b-container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-5">
                <!-- User Details -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                        <h5 class="font-1 fw-bold mb-4">Personal Details</h5>
                        <form action="{{ route('com.profile.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small text-muted">Full Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill px-4"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Email Address</label>
                                    <input type="email" class="form-control rounded-pill px-4 bg-light"
                                        value="{{ $user->email }}" readonly>
                                    <small class="text-muted ms-3">Email cannot be changed</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control rounded-pill px-4"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Street Address</label>
                                    <textarea name="address" class="form-control rounded-4 px-4"
                                        rows="3">{{ $user->address }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">City</label>
                                    <input type="text" name="city" class="form-control rounded-pill px-4"
                                        value="{{ $user->city }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">State</label>
                                    <input type="text" name="state" class="form-control rounded-pill px-4"
                                        value="{{ $user->state }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Postcode</label>
                                    <input type="text" name="postcode" class="form-control rounded-pill px-4"
                                        value="{{ $user->postcode }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Country</label>
                                    <select name="country" class="form-select rounded-pill px-4">
                                        <option value="India" {{ $user->country == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="USA" {{ $user->country == 'USA' ? 'selected' : '' }}>USA</option>
                                        <option value="UK" {{ $user->country == 'UK' ? 'selected' : '' }}>UK</option>
                                        <option value="Canada" {{ $user->country == 'Canada' ? 'selected' : '' }}>Canada
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary-solid w-100 rounded-pill py-3 shadow">
                                        Update Profile
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{ route('com.logout') }}"
                                        class="text-danger text-decoration-none small fw-bold">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout Account
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order History -->
                <div class="col-lg-7">
                    <h5 class="font-1 fw-bold mb-4">Order History</h5>
                    @if($orders->count() > 0)
                        @foreach($orders as $order)
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Order #{{ $order->id }}</h6>
                                        <small class="text-muted">{{ $order->created_at->format('M d, Y h:i A') }}</small>
                                    </div>
                                    <span
                                        class="badge rounded-pill {{ $order->status == 'pending' ? 'bg-warning text-dark' : 'bg-success' }} px-3 py-2">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <hr class="opacity-10 my-3">
                                <div class="order-items-minimal">
                                    @foreach($order->items as $item)
                                        <div class="d-flex justify-content-between align-items-center mb-2 small">
                                            <span>{{ $item->product_name }} <span
                                                    class="text-muted">x{{ $item->quantity }}</span></span>
                                            <span class="fw-bold">Rs.{{ number_format($item->price * $item->quantity, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <hr class="opacity-10 my-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Total Amount</span>
                                    <span
                                        class="fs-5 fw-bold text-primary-color">Rs.{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('com.order.success', $order->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-4">
                                        View Full Receipt
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                            <i class="bi bi-bag-x display-4 text-muted mb-3"></i>
                            <h6 class="text-muted">You haven't placed any orders yet.</h6>
                            <div class="mt-3">
                                <a href="{{ route('com.store') }}" class="btn btn-primary-solid rounded-pill px-4">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection