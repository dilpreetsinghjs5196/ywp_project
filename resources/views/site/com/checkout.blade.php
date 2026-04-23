@extends('site.com.layouts.app')

@section('title', 'Checkout')

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
                    Checkout</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Checkout
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <style>
        .form-check-input:checked {
            background-color: var(--primary-color, #044A80);
            border-color: var(--primary-color, #044A80);
        }

        .form-check-input:focus {
            border-color: var(--primary-color, #044A80);
            box-shadow: 0 0 0 0.25rem rgba(4, 74, 128, 0.25);
        }
    </style>

    <!-- Checkout Content -->
    <section class="section py-5">
        <div class="b-container">
            <form action="#" method="POST" id="checkout-form">
                @csrf
                @guest
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light border-start border-primary border-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 text-primary-color me-3"></i>
                            <div>
                                <span class="fw-bold">Already have an account?</span>
                                <a href="javascript:void(0)" class="text-primary-color ms-2 fw-bold" id="toggle-login">Click
                                    here to login</a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 d-none" id="login-section">
                        <h5 class="font-1 fw-bold mb-4">Login to Your Account</h5>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label small text-muted">Email Address</label>
                                <input type="email" id="login_email" class="form-control rounded-pill px-4">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small text-muted">Password</label>
                                <input type="password" id="login_password" class="form-control rounded-pill px-4">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-primary-solid w-100 rounded-pill"
                                    id="btn-login-ajax">Login</button>
                            </div>
                        </div>
                        <div id="login-error" class="text-danger small mt-2 d-none"></div>
                    </div>
                @endguest

                <div class="row g-5">
                    <!-- Shipping & Billing Details -->
                    @php
                        $fullName = auth()->user()->name ?? '';
                        $nameParts = explode(' ', trim($fullName), 2);
                        $firstName = $nameParts[0] ?? '';
                        $lastName = $nameParts[1] ?? '';
                    @endphp
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="font-1 fw-bold mb-4">Contact Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">First Name</label>
                                    <input type="text" name="first_name" class="form-control rounded-pill px-4"
                                        value="{{ $firstName }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Last Name</label>
                                    <input type="text" name="last_name" class="form-control rounded-pill px-4"
                                        value="{{ $lastName }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Email Address</label>
                                    <input type="email" name="email" id="checkout_email"
                                        class="form-control rounded-pill px-4" value="{{ auth()->user()->email ?? '' }}"
                                        required>
                                    <div id="email-exists-msg" class="small mt-1 d-none">
                                        <span class="text-primary-color fw-bold">Email already exists. <a
                                                href="javascript:void(0)" onclick="$('#toggle-login').click()">Login
                                                instead?</a></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control rounded-pill px-4"
                                        value="{{ auth()->user()->phone ?? '' }}" required>
                                </div>

                                @guest
                                    <div class="col-12 mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="create_account"
                                                id="create-account-check">
                                            <label class="form-check-label fw-bold" for="create-account-check">
                                                Create an account? <span class="text-danger small">(Mandatory to complete
                                                    order)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3 d-none password-fields">
                                        <label class="form-label small text-muted">Account Password</label>
                                        <input type="password" name="password" id="reg-password"
                                            class="form-control rounded-pill px-4">
                                    </div>
                                    <div class="col-md-6 mt-3 d-none password-fields">
                                        <label class="form-label small text-muted">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="reg-password-confirm"
                                            class="form-control rounded-pill px-4">
                                    </div>
                                @endguest
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h5 class="font-1 fw-bold mb-4">Shipping Address</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small text-muted">Street Address</label>
                                    <input type="text" name="address" class="form-control rounded-pill px-4"
                                        placeholder="House number and street name"
                                        value="{{ auth()->user()->address ?? '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">City</label>
                                    <input type="text" name="city" class="form-control rounded-pill px-4"
                                        value="{{ auth()->user()->city ?? '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">State / Province</label>
                                    <input type="text" name="state" class="form-control rounded-pill px-4"
                                        value="{{ auth()->user()->state ?? '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Postcode / ZIP</label>
                                    <input type="text" name="postcode" class="form-control rounded-pill px-4"
                                        value="{{ auth()->user()->postcode ?? '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Country</label>
                                    <select name="country" class="form-select rounded-pill px-4" required>
                                        <option value="India" {{ (auth()->user()->country ?? '') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="USA" {{ (auth()->user()->country ?? '') == 'USA' ? 'selected' : '' }}>
                                            USA</option>
                                        <option value="UK" {{ (auth()->user()->country ?? '') == 'UK' ? 'selected' : '' }}>UK
                                        </option>
                                        <option value="Canada" {{ (auth()->user()->country ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="font-1 fw-bold mb-0">Permanent Address</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="same_as_shipping"
                                        id="same-as-shipping">
                                    <label class="form-check-label small" for="same-as-shipping">
                                        Same as Shipping
                                    </label>
                                </div>
                            </div>
                            <div id="permanent-address-fields" class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small text-muted">Street Address</label>
                                    <input type="text" name="permanent_address" class="form-control rounded-pill px-4"
                                        placeholder="House number and street name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">City</label>
                                    <input type="text" name="permanent_city" class="form-control rounded-pill px-4">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">State / Province</label>
                                    <input type="text" name="permanent_state" class="form-control rounded-pill px-4">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Postcode / ZIP</label>
                                    <input type="text" name="permanent_postcode" class="form-control rounded-pill px-4">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Country</label>
                                    <select name="permanent_country" class="form-select rounded-pill px-4">
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="UK">UK</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                            <h5 class="font-1 fw-bold mb-4">Payment Method</h5>
                            <div class="payment-options">
                                <div
                                    class="form-check border rounded-pill px-4 py-3 mb-3 transition-all payment-option-check">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="cod"
                                        value="cod" checked>
                                    <label class="form-check-label w-100 fw-bold" for="cod">
                                        Cash on Delivery
                                        <span class="d-block small text-muted fw-normal">Pay when your order is delivered to
                                            your doorstep.</span>
                                    </label>
                                </div>
                                <div
                                    class="form-check border rounded-pill px-4 py-3 mb-0 transition-all payment-option-check">
                                    <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="online"
                                        value="online">
                                    <label class="form-check-label w-100 fw-bold" for="online">
                                        Online Payment (Razorpay)
                                        <span class="d-block small text-muted fw-normal">Secure payment via Credit/Debit
                                            card, UPI, or Netbanking.</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Sidebar -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                            <h5 class="font-1 fw-bold mb-4">Your Order</h5>

                            <div class="order-items-scroll mb-4" style="max-height: 300px; overflow-y: auto;">
                                @php $total = 0 @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}"
                                                class="rounded-3 shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary-color border border-white">
                                                {{ $details['quantity'] }}
                                            </span>
                                        </div>
                                        <div class="ms-4 flex-grow-1">
                                            <h6 class="font-1 fw-bold mb-0 small">{{ $details['name'] }}</h6>
                                            <span class="text-muted extra-small">{{ $details['category'] }}</span>
                                        </div>
                                        <div class="text-end">
                                            <span
                                                class="fw-bold small text-primary-color">Rs.{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4 opacity-10">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold">Rs.{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping</span>
                                <span class="text-success fw-bold">Free</span>
                            </div>
                            <hr class="my-3 opacity-10">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5 font-1 fw-bold">Total</span>
                                <span
                                    class="fs-4 font-1 fw-bold text-primary-color">Rs.{{ number_format($total, 2) }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary-solid w-100 rounded-pill py-3 shadow mb-3">
                                Place Order <i class="bi bi-check2-circle ms-2"></i>
                            </button>

                            <div class="text-center">
                                <a href="{{ route('com.cart') }}"
                                    class="text-decoration-none small text-muted hover-primary">
                                    <i class="bi bi-arrow-left me-1"></i> Return to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <style>
        .payment-option-check {
            cursor: pointer;
        }

        .payment-option-check:hover:not(:has(input:disabled)) {
            border-color: var(--primary-color) !important;
            background-color: rgba(4, 74, 128, 0.02);
        }

        .payment-option-check:has(input:checked) {
            border-color: var(--primary-color) !important;
            background-color: rgba(4, 74, 128, 0.05);
        }

        .extra-small {
            font-size: 0.75rem;
        }

        .hover-primary:hover {
            color: var(--primary-color) !important;
        }

        .order-items-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .order-items-scroll::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle Login Section
            $('#toggle-login').on('click', function () {
                $('#login-section').toggleClass('d-none');
                $(this).text($('#login-section').hasClass('d-none') ? 'Click here to login' : 'Close login section');
            });

            // Email Existence Check
            let emailTimeout = null;
            $('#checkout_email').on('input', function () {
                clearTimeout(emailTimeout);
                const email = $(this).val();
                const msgDiv = $('#email-exists-msg');

                if (email.length > 5 && email.includes('@')) {
                    emailTimeout = setTimeout(() => {
                        $.ajax({
                            url: "{{ route('cart.check-email') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                email: email
                            },
                            success: function (response) {
                                if (response.exists) {
                                    msgDiv.removeClass('d-none');
                                } else {
                                    msgDiv.addClass('d-none');
                                }
                            }
                        });
                    }, 500);
                } else {
                    msgDiv.addClass('d-none');
                }
            });

            // AJAX Login
            $('#btn-login-ajax').on('click', function () {
                const email = $('#login_email').val();
                const password = $('#login_password').val();
                const btn = $(this);
                const errorDiv = $('#login-error');

                if (!email || !password) {
                    errorDiv.text('Please enter both email and password').removeClass('d-none');
                    return;
                }

                btn.prop('disabled', true).text('Logging in...');
                errorDiv.addClass('d-none');

                $.ajax({
                    url: "{{ route('login.ajax') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email,
                        password: password
                    },
                    success: function (response) {
                        if (response.success) {
                            window.location.reload();
                        }
                    },
                    error: function (xhr) {
                        btn.prop('disabled', false).text('Login');
                        const msg = xhr.responseJSON?.message || 'Invalid credentials. Please try again.';
                        errorDiv.text(msg).removeClass('d-none');
                    }
                });
            });

            // Toggle Account Password Fields
            $('#create-account-check').on('change', function () {
                if ($(this).is(':checked')) {
                    $('.password-fields').removeClass('d-none');
                    $('#reg-password, #reg-password-confirm').prop('required', true);
                } else {
                    $('.password-fields').addClass('d-none');
                    $('#reg-password, #reg-password-confirm').prop('required', false);
                }
            });

            // Toggle Permanent Address Fields
            $('#same-as-shipping').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#permanent-address-fields').addClass('d-none');
                    $('#permanent-address-fields input, #permanent-address-fields select').prop('required', false);
                } else {
                    $('#permanent-address-fields').removeClass('d-none');
                    $('#permanent-address-fields input, #permanent-address-fields select').prop('required', true);
                }
            });

            // Trigger change on load to ensure correct state if needed (e.g. browser back)
            $('#same-as-shipping').trigger('change');

            // Form submission handling
            const form = document.getElementById('checkout-form');
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // If logged in, proceed directly
                @auth
                    processCheckout();
                @else
                            // If guest, check email status first
                            const email = $('#checkout_email').val();
                    if (!email) {
                        alert('Please enter your email address');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('cart.check-email') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        success: function (response) {
                            if (response.exists) {
                                // Returning User
                                alert('You already have an account. Please login first to complete your order.');
                                if ($('#login-section').hasClass('d-none')) {
                                    $('#toggle-login').click();
                                }
                                $('#login_password').focus();
                            } else {
                                // New User
                                if (!$('#create-account-check').is(':checked')) {
                                    alert('Please check the box to "Create an account" to complete your order.');
                                    $('#create-account-check').focus();
                                } else {
                                    processCheckout();
                                }
                            }
                        }
                    });
                @endauth
                });

            function processCheckout() {
                const submitBtn = $('#checkout-form').find('button[type="submit"]');
                const originalText = submitBtn.html();

                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...');

                $.ajax({
                    url: "{{ route('com.checkout.process') }}",
                    method: "POST",
                    data: $('#checkout-form').serialize(),
                    success: function (response) {
                        if (response.success) {
                            if (response.require_payment) {
                                // Online Payment Flow
                                var options = {
                                    "key": response.razorpay_key,
                                    "amount": response.amount,
                                    "currency": response.currency,
                                    "name": "Wonder Store",
                                    "description": "Order Payment",
                                    "order_id": response.razorpay_order_id,
                                    "handler": function (payResponse) {
                                        // Verify payment on backend
                                        $.ajax({
                                            url: "{{ route('razorpay.verify') }}",
                                            method: "POST",
                                            data: {
                                                _token: response.new_token || "{{ csrf_token() }}",
                                                order_id: response.order_id,
                                                razorpay_payment_id: payResponse.razorpay_payment_id,
                                                razorpay_order_id: payResponse.razorpay_order_id,
                                                razorpay_signature: payResponse.razorpay_signature
                                            },
                                            success: function (verifyResponse) {
                                                if (verifyResponse.success) {
                                                    window.location.href = verifyResponse.redirect;
                                                }
                                            }
                                        });
                                    },
                                    "prefill": response.customer,
                                    "theme": {
                                        "color": "#044A80"
                                    },
                                    "modal": {
                                        "ondismiss": function () {
                                            submitBtn.prop('disabled', false).html(originalText);
                                        }
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                            } else {
                                // COD Flow
                                window.location.href = response.redirect;
                            }
                        }
                    },
                    error: function (xhr) {
                        submitBtn.prop('disabled', false).html(originalText);
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            let errorMsg = '';
                            Object.keys(errors).forEach(key => {
                                errorMsg += errors[key][0] + '\n';
                            });
                            alert(errorMsg);
                        } else {
                            alert(xhr.responseJSON?.message || 'Something went wrong. Please try again.');
                        }
                    }
                });
            }

            // Make the whole card clickable for payment options
            document.querySelectorAll('.payment-option-check').forEach(card => {
                card.addEventListener('click', function () {
                    const radio = this.querySelector('input[type="radio"]');
                    if (!radio.disabled) {
                        radio.checked = true;
                    }
                });
            });
        });
    </script>
@endsection