@extends('admin.layouts.app')

@section('title', 'Admin Profile')
@section('page_title', 'My Account Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Account Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-shield-lock me-2"></i> Change Password</h6>
                        <p class="small text-muted mb-4">Leave password fields blank if you don't want to change it.</p>

                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold small">Current Password</label>
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Enter current password to verify identity">
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">New Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="New password (min 8 characters)">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repeat new password">
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2">Save Profile Updates</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4 border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-info-circle fs-4"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Important Note</h6>
                            <p class="text-muted small mb-0">Changes to your email address will update your login
                                credentials. Ensure you have access to the new email address before saving.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection