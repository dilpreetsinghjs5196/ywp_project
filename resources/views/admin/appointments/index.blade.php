@extends('admin.layouts.app')

@section('title', 'Manage Appointments')
@section('page_title', 'Appointment Queries')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">All Appointment Requests</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Date Submited</th>
                            <th>Name</th>
                            <th>Email/Phone</th>
                            <th>Appointment Date</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="small fw-semibold">{{ $appointment->created_at->format('M d, Y') }}</div>
                                                    <div class="small text-muted">{{ $appointment->created_at->format('h:i A') }}</div>
                                                </td>
                                                <td>
                                                    <div class="fw-bold">{{ $appointment->name }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $appointment->email }}</div>
                                                    <div class="small text-muted">{{ $appointment->phone }}</div>
                                                </td>
                                                <td>
                                                    <div class="badge bg-primary-subtle text-primary px-2">
                                                        {{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }} at
                                                        {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                                    </div>
                                                </td>
                                                <td>{{ Str::limit($appointment->subject, 30) }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = match ($appointment->status) {
                                                            'pending' => 'bg-warning-subtle text-warning',
                                                            'contacted' => 'bg-info-subtle text-info',
                                                            'completed' => 'bg-success-subtle text-success',
                                                            'cancelled' => 'bg-danger-subtle text-danger',
                                                            default => 'bg-secondary-subtle text-secondary'
                                                        };
                                                    @endphp
                              <span
                                                        class="badge {{ $statusClass }} px-3 text-capitalize">{{ $appointment->status }}</span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                                            class="btn btn-sm btn-light border" title="View Details">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-light border text-danger"
                                                                title="Delete">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">No appointment requests found yet.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($appointments->hasPages())
            <div class="card-footer bg-white">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection