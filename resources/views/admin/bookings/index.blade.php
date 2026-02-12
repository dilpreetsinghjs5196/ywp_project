@extends('admin.layouts.app')

@section('title', 'Appointment Queries')
@section('page_title', 'General Appointment Queries')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">All Queries</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $booking->created_at->format('M d, Y') }}</div>
                                    <div class="small text-muted">{{ $booking->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $booking->name }}</div>
                                </td>
                                <td>
                                    <div>{{ $booking->email }}</div>
                                    <div class="small text-muted">{{ $booking->phone }}</div>
                                </td>
                                <td>{{ Str::limit($booking->subject, 30) }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'confirmed' ? 'success' : 'danger') }}-subtle text-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'confirmed' ? 'success' : 'danger') }} px-3">
                                        {{ strtoupper($booking->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                            class="btn btn-sm btn-light border">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this query?')">
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
                                <td colspan="6" class="text-center py-5">No queries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection