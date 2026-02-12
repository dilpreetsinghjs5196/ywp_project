@extends('admin.layouts.app')

@section('title', 'Appointment Details')
@section('page_title', 'View Appointment Request')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Request from {{ $appointment->name }}</h5>
                    <span class="text-muted small">ID: #{{ $appointment->id }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Subject</label>
                            <h5 class="fw-bold">{{ $appointment->subject }}</h5>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Submitted On</label>
                            <div>{{ $appointment->created_at->format('M d, Y') }} at
                                {{ $appointment->created_at->format('h:i A') }}</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 bg-light rounded">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Contact Information</label>
                                <div class="mb-2">
                                    <i class="bi bi-envelope text-primary me-2"></i>
                                    <a href="mailto:{{ $appointment->email }}"
                                        class="text-decoration-none">{{ $appointment->email }}</a>
                                </div>
                                <div>
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <a href="tel:{{ $appointment->phone }}"
                                        class="text-decoration-none">{{ $appointment->phone }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Requested Schedule</label>
                                <div class="mb-2">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                    <strong>{{ \Carbon\Carbon::parse($appointment->date)->format('l, M d, Y') }}</strong>
                                </div>
                                <div>
                                    <i class="bi bi-clock text-primary me-2"></i>
                                    <strong>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Message / Inquiry</label>
                        <div class="p-4 border rounded bg-white" style="white-space: pre-wrap;">
                            {{ $appointment->message ?: 'No message provided.' }}</div>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="contacted" {{ $appointment->status == 'contacted' ? 'selected' : '' }}>
                                    Contacted</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            <p class="text-muted small mt-2">Use this to keep track of your team's progress with this
                                inquiry.</p>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4 border-danger-subtle">
                <div class="card-body">
                    <h6 class="fw-bold text-danger">Danger Zone</h6>
                    <p class="text-muted small">Deleting this record will permanentally remove it from the system.</p>
                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to permanentally delete this record?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">Delete Permanently</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection