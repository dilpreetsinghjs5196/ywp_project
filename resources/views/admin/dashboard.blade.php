@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Admin Dashboard Overview')

@section('content')
    <style>
        .stat-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, #044A80 0%, #0669b6 100%);
        }

        .bg-gradient-gold {
            background: linear-gradient(135deg, #bd8e00 0%, #ffbf00 100%);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #157347 0%, #198754 100%);
        }

        .bg-gradient-purple {
            background: linear-gradient(135deg, #59359a 0%, #6f42c1 100%);
        }

        .dash-table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #64748b;
        }

        .dash-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }
    </style>

    <div class="row g-4">
        <!-- Stat Cards -->
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card stat-card bg-gradient-blue text-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-white bg-opacity-25 p-2 rounded-3 text-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div class="small opacity-75">TEAM</div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $stats['therapists'] }}</h2>
                    <p class="mb-0 small opacity-75">Listed Specialists</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card stat-card bg-gradient-gold text-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-white bg-opacity-25 p-2 rounded-3 text-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <div class="small opacity-75">SESSIONS</div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $stats['bookings'] }}</h2>
                    <p class="mb-0 small opacity-75">Paid Bookings</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card stat-card bg-gradient-green text-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-white bg-opacity-25 p-2 rounded-3 text-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-currency-rupee fs-4"></i>
                        </div>
                        <div class="small opacity-75">REVENUE</div>
                    </div>
                    <h2 class="fw-bold mb-1">₹{{ number_format($stats['revenue']) }}</h2>
                    <p class="mb-0 small opacity-75">Session Earnings</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card stat-card bg-gradient-purple text-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-white bg-opacity-25 p-2 rounded-3 text-center" style="width: 45px; height: 45px;">
                            <i class="bi bi-chat-left-dots fs-4"></i>
                        </div>
                        <div class="small opacity-75">QUERIES</div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $stats['queries'] }}</h2>
                    <p class="mb-0 small opacity-75">General Appointments</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <!-- Demographics Section -->
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Booking Demographics & Insights</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Gender Distribution -->
                        <div class="col-md-6 border-end">
                            <h6 class="small fw-bold text-muted mb-3 text-uppercase">Gender Distribution</h6>
                            @php $totalBookings = $stats['bookings'] ?: 1; @endphp
                            @foreach($genderStats as $gStat)
                                @php $percent = ($gStat->total / $totalBookings) * 100; @endphp
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small fw-bold">{{ $gStat->gender }}</span>
                                        <span class="small text-muted">{{ $gStat->total }}
                                            ({{ number_format($percent, 1) }}%)</span>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar {{ $loop->index % 2 == 0 ? 'bg-primary-color' : 'bg-gradient-gold' }}"
                                            role="progressbar" style="width: {{ $percent }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                            @if($genderStats->isEmpty())
                                <p class="text-muted small">No gender data available yet.</p>
                            @endif
                        </div>
                        <!-- Top Locations -->
                        <div class="col-md-6 ps-md-4">
                            <h6 class="small fw-bold text-muted mb-3 text-uppercase">Top Booking Locations</h6>
                            <div class="list-group list-group-flush">
                                @foreach($locationStats as $lStat)
                                    <div
                                        class="list-group-item px-0 py-2 border-0 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 rounded-circle me-3 text-primary"
                                                style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                            <span class="fw-semibold small">{{ $lStat->location ?: 'Not specified' }}</span>
                                        </div>
                                        <span class="badge bg-light text-dark border rounded-pill">{{ $lStat->total }}
                                            Bookings</span>
                                    </div>
                                @endforeach
                                @if($locationStats->isEmpty())
                                    <p class="text-muted small">No location data available yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <!-- Recent Therapist Bookings -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Recent Therapist Bookings</h6>
                    <a href="{{ route('admin.therapist-bookings.index') }}" class="btn btn-sm btn-light border small">View
                        All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle dash-table mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Patient</th>
                                    <th>Therapist</th>
                                    <th>Schedule</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold">{{ $booking->name }}</div>
                                            <div class="small text-muted" style="font-size: 0.7rem;">{{ $booking->email }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-primary-color fw-semibold">{{ $booking->therapist->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="small fw-bold">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d') }}
                                            </div>
                                            <div class="small text-muted" style="font-size: 0.7rem;">
                                                {{ $booking->booking_time }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <span
                                                class="dash-badge {{ $booking->payment_status == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">
                                                {{ strtoupper($booking->payment_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted small">No recent bookings.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent General Appointments -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">General Queries</h6>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-light border small">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentQueries as $query)
                            <div class="list-group-item p-3 border-0 border-bottom mx-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="pe-2">
                                        <h6 class="mb-0 fw-bold small text-dark">{{ $query->name }}</h6>
                                        <p class="mb-1 text-muted small" style="font-size: 0.7rem; line-height: 1.2;">
                                            {{ Str::limit($query->subject, 35) }}
                                        </p>
                                        <div class="small text-muted" style="font-size: 0.65rem;">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ \Carbon\Carbon::parse($query->date)->format('M d') }}
                                            <i class="bi bi-clock ms-2 me-1"></i> {{ $query->time }}
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.appointments.show', $query->id) }}"
                                        class="btn btn-icon btn-sm btn-light border rounded-circle">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">No recent queries.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection