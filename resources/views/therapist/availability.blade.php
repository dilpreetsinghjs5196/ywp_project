@extends('layouts.therapist')

@section('title', 'Manage Availability')
@section('page_title', 'My Availability Calendar')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card p-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Set Working Hours</h5>
                    <span class="badge bg-info p-2">Showing next 14 days</span>
                </div>

                <div class="alert alert-warning border-0 small mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Enter multiple time slots separated by commas (e.g., <strong>10:00 AM, 11:30 AM, 02:00 PM</strong>).
                    Leave empty for days you are not available.
                </div>

                <form action="{{ route('therapist.availability.update') }}" method="POST">
                    @csrf

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="fw-bold mb-0">Availability Mode:</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <input type="radio" class="btn-check" name="availability_type" id="type_date" value="date" {{ ($therapist->availability_type ?? 'date') == 'date' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="type_date">Specific Dates</label>

                            <input type="radio" class="btn-check" name="availability_type" id="type_weekly" value="weekly"
                                {{ ($therapist->availability_type ?? 'date') == 'weekly' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="type_weekly">Weekly Schedule</label>
                        </div>
                    </div>

                    @php
                        $availability = $therapist->availability ?? [];
                        $weeklyAvailability = $therapist->weekly_availability ?? [];
                        $dateAddresses = $therapist->date_addresses ?? [];
                        $weeklyAddresses = $therapist->weekly_addresses ?? [];
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $nextFortnight = [];
                        for ($i = 0; $i < 14; $i++) {
                            $nextFortnight[] = \Carbon\Carbon::today()->addDays($i);
                        }
                        $serviceList = $therapist->services;
                    @endphp

                    <ul class="nav nav-pills mb-4 gap-2 border-bottom pb-3" id="availabilityTabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active btn-sm" data-bs-toggle="tab" data-bs-target="#pane-default">General Schedule</button>
                        </li>
                        @foreach($serviceList as $service)
                        <li class="nav-item">
                            <button type="button" class="nav-link btn-sm" data-bs-toggle="tab" data-bs-target="#pane-{{ $service->id }}">{{ $service->title }}</button>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content border-0" id="availabilityTabsContent">
                        @foreach(['default' => (object)['id' => 'default', 'title' => 'General']] + $serviceList->keyBy('id')->all() as $sId => $sObj)
                            @php 
                                $sIdStr = ($sId === 'default') ? 'default' : $sId;
                                $isDefault = ($sId === 'default');
                                $sTitle = $isDefault ? 'General' : $sObj->title;
                            @endphp
                            <div class="tab-pane fade {{ $isDefault ? 'show active' : '' }}" id="pane-{{ $sIdStr }}">
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-info-circle me-1"></i>
                                    {{ $isDefault ? 'Set your default timings here. Other services will use these unless you override them.' : 'Set custom timings specifically for ' . $sTitle . '.' }}
                                </p>

                                <!-- Date-wise Section -->
                                <div class="date_availability_section table-responsive" style="{{ ($therapist->availability_type ?? 'date') == 'weekly' ? 'display:none;' : '' }}">
                                    <table class="table table-sm table-hover align-middle border-top">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 150px;">Date</th>
                                                <th>Online Slots</th>
                                                <th>In-person Slots</th>
                                                @if($isDefault) <th>Location Address (Global)</th> @endif
                                                <th style="width: 100px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($nextFortnight as $date)
                                                @php
                                                    $dateStr = $date->format('Y-m-d');
                                                    $existingAddress = $dateAddresses[$dateStr] ?? '';
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="fw-bold small">{{ $date->format('D, d M') }}</div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="availability[{{ $sIdStr }}][{{ $dateStr }}][Online]" class="form-control form-control-sm"
                                                            placeholder="10 AM, 12 PM" 
                                                            value="{{ isset($availability[$sIdStr][$dateStr]['Online']) ? implode(', ', $availability[$sIdStr][$dateStr]['Online']) : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="availability[{{ $sIdStr }}][{{ $dateStr }}][In-person]" class="form-control form-control-sm"
                                                            placeholder="2 PM, 4 PM" 
                                                            value="{{ isset($availability[$sIdStr][$dateStr]['In-person']) ? implode(', ', $availability[$sIdStr][$dateStr]['In-person']) : '' }}">
                                                    </td>
                                                    @if($isDefault)
                                                    <td>
                                                        <input type="text" name="date_addresses[{{ $dateStr }}]" class="form-control form-control-sm"
                                                            placeholder="Office address" value="{{ $existingAddress }}">
                                                    </td>
                                                    @endif
                                                    <td>
                                                        @if($date->isToday())
                                                            <span class="badge bg-success small">Today</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Weekly Section -->
                                <div class="weekly_availability_section table-responsive" style="{{ ($therapist->availability_type ?? 'date') == 'date' ? 'display:none;' : '' }}">
                                    <table class="table table-sm table-hover align-middle border-top">
                                        <thead class="table-light">
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
                                                    <td class="fw-bold small">{{ $day }}</td>
                                                    <td>
                                                        <input type="text" name="weekly_availability[{{ $sIdStr }}][{{ $day }}][Online]" class="form-control form-control-sm"
                                                            placeholder="e.g. 6 PM, 7 PM" 
                                                            value="{{ isset($weeklyAvailability[$sIdStr][$day]['Online']) ? implode(', ', $weeklyAvailability[$sIdStr][$day]['Online']) : '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="weekly_availability[{{ $sIdStr }}][{{ $day }}][In-person]" class="form-control form-control-sm"
                                                            placeholder="e.g. 11 AM, 12 PM" 
                                                            value="{{ isset($weeklyAvailability[$sIdStr][$day]['In-person']) ? implode(', ', $weeklyAvailability[$sIdStr][$day]['In-person']) : '' }}">
                                                    </td>
                                                    @if($isDefault)
                                                    <td>
                                                        <input type="text" name="weekly_addresses[{{ $day }}]" class="form-control form-control-sm"
                                                            placeholder="Office address"
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

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">
                            <i class="bi bi-calendar-check me-2"></i> Save Availability
                        </button>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const typeDate = document.getElementById('type_date');
                        const typeWeekly = document.getElementById('type_weekly');
                        const dateSections = document.querySelectorAll('.date_availability_section');
                        const weeklySections = document.querySelectorAll('.weekly_availability_section');

                        typeDate.addEventListener('change', function () {
                            if (this.checked) {
                                dateSections.forEach(s => s.style.display = 'block');
                                weeklySections.forEach(s => s.style.display = 'none');
                            }
                        });

                        typeWeekly.addEventListener('change', function () {
                            if (this.checked) {
                                dateSections.forEach(s => s.style.display = 'none');
                                weeklySections.forEach(s => s.style.display = 'block');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection