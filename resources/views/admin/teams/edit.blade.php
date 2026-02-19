@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page_title', 'Edit Team Member')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Member: {{ $team->name }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $team->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $team->email) }}" placeholder="e.g. sarah@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Designation</label>
                                <input type="text" name="designation"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    value="{{ old('designation', $team->designation) }}" required>
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Session Fees (₹)</label>
                                <input type="number" name="fees" class="form-control @error('fees') is-invalid @enderror"
                                    value="{{ old('fees', $team->fees) }}" required placeholder="e.g. 1800">
                                @error('fees')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Bio / Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Enter therapist bio">{{ old('description', $team->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mode</label>
                                <input type="text" name="mode" class="form-control @error('mode') is-invalid @enderror"
                                    value="{{ old('mode', $team->mode) }}" placeholder="e.g. Online, In-person">
                                @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Languages</label>
                                <input type="text" name="languages" class="form-control @error('languages') is-invalid @enderror"
                                    value="{{ old('languages', $team->languages) }}" placeholder="e.g. English, Hindi">
                                @error('languages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialization</label>
                                <textarea name="specialization" class="form-control @error('specialization') is-invalid @enderror"
                                    rows="3" placeholder="e.g. Anxiety, Depression">{{ old('specialization', $team->specialization) }}</textarea>
                                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialties</label>
                                <textarea name="specialties" class="form-control @error('specialties') is-invalid @enderror"
                                    rows="3" placeholder="e.g. Anxiety & Overthinking">{{ old('specialties', $team->specialties) }}</textarea>
                                @error('specialties')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Qualifications</label>
                                <textarea name="qualifications" class="form-control @error('qualifications') is-invalid @enderror"
                                    rows="3" placeholder="e.g. M.A. Clinical Psychology">{{ old('qualifications', $team->qualifications) }}</textarea>
                                @error('qualifications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Session Type</label>
                                <input type="text" name="session_type" class="form-control @error('session_type') is-invalid @enderror"
                                    value="{{ old('session_type', $team->session_type) }}" placeholder="e.g. Online Video Call">
                                @error('session_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold d-block mb-3 border-bottom pb-2 text-primary">Assigned Services & Specific Pricing</label>
                                <p class="small text-muted mb-3">Select services this therapist provides and set their specific fees for each. If left blank, default fees will be used.</p>
                                
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
                                                        <input type="number" name="service_fees[{{ $service->id }}]" class="form-control" placeholder="Specific fee for this service" value="{{ old('service_fees.' . $service->id, $customFee) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <label class="form-label fw-bold d-block text-start">Current Image</label>
                                @if($team->image)
                                    <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                        alt="Current" class="rounded shadow-sm mb-2" style="max-height: 150px;">
                                @else
                                    <p class="text-muted small">No image uploaded.</p>
                                @endif
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', $team->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                <div class="mt-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $team->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 bg-light p-3 rounded">
                            <div class="col-12 mb-2">
                                <h6 class="fw-bold text-dark"><i class="bi bi-shield-lock me-1"></i> Login Security</h6>
                                <p class="small text-muted mb-3">Update the therapist's portal login password here. Leave blank to keep the current password.</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">New Login Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold mb-0 text-primary"><i class="bi bi-calendar3 me-2"></i> Therapist Availability</h6>
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="radio" class="btn-check" name="availability_type" id="type_date" value="date" {{ $team->availability_type == 'date' ? 'checked' : '' }}>
                                <label class="btn label btn-outline-primary" for="type_date">Specific Dates</label>
                                
                                <input type="radio" class="btn-check" name="availability_type" id="type_weekly" value="weekly" {{ $team->availability_type == 'weekly' ? 'checked' : '' }}>
                                <label class="btn label btn-outline-primary" for="type_weekly">Weekly Schedule</label>
                            </div>
                        </div>
                        <p class="small text-muted mb-3">Enter time slots separated by commas (e.g., 06:00 PM, 07:00 PM, 08:00 PM).</p>

                        <!-- Specific Dates Table -->
                        <div id="date_availability_section" class="table-responsive mb-4" style="{{ $team->availability_type == 'weekly' ? 'display:none;' : '' }}">
                            <table class="table table-sm table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 180px;">Date</th>
                                        <th>Available Time Slots</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nextFortnight = [];
                                        for ($i = 0; $i < 14; $i++) {
                                            $nextFortnight[] = \Carbon\Carbon::today()->addDays($i);
                                        }
                                        $availability = $team->availability ?? [];
                                    @endphp

                                    @foreach($nextFortnight as $date)
                                        @php
                                            $dateStr = $date->format('Y-m-d');
                                            $existingTimes = isset($availability[$dateStr]) ? implode(', ', $availability[$dateStr]) : '';
                                        @endphp
                                        <tr>
                                            <td class="bg-light">
                                                <div class="fw-bold small">{{ $date->format('D, d M Y') }}</div>
                                            </td>
                                            <td>
                                                <input type="text" name="availability[{{ $dateStr }}]" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="e.g. 10:00 AM, 12:00 PM"
                                                       value="{{ $existingTimes }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Weekly Schedule Table -->
                        <div id="weekly_availability_section" class="table-responsive mb-4" style="{{ $team->availability_type == 'date' || !$team->availability_type ? 'display:none;' : '' }}">
                            <table class="table table-sm table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 180px;">Day of Week</th>
                                        <th>Available Time Slots</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                        $weeklyAvailability = $team->weekly_availability ?? [];
                                    @endphp
                                    @foreach($days as $day)
                                        @php
                                            $existingWeeklyTimes = isset($weeklyAvailability[$day]) ? implode(', ', $weeklyAvailability[$day]) : '';
                                        @endphp
                                        <tr>
                                            <td class="bg-light">
                                                <div class="fw-bold small">{{ $day }}</div>
                                            </td>
                                            <td>
                                                <input type="text" name="weekly_availability[{{ $day }}]" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="e.g. 06:00 PM, 07:00 PM"
                                                       value="{{ $existingWeeklyTimes }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const typeDate = document.getElementById('type_date');
                                const typeWeekly = document.getElementById('type_weekly');
                                const dateSection = document.getElementById('date_availability_section');
                                const weeklySection = document.getElementById('weekly_availability_section');

                                typeDate.addEventListener('change', function() {
                                    if (this.checked) {
                                        dateSection.style.display = 'block';
                                        weeklySection.style.display = 'none';
                                    }
                                });

                                typeWeekly.addEventListener('change', function() {
                                    if (this.checked) {
                                        dateSection.style.display = 'none';
                                        weeklySection.style.display = 'block';
                                    }
                                });
                            });
                        </script>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-primary">Social Media Links (Optional)</h6>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" name="facebook" class="form-control"
                                    value="{{ old('facebook', $team->facebook) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" name="twitter" class="form-control"
                                    value="{{ old('twitter', $team->twitter) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="instagram" class="form-control"
                                    value="{{ old('instagram', $team->instagram) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" name="linkedin" class="form-control"
                                    value="{{ old('linkedin', $team->linkedin) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.teams.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Update Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection