@extends('admin.layouts.app')

@section('title', 'Booking Details')
@section('page_title', 'View Session Booking')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Booking #{{ $booking->id }}</h5>
                    <div class="badge bg-success px-3">Transaction: {{ $booking->razorpay_payment_id }}</div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Therapist</label>
                            <h4 class="fw-bold text-primary-color">{{ $booking->therapist->name }}</h4>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Amount Paid</label>
                            <h4 class="fw-bold">₹{{ number_format($booking->amount, 2) }}</h4>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Patient Details</label>
                                <div class="fw-bold mb-1">{{ $booking->name }}</div>
                                <div class="mb-1">
                                    <i class="bi bi-envelope text-primary me-2"></i>
                                    <a href="mailto:{{ $booking->email }}"
                                        class="text-decoration-none">{{ $booking->email }}</a>
                                </div>
                                <div>
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <a href="tel:{{ $booking->phone }}"
                                        class="text-decoration-none">{{ $booking->phone }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Session Schedule</label>
                                <div class="mb-2">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                    <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, M d, Y') }}</strong>
                                </div>
                                <div class="mb-2">
                                    <i class="bi bi-clock text-primary me-2"></i>
                                    <strong>{{ $booking->booking_time }}</strong>
                                </div>
                                <div>
                                    <i class="bi bi-broadcast text-primary me-2"></i>
                                    <strong>{{ $booking->mode }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Message from Patient</label>
                        <div class="p-4 border rounded bg-white" style="white-space: pre-wrap;">
                            {{ $booking->message ?: 'No additional message provided.' }}</div>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="{{ route('admin.therapist-bookings.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Payment Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Payment Status</label>
                        <span
                            class="badge bg-success-subtle text-success px-4 py-2 text-capitalize fs-6">{{ $booking->payment_status }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Razorpay Order ID</label>
                        <code class="text-dark">{{ $booking->razorpay_order_id }}</code>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Razorpay Payment ID</label>
                        <code class="text-dark">{{ $booking->razorpay_payment_id }}</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection