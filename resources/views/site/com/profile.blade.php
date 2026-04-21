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

            <div class="row g-4">
                <!-- Sidebar Navigation -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 100px;">
                        <ul class="nav flex-column gap-2 profile-nav">
                            <li class="nav-item">
                                <a class="nav-link active rounded-pill px-4 py-2 d-flex align-items-center gap-3 fw-bold" 
                                   href="#personal-details" style="transition: all 0.3s ease;">
                                    <i class="bi bi-person-circle fs-5"></i>
                                    <span>Personal Details</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-pill px-4 py-2 d-flex align-items-center gap-3 fw-bold text-muted" 
                                   href="#therapy-bookings" style="transition: all 0.3s ease;">
                                    <i class="bi bi-calendar-check fs-5"></i>
                                    <span>Therapy Bookings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-pill px-4 py-2 d-flex align-items-center gap-3 fw-bold text-muted" 
                                   href="#order-history" style="transition: all 0.3s ease;">
                                    <i class="bi bi-bag-check fs-5"></i>
                                    <span>Store Orders</span>
                                </a>
                            </li>
                            <li class="nav-item mt-3 pt-3 border-top">
                                <a class="nav-link text-danger rounded-pill px-4 py-2 d-flex align-items-center gap-3 fw-bold" 
                                   href="{{ route('com.logout') }}">
                                    <i class="bi bi-box-arrow-right fs-5"></i>
                                    <span>Logout Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="col-lg-9">
                    <!-- Section 1: Personal Details -->
                    <div id="personal-details" class="user-dashboard-section card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
                        <h4 class="font-1 fw-bold mb-4 d-flex align-items-center gap-3">
                            <i class="bi bi-person-fill text-primary"></i> Manage Information
                        </h4>
                        <form action="{{ route('com.profile.update') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Full Name</label>
                                    <input type="text" name="name" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Email Address</label>
                                    <input type="email" class="form-control rounded-3 py-2 px-4 bg-light border-secondary-subtle"
                                        value="{{ $user->email }}" readonly>
                                    <small class="text-muted">Email cannot be changed</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        value="{{ $user->phone }}" placeholder="Enter phone number">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Street Address</label>
                                    <textarea name="address" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        rows="3" placeholder="Enter your full address">{{ $user->address }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">City</label>
                                    <input type="text" name="city" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        value="{{ $user->city }}" placeholder="City">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">State</label>
                                    <input type="text" name="state" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        value="{{ $user->state }}" placeholder="State">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Postcode</label>
                                    <input type="text" name="postcode" class="form-control rounded-3 py-2 px-4 shadow-sm border-secondary-subtle"
                                        value="{{ $user->postcode }}" placeholder="Postcode">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Country</label>
                                    <select name="country" class="form-select rounded-3 py-2 px-4 shadow-sm border-secondary-subtle">
                                        <option value="India" {{ $user->country == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="USA" {{ $user->country == 'USA' ? 'selected' : '' }}>USA</option>
                                        <option value="UK" {{ $user->country == 'UK' ? 'selected' : '' }}>UK</option>
                                        <option value="Canada" {{ $user->country == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary-solid rounded-pill px-5 py-3 shadow-lg">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Section 2: Therapy Bookings -->
                    <div id="therapy-bookings" class="user-dashboard-section mb-5 pt-4 d-none">
                        <h4 class="font-1 fw-bold mb-4 d-flex align-items-center gap-3">
                            <i class="bi bi-calendar-check-fill text-primary"></i> Therapy Bookings
                        </h4>
                        @if($bookings->count() > 0)
                            <div class="row g-4">
                                @foreach($bookings as $booking)
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="card-body p-4">
                                                <div class="row align-items-center g-3">
                                                    <div class="col-md-auto">
                                                        <a href="{{ $booking->therapist ? route('com.team.single', $booking->therapist->id) : '#' }}" class="text-decoration-none">
                                                            <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center shadow-sm status-hover" style="width: 70px; height: 70px; transition: transform 0.3s ease;">
                                                                @if($booking->therapist && $booking->therapist->image)
                                                                    <img src="{{ Str::startsWith($booking->therapist->image, 'image/') ? asset($booking->therapist->image) : asset('storage/' . $booking->therapist->image) }}" 
                                                                         class="rounded-circle w-100 h-100 object-fit-cover shadow-sm">
                                                                @else
                                                                    <i class="bi bi-person-heart text-primary fs-2"></i>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex flex-wrap justify-content-between align-items-start mb-2">
                                                            <div>
                                                                <h6 class="mb-1 fw-bold fs-5 text-dark">
                                                                    {{ $booking->service->title ?? 'Therapy Session' }}
                                                                </h6>
                                                                <p class="mb-0 text-muted small fw-semibold">
                                                                    with <a href="{{ $booking->therapist ? route('com.team.single', $booking->therapist->id) : '#' }}" class="text-primary-color text-decoration-none hover-underline">{{ $booking->therapist->name ?? 'Therapist' }}</a>
                                                                </p>
                                                            </div>
                                                            <span class="badge rounded-pill {{ $booking->payment_status == 'paid' ? 'bg-success-subtle text-success border border-success' : 'bg-warning-subtle text-warning border border-warning' }} px-3 py-2 fw-bold small uppercase">
                                                                {{ strtoupper($booking->payment_status) }}
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-3 mt-3">
                                                            <div class="d-flex align-items-center gap-2 small text-muted">
                                                                <i class="bi bi-calendar-event text-primary"></i>
                                                                <span class="fw-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('D, d M Y') }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2 small text-muted">
                                                                <i class="bi bi-clock text-primary"></i>
                                                                <span>{{ $booking->booking_time }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2 small text-muted">
                                                                <i class="bi bi-camera-video text-primary"></i>
                                                                <span>{{ $booking->mode }}</span>
                                                            </div>
                                                            <div class="ms-auto fw-bold text-primary-color">
                                                                ₹{{ number_format($booking->amount) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="bi bi-calendar-x display-5 text-muted"></i>
                                </div>
                                <h6 class="text-muted fw-bold">No therapy sessions booked yet.</h6>
                                <p class="small text-muted mb-4">Start your wellness journey with our expert therapists.</p>
                                <div class="mt-2">
                                    <a href="{{ route('com.team') }}" class="btn btn-primary-solid rounded-pill px-4 py-2">
                                        Browse Therapists
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Section 3: Store Orders -->
                    <div id="order-history" class="user-dashboard-section pt-4 d-none">
                        <h4 class="font-1 fw-bold mb-4 d-flex align-items-center gap-3">
                            <i class="bi bi-bag-check-fill text-primary"></i> Wonder Store Orders
                        </h4>
                        @if($orders->count() > 0)
                            <div class="row g-4">
                                @foreach($orders as $order)
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="card-header bg-light-subtle border-0 py-3 px-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <span class="fw-bold text-dark">Order #{{ $order->id }}</span>
                                                        <span class="text-muted small">|</span>
                                                        <span class="text-muted small fw-semibold">{{ $order->created_at->format('d M Y') }}</span>
                                                    </div>
                                                    <span class="badge rounded-pill {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'processing' ? 'bg-info text-white' : 'bg-success') }} px-3 py-1 fw-bold small">
                                                        {{ strtoupper($order->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="order-items-list mb-3">
                                                    @foreach($order->items as $item)
                                                        <div class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom border-light-subtle">
                                                            <div class="flex-shrink-0">
                                                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center overflow-hidden" style="width: 50px; height: 50px;">
                                                                    @if($item->product && $item->product->product_image)
                                                                        <img src="{{ Str::startsWith($item->product->product_image, 'image/') ? asset($item->product->product_image) : asset('storage/' . $item->product->product_image) }}" 
                                                                             class="w-100 h-100 object-fit-cover">
                                                                    @else
                                                                        <i class="bi bi-box text-muted"></i>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0 small fw-bold text-dark">{{ $item->product_name }}</h6>
                                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                                    <span class="text-muted extra-small">Quantity: <span class="fw-bold">{{ $item->quantity }}</span></span>
                                                                    <span class="text-dark small fw-bold">₹{{ number_format($item->price * $item->quantity) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr class="opacity-10 my-3">
                                                <div class="d-flex justify-content-between align-items-center px-1">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-muted extra-small text-uppercase fw-bold">Total Amount</span>
                                                        <span class="fs-4 fw-bold text-primary-color mt-n1">₹{{ number_format($order->total_amount) }}</span>
                                                    </div>
                                                    <a href="{{ route('com.order.success', $order->id) }}"
                                                        class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">
                                                        Order Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 80px; height: 80px;">
                                    <i class="bi bi-cart-x display-5 text-muted"></i>
                                </div>
                                <h6 class="text-muted fw-bold">You haven't placed any store orders yet.</h6>
                                <p class="small text-muted mb-4">Discover our curated wellness products at the Wonder Store.</p>
                                <div class="mt-2 text-center text-md-start d-flex justify-content-center">
                                    <a href="{{ route('com.store') }}" class="btn btn-primary-solid rounded-pill px-4 py-2">
                                        Start Shopping
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .profile-nav .nav-link:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            color: var(--primary-color) !important;
        }
        .profile-nav .nav-link.active {
            background-color: var(--primary-color) !important;
            color: white !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = document.querySelectorAll('.user-dashboard-section');
            const navLinks = document.querySelectorAll('.profile-nav .nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href.startsWith('#')) {
                        e.preventDefault();
                        const targetId = href.substring(1);

                        // 1. Update Active Nav Link
                        navLinks.forEach(l => {
                            l.classList.remove('active');
                            l.classList.add('text-muted');
                        });
                        this.classList.add('active');
                        this.classList.remove('text-muted');

                        // 2. Toggle Sections
                        sections.forEach(section => {
                            if (section.getAttribute('id') === targetId) {
                                section.classList.remove('d-none');
                                // Animation/fade effect
                                section.style.opacity = '0';
                                setTimeout(() => {
                                    section.style.transition = 'opacity 0.4s ease';
                                    section.style.opacity = '1';
                                }, 50);
                            } else {
                                section.classList.add('d-none');
                            }
                        });

                        // 3. Optional: Scroll to top of content area on mobile
                        if (window.innerWidth < 992) {
                            window.scrollTo({
                                top: document.querySelector('.col-lg-9').offsetTop - 100,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection