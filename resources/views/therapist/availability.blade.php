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
                            
                            <input type="radio" class="btn-check" name="availability_type" id="type_weekly" value="weekly" {{ ($therapist->availability_type ?? 'date') == 'weekly' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="type_weekly">Weekly Schedule</label>
                        </div>
                    </div>

                    <!-- Date-wise Section -->
                    <div id="date_availability_section" class="table-responsive" style="{{ ($therapist->availability_type ?? 'date') == 'weekly' ? 'display:none;' : '' }}">
                        <table class="table table-hover align-middle border-top">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 200px;">Date</th>
                                    <th>Time Slots (Comma Separated)</th>
                                    <th style="width: 150px;">Status</th>
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
                                        $existingTimes = isset($availability[$dateStr]) ? implode(', ', $availability[$dateStr]) : '';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $date->format('D, d M') }}</div>
                                            <small class="text-muted">{{ $date->format('Y') }}</small>
                                        </td>
                                        <td>
                                            <input type="text" name="availability[{{ $dateStr }}]" class="form-control"
                                                placeholder="e.g. 10:00 AM, 12:00 PM, 04:00 PM" value="{{ $existingTimes }}">
                                        </td>
                                        <td>
                                            @if($date->isToday())
                                                <span class="badge bg-success">Today</span>
                                            @elseif($date->isWeekend())
                                                <span class="badge bg-light text-dark">Weekend</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Weekly Section -->
                    <div id="weekly_availability_section" class="table-responsive" style="{{ ($therapist->availability_type ?? 'date') == 'date' ? 'display:none;' : '' }}">
                        <table class="table table-hover align-middle border-top">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 200px;">Day of Week</th>
                                    <th>Time Slots (Comma Separated)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    $weeklyAvailability = $therapist->weekly_availability ?? [];
                                @endphp
                                @foreach($days as $day)
                                    @php
                                        $existingWeeklyTimes = isset($weeklyAvailability[$day]) ? implode(', ', $weeklyAvailability[$day]) : '';
                                    @endphp
                                    <tr>
                                        <td class="fw-bold">{{ $day }}</td>
                                        <td>
                                            <input type="text" name="weekly_availability[{{ $day }}]" class="form-control"
                                                placeholder="e.g. 06:00 PM, 07:00 PM" value="{{ $existingWeeklyTimes }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">
                            <i class="bi bi-calendar-check me-2"></i> Save Availability
                        </button>
                    </div>
                </form>

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
            </div>
        </div>
    </div>
@endsection