@extends('site.com.layouts.app')

@section('content')
<section class="coupon-request-section py-5" style="background: linear-gradient(135deg, #f3f6fa 0%, #dbe5f0 100%); min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%) !important;">
                        <h3 class="mb-0 text-white font-1" style="font-weight: 700; letter-spacing: 0.5px;">Request a Coupon</h3>
                        <p class="mb-0 opacity-75 font-2" style="font-size: 0.95rem;">Get exclusive discounts on your next therapy session</p>
                    </div>
                    <div class="card-body p-5">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('coupon.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="user_name" class="form-label fw-bold font-1">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 bg-light @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="Enter your full name" value="{{ old('user_name') }}" style="border-radius: 0 10px 10px 0;" required>
                                </div>
                                @error('user_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="user_email" class="form-label fw-bold font-1">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 bg-light @error('user_email') is-invalid @enderror" id="user_email" name="user_email" placeholder="Enter your email" value="{{ old('user_email') }}" style="border-radius: 0 10px 10px 0;" required>
                                </div>
                                @error('user_email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm mb-2 scale-hover" style="border-radius: 10px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border: none; font-weight: 600;">
                                    Generate My Coupon <i class="fas fa-magic ms-2"></i>
                                </button>
                                <a href="{{ route('com.team') }}" class="btn btn-outline-primary btn-lg shadow-sm scale-hover" style="border-radius: 10px; border: 2px solid var(--primary-color); color: var(--primary-color); background: transparent; font-weight: 600;">
                                    Go to Booking Page <i class="fas fa-calendar-alt ms-2"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
