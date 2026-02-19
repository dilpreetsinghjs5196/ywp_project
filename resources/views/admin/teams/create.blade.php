@extends('admin.layouts.app')

@section('title', 'Add New Team Member')
@section('page_title', 'Add Team Member')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Member Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required placeholder="e.g. Dr. Sarah Johnson">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="e.g. sarah@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Designation</label>
                                <input type="text" name="designation"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    value="{{ old('designation') }}" required placeholder="e.g. Senior Psychologist">
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Session Fees (₹)</label>
                                <input type="number" name="fees" class="form-control @error('fees') is-invalid @enderror"
                                    value="{{ old('fees') }}" required placeholder="e.g. 1800">
                                @error('fees')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Bio / Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4" placeholder="Enter therapist bio">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mode</label>
                                <input type="text" name="mode" class="form-control @error('mode') is-invalid @enderror"
                                    value="{{ old('mode') }}" placeholder="e.g. Online, In-person">
                                @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Languages</label>
                                <input type="text" name="languages"
                                    class="form-control @error('languages') is-invalid @enderror"
                                    value="{{ old('languages') }}" placeholder="e.g. English, Hindi">
                                @error('languages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialization</label>
                                <textarea name="specialization"
                                    class="form-control @error('specialization') is-invalid @enderror" rows="3"
                                    placeholder="e.g. Anxiety, Depression">{{ old('specialization') }}</textarea>
                                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialties</label>
                                <textarea name="specialties" class="form-control @error('specialties') is-invalid @enderror"
                                    rows="3" placeholder="e.g. Anxiety & Overthinking">{{ old('specialties') }}</textarea>
                                @error('specialties')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Qualifications</label>
                                <textarea name="qualifications"
                                    class="form-control @error('qualifications') is-invalid @enderror" rows="3"
                                    placeholder="e.g. M.A. Clinical Psychology">{{ old('qualifications') }}</textarea>
                                @error('qualifications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Session Type</label>
                                <input type="text" name="session_type"
                                    class="form-control @error('session_type') is-invalid @enderror"
                                    value="{{ old('session_type') }}" placeholder="e.g. Online Video Call">
                                @error('session_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold d-block mb-3 border-bottom pb-2 text-primary">Assigned Services & Specific Pricing</label>
                                <p class="small text-muted mb-3">Select services this therapist provides and set their specific fees for each. If left blank, default fees will be used.</p>
                                
                                <div class="row g-3">
                                    @foreach($services as $service)
                                        <div class="col-md-6">
                                            <div class="card h-100 border shadow-none bg-light-subtle">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" 
                                                                {{ is_array(old('services')) && in_array($service->id, old('services')) ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bold" for="service_{{ $service->id }}">
                                                                {{ $service->title }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="input-group input-group-sm {{ is_array(old('services')) && in_array($service->id, old('services')) ? '' : 'd-none' }}" id="fee_container_{{ $service->id }}">
                                                        <span class="input-group-text">Fees (₹)</span>
                                                        <input type="number" name="service_fees[{{ $service->id }}]" class="form-control" placeholder="Specific fee for this service" value="{{ old('service_fees.' . $service->id) }}">
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
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Profile Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                <div class="form-text">Recommended: Square image (600x600px).</div>
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold mb-0 text-primary"><i class="bi bi-calendar3 me-2"></i> Therapist
                                Availability</h6>
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="radio" class="btn-check" name="availability_type" id="type_date" value="date"
                                    checked>
                                <label class="btn label btn-outline-primary" for="type_date">Specific Dates</label>

                                <input type="radio" class="btn-check" name="availability_type" id="type_weekly"
                                    value="weekly">
                                <label class="btn label btn-outline-primary" for="type_weekly">Weekly Schedule</label>
                            </div>
                        </div>
                        <p class="small text-muted mb-3">Enter time slots separated by commas (e.g., 06:00 PM, 07:00 PM,
                            08:00 PM).</p>

                        <!-- Specific Dates Table -->
                        <div id="date_availability_section" class="table-responsive mb-4">
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
                                    @endphp

                                    @foreach($nextFortnight as $date)
                                        @php
                                            $dateStr = $date->format('Y-m-d');
                                        @endphp
                                        <tr>
                                            <td class="bg-light">
                                                <div class="fw-bold small">{{ $date->format('D, d M Y') }}</div>
                                            </td>
                                            <td>
                                                <input type="text" name="availability[{{ $dateStr }}]"
                                                    class="form-control form-control-sm" placeholder="e.g. 10:00 AM, 12:00 PM"
                                                    value="{{ old('availability.' . $dateStr) }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Weekly Schedule Table -->
                        <div id="weekly_availability_section" class="table-responsive mb-4" style="display:none;">
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
                                    @endphp
                                    @foreach($days as $day)
                                        <tr>
                                            <td class="bg-light">
                                                <div class="fw-bold small">{{ $day }}</div>
                                            </td>
                                            <td>
                                                <input type="text" name="weekly_availability[{{ $day }}]"
                                                    class="form-control form-control-sm" placeholder="e.g. 06:00 PM, 07:00 PM"
                                                    value="{{ old('weekly_availability.' . $day) }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const typeDate = document.getElementById('type_date');
                                const typeWeekly = document.getElementById('type_weekly');
                                const dateSection = document.getElementById('date_availability_section');
                                const weeklySection = document.getElementById('weekly_availability_section');

                                typeDate.addEventListener('change', function () {
                                    if (this.checked) {
                                        dateSection.style.display = 'block';
                                        weeklySection.style.display = 'none';
                                    }
                                });

                                typeWeekly.addEventListener('change', function () {
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
                                <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}"
                                    placeholder="https://facebook.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}"
                                    placeholder="https://twitter.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="instagram" class="form-control" value="{{ old('instagram') }}"
                                    placeholder="https://instagram.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}"
                                    placeholder="https://linkedin.com/in/...">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.teams.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Save Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection