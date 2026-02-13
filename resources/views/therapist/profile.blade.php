@extends('layouts.therapist')

@section('title', 'Manage Profile')
@section('page_title', 'My Professional Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm border-0">
                <form action="{{ route('therapist.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $therapist->name) }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Professional Email</label>
                            <input type="email" class="form-control bg-light" value="{{ $therapist->email }}" readonly>
                            <small class="text-muted">Email cannot be changed (locked to account)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Designation</label>
                            <input type="text" name="designation" class="form-control"
                                value="{{ old('designation', $therapist->designation) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Session Fees (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="fees" class="form-control"
                                    value="{{ old('fees', $therapist->fees) }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Professional Biography / Expertise</label>
                            <textarea name="description" class="form-control"
                                rows="6">{{ old('description', $therapist->description) }}</textarea>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2">Update My Profile</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card p-4 mt-4 shadow-sm border-0 bg-light">
                <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock me-2"></i> Security Settings</h6>
                <p class="small text-muted mb-0">To change your login password, please visit your <a
                        href="{{ route('com.profile') }}">Main Site Account Settings</a>.</p>
            </div>
        </div>
    </div>
@endsection