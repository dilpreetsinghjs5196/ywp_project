@extends('admin.layouts.app')

@section('title', 'Therapist Bookings')
@section('page_title', 'Therapist Session Bookings')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">All Session Bookings</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Booking ID</th>
                            <th>Patient</th>
                            <th>Therapist</th>
                            <th>Schedule</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $booking->id }}</td>
                                <td>
                                    <div class="fw-bold">{{ $booking->name }}</div>
                                    <div class="small text-muted">{{ $booking->email }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary-color">{{ $booking->therapist->name }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                    <div class="badge bg-secondary-subtle text-secondary px-2">{{ $booking->booking_time }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">₹{{ number_format($booking->amount, 2) }}</div>
                                </td>
                                <td>
                                    @if($booking->payment_status == 'paid')
                                        <span class="badge bg-success-subtle text-success px-3">PAID</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning px-3">PENDING</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.therapist-bookings.show', $booking->id) }}"
                                            class="btn btn-sm btn-light border">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.therapist-bookings.destroy', $booking->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">No bookings found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($bookings->hasPages())
        <div class="card-footer bg-white">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
@endsection
