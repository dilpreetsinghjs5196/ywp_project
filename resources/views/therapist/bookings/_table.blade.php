<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Booking ID</th>
                <th>Client Details</th>
                <th>Session Date & Time</th>
                <th>Mode</th>
                <th>Status</th>
                <th>Amount</th>
                <th class="pe-4 text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td class="ps-4">#{{ $booking->id }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $booking->name }}</div>
                        <div class="small text-muted">{{ $booking->email }}</div>
                        <div class="small text-muted">{{ $booking->phone }}</div>
                    </td>
                    <td>
                        <div class="small fw-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('D, d M Y') }}</div>
                        <div class="small text-muted">{{ $booking->booking_time }}</div>
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-light text-dark border px-3">{{ ucfirst($booking->mode) }}</span>
                    </td>
                    <td>
                        @if($booking->payment_status === 'paid')
                            <span class="badge rounded-pill bg-success-subtle text-success border px-3">Confirmed (Paid)</span>
                        @else
                            <span class="badge rounded-pill bg-warning-subtle text-warning border px-3">Pending Payment</span>
                        @endif
                    </td>
                    <td class="fw-bold text-dark">₹{{ number_format($booking->amount, 2) }}</td>
                    <td class="pe-4 text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#msg-{{ $booking->id }}">
                            View Message
                        </button>
                    </td>
                </tr>
                <tr class="collapse" id="msg-{{ $booking->id }}">
                    <td colspan="7" class="bg-light ps-4 py-3">
                        <div class="text-muted small fw-bold mb-1">Message from client:</div>
                        <div class="small">{{ $booking->message ?: 'No message provided.' }}</div>
                        @if($booking->payment_status === 'paid')
                            <div class="mt-2 pt-2 border-top">
                                <div class="text-muted small fw-bold mb-1">Razorpay Details:</div>
                                <div class="small text-dark font-monospace">Payment ID: {{ $booking->razorpay_payment_id }}</div>
                                <div class="small text-dark font-monospace">Order ID: {{ $booking->razorpay_order_id }}</div>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                        No bookings found matching your criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($bookings->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $bookings->links() }}
    </div>
@endif
