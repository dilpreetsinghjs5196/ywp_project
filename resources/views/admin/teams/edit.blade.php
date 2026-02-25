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
                                <input type="text" name="languages"
                                    class="form-control @error('languages') is-invalid @enderror"
                                    value="{{ old('languages', $team->languages) }}" placeholder="e.g. English, Hindi">
                                @error('languages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialization</label>
                                <textarea name="specialization"
                                    class="form-control @error('specialization') is-invalid @enderror" rows="3"
                                    placeholder="e.g. Anxiety, Depression">{{ old('specialization', $team->specialization) }}</textarea>
                                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Specialties</label>
                                <textarea name="specialties" class="form-control @error('specialties') is-invalid @enderror"
                                    rows="3"
                                    placeholder="e.g. Anxiety & Overthinking">{{ old('specialties', $team->specialties) }}</textarea>
                                @error('specialties')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Qualifications</label>
                                <textarea name="qualifications"
                                    class="form-control @error('qualifications') is-invalid @enderror" rows="3"
                                    placeholder="e.g. M.A. Clinical Psychology">{{ old('qualifications', $team->qualifications) }}</textarea>
                                @error('qualifications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Session Type</label>
                                    <input type="text" name="session_type"
                                        class="form-control @error('session_type') is-invalid @enderror"
                                        value="{{ old('session_type', $team->session_type) }}"
                                        placeholder="e.g. Online Video Call">
                                    @error('session_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold">Office Address (for In-Person)</label>
                                    <textarea name="office_address"
                                        class="form-control @error('office_address') is-invalid @enderror" rows="2"
                                        placeholder="Full address for in-person meetings">{{ old('office_address', $team->office_address) }}</textarea>
                                    @error('office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold d-block mb-3 border-bottom pb-2 text-primary">Assigned
                                    Services & Specific Pricing</label>
                                <p class="small text-muted mb-3">Select services this therapist provides and set their
                                    specific fees for each. If left blank, default fees will be used.</p>

                                <div class="row g-3">
                                    @foreach($services as $service)
                                        @php
                                            $assignment = $assignedServices[$service->id] ?? null;
                                            $isAssigned = !is_null($assignment);
                                            $customFee = $isAssigned ? $assignment['fees'] : '';
                                            $customDuration = $isAssigned ? $assignment['duration'] : '';
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="card h-100 border shadow-none bg-light-subtle">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input service-checkbox" type="checkbox"
                                                                name="services[]" value="{{ $service->id }}"
                                                                id="service_{{ $service->id }}" {{ $isAssigned ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bold"
                                                                for="service_{{ $service->id }}">
                                                                {{ $service->title }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="input-group input-group-sm mb-2 {{ $isAssigned ? '' : 'd-none' }} service-details-{{ $service->id }}">
                                                        <span class="input-group-text">Fees (₹)</span>
                                                        <input type="number" name="service_fees[{{ $service->id }}]"
                                                            class="form-control" placeholder="Default: {{ $service->fees }}"
                                                            value="{{ old('service_fees.' . $service->id, $customFee) }}">
                                                    </div>
                                                    <div
                                                        class="input-group input-group-sm {{ $isAssigned ? '' : 'd-none' }} service-details-{{ $service->id }}">
                                                        <span class="input-group-text">Duration</span>
                                                        <input type="text" name="service_durations[{{ $service->id }}]"
                                                            class="form-control" placeholder="e.g. 50 mins"
                                                            value="{{ old('service_durations.' . $service->id, $customDuration) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                document.querySelectorAll('.service-checkbox').forEach(checkbox => {
                                    checkbox.addEventListener('change', function () {
                                        const details = document.querySelectorAll('.service-details-' + this.value);
                                        details.forEach(el => {
                                            if (this.checked) {
                                                el.classList.remove('d-none');
                                            } else {
                                                el.classList.add('d-none');
                                            }
                                        });
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
                                <p class="small text-muted mb-3">Update the therapist's portal login password here. Leave
                                    blank to keep the current password.</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">New Login Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repeat new password">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
                            <h6 class="fw-bold mb-0 text-primary"><i class="bi bi-calendar3 me-2"></i> Therapist Availability</h6>
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="radio" class="btn-check" name="availability_type" id="type_date" value="date" {{ $team->availability_type == 'date' ? 'checked' : '' }}>
                                <label class="btn label btn-outline-primary" for="type_date">Specific Dates</label>
                                
                                <input type="radio" class="btn-check" name="availability_type" id="type_weekly" value="weekly" {{ $team->availability_type == 'weekly' ? 'checked' : '' }}>
                                <label class="btn label btn-outline-primary" for="type_weekly">Weekly Schedule</label>
                            </div>
                        </div>
                        <p class="small text-muted mb-3">Set a <strong>General Schedule</strong> first. If a specific service (like Couple Therapy) has different timings, click its tab and enter them there. Services without specific timings will use the General slots.</p>

                            @php
                                $availability = $team->availability ?? [];
                                $weeklyAvailability = $team->weekly_availability ?? [];
                                $dateAddresses = $team->date_addresses ?? [];
                                $weeklyAddresses = $team->weekly_addresses ?? [];
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $nextFortnight = [];
                                for ($i = 0; $i < 14; $i++) {
                                    $nextFortnight[] = \Carbon\Carbon::today()->addDays($i);
                                }
                                $serviceList = $team->services;
                            @endphp

                            <ul class="nav nav-pills mb-4 gap-2" id="availabilityTabs" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active btn-sm" data-bs-toggle="tab" data-bs-target="#pane-default">General Schedule</button>
                                </li>
                                @foreach($serviceList as $service)
                                    <li class="nav-item">
                                        <button type="button" class="nav-link btn-sm" data-bs-toggle="tab" data-bs-target="#pane-{{ $service->id }}">{{ $service->title }}</button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content border rounded p-3 bg-white shadow-sm" id="availabilityTabsContent">
                                <!-- Service/Default Iteration Start -->
                                @foreach(['default' => (object)['id' => 'default', 'title' => 'General']] + $serviceList->keyBy('id')->all() as $sId => $sObj)
                                    @php 
                                        $sIdStr = ($sId === 'default') ? 'default' : $sId;
                                        $isDefault = ($sId === 'default');
                                        $sTitle = $isDefault ? 'General' : $sObj->title;
                                    @endphp
                                    <div class="tab-pane fade {{ $isDefault ? 'show active' : '' }}" id="pane-{{ $sIdStr }}">
                                        <h6 class="fw-bold mb-3">{{ $isDefault ? 'General Default Timings' : $sTitle . ' Specific Timings' }}</h6>

                                        <!-- Specific Dates Table -->
                                        <div class="date_availability_section table-responsive mb-4" style="{{ $team->availability_type == 'weekly' ? 'display:none;' : '' }}">
                                            <table class="table table-sm table-bordered align-middle">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="width: 150px;">Date</th>
                                                        <th>Online Slots</th>
                                                        <th>In-person Slots</th>
                                                        @if($isDefault) <th>Location Address (Global)</th> @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($nextFortnight as $date)
                                                        @php
                                                            $dateStr = $date->format('Y-m-d');
                                                            $existingAddress = $dateAddresses[$dateStr] ?? '';
                                                        @endphp
                                                        <tr>
                                                            <td class="bg-light text-center small fw-bold">{{ $date->format('D, d M') }}</td>
                                                            <td>
                                                                <input type="text" name="availability[{{ $sIdStr }}][{{ $dateStr }}][Online]" 
                                                                    class="form-control form-control-sm" placeholder="10 AM, 12 PM"
                                                                    value="{{ isset($availability[$sIdStr][$dateStr]['Online']) ? implode(', ', $availability[$sIdStr][$dateStr]['Online']) : '' }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="availability[{{ $sIdStr }}][{{ $dateStr }}][In-person]" 
                                                                    class="form-control form-control-sm" placeholder="2 PM, 4 PM"
                                                                    value="{{ isset($availability[$sIdStr][$dateStr]['In-person']) ? implode(', ', $availability[$sIdStr][$dateStr]['In-person']) : '' }}">
                                                            </td>
                                                            @if($isDefault)
                                                                <td>
                                                                    <input type="text" name="date_addresses[{{ $dateStr }}]" 
                                                                        class="form-control form-control-sm" placeholder="Office address"
                                                                        value="{{ $existingAddress }}">
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Weekly Schedule Table -->
                                        <div class="weekly_availability_section table-responsive mb-4" style="{{ $team->availability_type == 'date' || !$team->availability_type ? 'display:none;' : '' }}">
                                            <table class="table table-sm table-bordered align-middle">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th style="width: 150px;">Day of Week</th>
                                                        <th>Online Slots</th>
                                                        <th>In-person Slots</th>
                                                        @if($isDefault) <th>Location Address (Global)</th> @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($days as $day)
                                                        @php $existingWeeklyAddress = $weeklyAddresses[$day] ?? ''; @endphp
                                                        <tr>
                                                            <td class="bg-light text-center small fw-bold">{{ $day }}</td>
                                                            <td>
                                                                <input type="text" name="weekly_availability[{{ $sIdStr }}][{{ $day }}][Online]" 
                                                                    class="form-control form-control-sm" placeholder="e.g. 6 PM, 7 PM"
                                                                    value="{{ isset($weeklyAvailability[$sIdStr][$day]['Online']) ? implode(', ', $weeklyAvailability[$sIdStr][$day]['Online']) : '' }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="weekly_availability[{{ $sIdStr }}][{{ $day }}][In-person]" 
                                                                    class="form-control form-control-sm" placeholder="e.g. 11 AM, 12 PM"
                                                                    value="{{ isset($weeklyAvailability[$sIdStr][$day]['In-person']) ? implode(', ', $weeklyAvailability[$sIdStr][$day]['In-person']) : '' }}">
                                                            </td>
                                                            @if($isDefault)
                                                                <td>
                                                                    <input type="text" name="weekly_addresses[{{ $day }}]" 
                                                                        class="form-control form-control-sm" placeholder="Office address"
                                                                        value="{{ $existingWeeklyAddress }}">
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const typeDate = document.getElementById('type_date');
                                    const typeWeekly = document.getElementById('type_weekly');
                                    const dateSections = document.querySelectorAll('.date_availability_section');
                                    const weeklySections = document.querySelectorAll('.weekly_availability_section');

                                    typeDate.addEventListener('change', function() {
                                        if (this.checked) {
                                            dateSections.forEach(s => s.style.display = 'block');
                                            weeklySections.forEach(s => s.style.display = 'none');
                                        }
                                    });

                                    typeWeekly.addEventListener('change', function() {
                                        if (this.checked) {
                                            dateSections.forEach(s => s.style.display = 'none');
                                            weeklySections.forEach(s => s.style.display = 'block');
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