@extends('site.com.layouts.app')

@section('title', 'Your Shopping Cart')

@section('content')
    <!-- Hero Section -->
    <section class="section position-relative py-5 bg-light">
        <div class="b-container pt-4 text-center">
            <h1 class="display-4 font-1 fw-bold">Shopping Cart</h1>
            <p class="text-muted">Review your wellness journey essentials</p>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="section py-5">
        <div class="b-container">
            @if(count($cart) > 0)
                <div class="row g-5">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3">Product</th>
                                            <th class="py-3">Price</th>
                                            <th class="py-3">Quantity</th>
                                            <th class="py-3">Subtotal</th>
                                            <th class="pe-4 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $id => $details)
                                            <tr data-id="{{ $id }}">
                                                <td class="ps-4 py-4">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/' . $details['image']) }}"
                                                            alt="{{ $details['name'] }}" class="rounded-3 shadow-sm me-3"
                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="font-1 fw-bold mb-1">{{ $details['name'] }}</h6>
                                                            <span
                                                                class="badge bg-light text-primary-color border">{{ $details['category'] }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 font-1 fw-bold">Rs.{{ number_format($details['price'], 2) }}</td>
                                                <td class="py-4">
                                                    <div class="input-group" style="width: 120px;">
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm rounded-start-pill px-3 update-cart"
                                                            data-type="minus">
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                        <input type="number"
                                                            class="form-control form-control-sm text-center quantity-input"
                                                            value="{{ $details['quantity'] }}" readonly>
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm rounded-end-pill px-3 update-cart"
                                                            data-type="plus">
                                                            <i class="bi bi-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="py-4 font-1 fw-bold text-primary-color">
                                                    Rs.{{ number_format($details['price'] * $details['quantity'], 2) }}
                                                </td>
                                                <td class="pe-4 py-4 text-end">
                                                    <button
                                                        class="btn btn-light btn-sm rounded-circle shadow-sm remove-from-cart text-danger"
                                                        title="Remove Item">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('com.store') }}" class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                            <h5 class="font-1 fw-bold mb-4">Order Summary</h5>

                            @php $total = 0 @endphp
                            @foreach($cart as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold">Rs.{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping</span>
                                <span class="text-success fw-bold">Free</span>
                            </div>
                            <hr class="my-4 opacity-10">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5 font-1 fw-bold">Total</span>
                                <span class="fs-4 font-1 fw-bold text-primary-color">Rs.{{ number_format($total, 2) }}</span>
                            </div>

                            <button class="btn btn-primary-solid w-100 rounded-pill py-3 shadow">
                                Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                            </button>

                            <div class="mt-4 text-center">
                                <p class="small text-muted">
                                    <i class="bi bi-shield-lock me-1"></i> Secure Checkout Guaranteed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="display-1 text-muted opacity-25 mb-4">
                        <i class="bi bi-cart-x"></i>
                    </div>
                    <h3 class="font-1 fw-bold">Your cart is empty</h3>
                    <p class="text-muted">Looks like you haven't added any wellness products yet.</p>
                    <a href="{{ route('com.store') }}" class="btn btn-primary-solid rounded-pill px-5 mt-4 py-3">
                        Start Shopping <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    @push('js')
        <script>
            $(document).ready(function () {
                // Update Quantity
                $('.update-cart').on('click', function () {
                    const btn = $(this);
                    const row = btn.parents('tr');
                    const id = row.data('id');
                    const type = btn.data('type');
                    const input = row.find('.quantity-input');
                    let quantity = parseInt(input.val());

                    if (type === 'plus') {
                        quantity++;
                    } else {
                        if (quantity > 1) quantity--;
                    }

                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        method: "PATCH",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            quantity: quantity
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                });

                // Remove Item
                $('.remove-from-cart').on('click', function () {
                    if (confirm("Are you sure you want to remove this product?")) {
                        const id = $(this).parents('tr').data('id');

                        $.ajax({
                            url: "{{ route('cart.remove') }}",
                            method: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            success: function (response) {
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

    <style>
        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .update-cart {
            border-color: #dee2e6;
        }

        .update-cart:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .remove-from-cart:hover {
            background-color: #fff5f5 !important;
            transform: scale(1.1);
            transition: all 0.2s ease;
        }
    </style>
@endsection