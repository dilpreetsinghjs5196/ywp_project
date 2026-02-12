@extends('admin.layouts.app')

@section('title', 'Query Details')
@section('page_title', 'View Appointment Query')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Query #{{ $booking->id }}</h5>
                    <span class="badge bg-primary px-3">{{ $booking->subject }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Patient Name</label>
                            <h4 class="fw-bold">{{ $booking->name }}</h4>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <label class="text-muted small text-uppercase fw-bold mb-1">Requested Time</label>
                            <h5 class="fw-bold">{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }} at
                                {{ $booking->time }}</h5>
                        </div>
                    </div>

                    <div class="p-4 bg-light rounded mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Email</label>
                                <div><i class="bi bi-envelope me-2"></i>{{ $booking->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Phone</label>
                                <div><i class="bi bi-telephone me-2"></i>{{ $booking->phone }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Message</label>
                        <div class="p-4 border rounded bg-white" style="white-space: pre-wrap;">
                            {{ $booking->message ?: 'No message provided.' }}</div>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white py-3 font-1 fw-bold">Update Status</div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select border-2">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                </option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection