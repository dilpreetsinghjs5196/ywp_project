@extends('layouts.therapist')

@section('title', 'Dashboard')
@section('page_title', 'Welcome, ' . $therapist->name)

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm bg-primary text-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Earnings</h6>
                        <h3 class="fw-bold mb-0">₹{{ number_format($totalEarnings, 2) }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-3">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                </div>
                <p class="mt-3 mb-0 small text-white-50">Completed session revenue</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Clients</h6>
                        <h3 class="fw-bold mb-0">{{ $totalClients }}</h3>
                    </div>
                    <div class="bg-light rounded p-3 text-primary">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                </div>
                <p class="mt-3 mb-0 small text-muted">All-time bookings count</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Current Fee</h6>
                        <h3 class="fw-bold mb-0">₹{{ number_format($therapist->fees, 2) }}</h3>
                    </div>
                    <div class="bg-light rounded p-3 text-success">
                        <i class="bi bi-tag fs-3"></i>
                    </div>
                </div>
                <a href="{{ route('therapist.profile') }}"
                    class="mt-3 mb-0 small text-primary text-decoration-none d-block">Modify rates <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Patient Reviews</h6>
                        <h3 class="fw-bold mb-0">{{ $approvedReviewsCount }}</h3>
                    </div>
                    <div class="bg-light rounded p-3 text-warning">
                        <i class="bi bi-star-fill fs-3"></i>
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center gap-2">
                    <div class="text-warning small">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= round($averageRating) ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <a href="{{ route('therapist.reviews') }}" class="small text-primary text-decoration-none">View
                        Feedback</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-4 border-0 shadow-sm">
                <h5 class="fw-bold mb-4">Recent Bookings</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Client</th>
                                <th>Date & Time</th>
                                <th>Mode</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $booking->name }}</div>
                                        <small class="text-muted">{{ $booking->email }}</small>
                                    </td>
                                    <td>
                                        <div class="small fw-bold">
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, d M Y') }}
                                        </div>
                                        <div class="text-muted small">{{ $booking->booking_time }}</div>
                                    </td>
                                    <td>
                                        @if($booking->payment_status === 'paid')
                                            <span class="badge rounded-pill bg-success-subtle text-success border">Paid</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning-subtle text-warning border">Pending</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">₹{{ number_format($booking->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                        No recent confirmed bookings found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="{{ route('therapist.bookings') }}" class="btn btn-sm btn-outline-primary">View All Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 border-0 shadow-sm">
                <h5 class="fw-bold mb-4">Availability Status</h5>
                <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                    <div class="form-check form-switch fs-5">
                        <input class="form-check-input" type="checkbox" role="switch" id="activeStatus" {{ $therapist->is_active ? 'checked' : '' }} disabled>
                    </div>
                    <div class="ms-2">
                        <div class="fw-bold small">Visibility on Site</div>
                        <div class="text-muted small">You are currently {{ $therapist->is_active ? 'visible' : 'hidden' }}
                        </div>
                    </div>
                </div>
                <div class="alert alert-info small border-0 py-2">
                    <i class="bi bi-info-circle-fill me-1"></i> Contact Admin to toggle your professional visibility.
                </div>

                <h5 class="fw-bold mt-4 mb-3">Profile Snapshot</h5>
                <div class="text-center">
                    <img src="{{ Str::startsWith($therapist->image, 'image/') ? asset($therapist->image) : asset('storage/' . $therapist->image) }}"
                        class="rounded-circle mb-3 border p-1" style="width: 100px; height: 100px; object-fit: cover;">
                    <h6 class="fw-bold mb-0">{{ $therapist->name }}</h6>
                    <p class="text-muted small mb-1">{{ $therapist->designation }}</p>
                    <div class="text-warning small">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= round($averageRating) ? '-fill' : '' }}"></i>
                        @endfor
                        <span class="text-muted ms-1">({{ number_format($averageRating, 1) }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection