@extends('site.com.layouts.app')

@section('content')
<section class="coupon-request-section py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-primary text-white text-center py-4" style="background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%) !important;">
                        <h3 class="mb-0">Request a Coupon</h3>
                        <p class="mb-0 opacity-75">Get exclusive discounts on your next therapy session</p>
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
                                <label for="user_name" class="form-label fw-bold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 bg-light @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="Enter your full name" value="{{ old('user_name') }}" required>
                                </div>
                                @error('user_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="user_email" class="form-label fw-bold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 bg-light @error('user_email') is-invalid @enderror" id="user_email" name="user_email" placeholder="Enter your email" value="{{ old('user_email') }}" required>
                                </div>
                                @error('user_email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm" style="border-radius: 10px; background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%); border: none;">
                                    Generate My Coupon <i class="fas fa-magic ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
