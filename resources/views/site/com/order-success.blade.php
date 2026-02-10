@extends('site.com.layouts.app')

@section('title', 'Order Success')

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
                <i class="bi bi-check-circle-fill display-1 text-success mb-2"></i>
                <h1 class="display-3 mb-0" style="font-weight: 900;">Order Placed!</h1>
                <p class="lead">Thank you for your purchase. Your wellness journey continues.</p>
            </div>
        </div>
    </section>

    <!-- Success Content -->
    <section class="section py-5">
        <div class="b-container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center mb-5">
                        <h2 class="font-1 fw-bold mb-4">Order #{{ $order->id }}</h2>
                        <p class="text-muted mb-4">A confirmation email has been sent to
                            <strong>{{ $order->email }}</strong>
                        </p>

                        <div class="row g-4 text-start mb-5">
                            <div class="col-md-4">
                                <h6 class="text-muted small text-uppercase fw-bold mb-2">Shipping Address</h6>
                                <p class="mb-0">
                                    {{ $order->first_name }} {{ $order->last_name }}<br>
                                    {{ $order->address }}<br>
                                    {{ $order->city }}, {{ $order->state }} {{ $order->postcode }}<br>
                                    {{ $order->country }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted small text-uppercase fw-bold mb-2">Permanent Address</h6>
                                <p class="mb-0">
                                    {{ $order->first_name }} {{ $order->last_name }}<br>
                                    {{ $order->permanent_address }}<br>
                                    {{ $order->permanent_city }}, {{ $order->permanent_state }}
                                    {{ $order->permanent_postcode }}<br>
                                    {{ $order->permanent_country }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted small text-uppercase fw-bold mb-2">Order Summary</h6>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Payment Method:</span>
                                    <span class="fw-bold">{{ strtoupper($order->payment_method) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Total Amount:</span>
                                    <span
                                        class="fw-bold text-primary-color fs-5">Rs.{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-5">
                            <table class="table table-borderless align-middle">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class="text-start py-3">Product</th>
                                        <th class="text-center py-3">Quantity</th>
                                        <th class="text-end py-3">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="text-start py-3">
                                                <div class="fw-bold">{{ $item->product_name }}</div>
                                            </td>
                                            <td class="text-center py-3">{{ $item->quantity }}</td>
                                            <td class="text-end py-3 fw-bold text-primary-color">
                                                Rs.{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('com.store') }}" class="btn btn-primary-solid rounded-pill px-5 py-3">
                                Continue Shopping
                            </a>
                            <a href="{{ route('com.home') }}" class="btn btn-outline-dark rounded-pill px-5 py-3">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection