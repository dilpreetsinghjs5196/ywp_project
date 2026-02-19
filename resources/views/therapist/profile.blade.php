@extends('layouts.therapist')

@section('title', 'Manage Profile')
@section('page_title', 'My Professional Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm border-0">
                <form action="{{ route('therapist.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Str::startsWith($therapist->image, 'image/') ? asset($therapist->image) : asset('storage/' . $therapist->image) }}"
                                    class="rounded-circle border p-1 mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;" id="profilePreview">
                                <label for="imageUpload"
                                    class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0 mb-3 me-2 shadow">
                                    <i class="bi bi-camera"></i>
                                </label>
                                <input type="file" name="image" id="imageUpload" class="d-none" accept="image/*"
                                    onchange="previewImage(this)">
                            </div>
                            <h5 class="fw-bold mb-0">{{ $therapist->name }}</h5>
                            <p class="text-muted small">{{ $therapist->designation }}</p>
                        </div>

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

                        <div class="col-12 mt-4 pt-3 border-top">
                            <h6 class="fw-bold mb-3"><i class="bi bi-gear-fill me-2"></i> Assigned Services & Professional Fees</h6>
                            <p class="small text-muted mb-3">Select the services you offer and specify your professional fees for each. Leaving the fee blank will use your default base fee.</p>
                            
                            <div class="row g-3">
                                @foreach($services as $service)
                                    @php
                                        $isAssigned = isset($assignedServices[$service->id]);
                                        $customFee = $isAssigned ? $assignedServices[$service->id] : '';
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="card h-100 border shadow-none bg-light-subtle">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" 
                                                            {{ $isAssigned ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="service_{{ $service->id }}">
                                                            {{ $service->title }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-sm {{ $isAssigned ? '' : 'd-none' }}" id="fee_container_{{ $service->id }}">
                                                    <span class="input-group-text">Fees (₹)</span>
                                                    <input type="number" name="service_fees[{{ $service->id }}]" class="form-control" placeholder="Fee for this service" value="{{ old('service_fees.' . $service->id, $customFee) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.service-checkbox').forEach(checkbox => {
                                    checkbox.addEventListener('change', function() {
                                        const feeContainer = document.getElementById('fee_container_' + this.value);
                                        if (this.checked) {
                                            feeContainer.classList.remove('d-none');
                                        } else {
                                            feeContainer.classList.add('d-none');
                                        }
                                    });
                                });
                            });
                        </script>

                        <div class="col-12 mt-4 pt-3 border-top">
                            <h6 class="fw-bold mb-3"><i class="bi bi-share me-2"></i> Social Media Profiles (Optional)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small">Facebook URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-primary"><i
                                                class="bi bi-facebook"></i></span>
                                        <input type="url" name="facebook" class="form-control"
                                            value="{{ old('facebook', $therapist->facebook) }}"
                                            placeholder="https://facebook.com/your-profile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">Twitter URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-info"><i
                                                class="bi bi-twitter"></i></span>
                                        <input type="url" name="twitter" class="form-control"
                                            value="{{ old('twitter', $therapist->twitter) }}"
                                            placeholder="https://twitter.com/your-handle">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">Instagram URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-danger"><i
                                                class="bi bi-instagram"></i></span>
                                        <input type="url" name="instagram" class="form-control"
                                            value="{{ old('instagram', $therapist->instagram) }}"
                                            placeholder="https://instagram.com/your-username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">LinkedIn URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-primary"><i
                                                class="bi bi-linkedin"></i></span>
                                        <input type="url" name="linkedin" class="form-control"
                                            value="{{ old('linkedin', $therapist->linkedin) }}"
                                            placeholder="https://linkedin.com/in/your-profile">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2">Update My Profile</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card p-4 mt-4 shadow-sm border-0">
                <h6 class="fw-bold mb-4"><i class="bi bi-key me-2"></i> Change Password</h6>
                <form action="{{ route('therapist.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Current Password</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-outline-primary px-4">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card p-4 mt-4 shadow-sm border-0 bg-light">
                <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock me-2"></i> Account Security</h6>
                <p class="small text-muted mb-0">Ensure your account remains secure by using a strong password. You can update your credentials using the form above.</p>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function  (e) {                 document.getElementById('profilePreview').src = e.target.result;             }             reader.readAsDataURL(input.files[0]);         }     }
    </script>
@endpush