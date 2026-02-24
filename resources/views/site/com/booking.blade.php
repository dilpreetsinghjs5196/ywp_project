@extends('site.com.layouts.app')

@section('title', 'Book a Session with ' . $team->name)

@section('content')
    <style>
        :root {
            --booking-primary: #044A80;
            --booking-secondary: #ffbf00;
            --booking-bg: #f8fafc;
            --booking-card-bg: #ffffff;
            --booking-border: #e2e8f0;
            --booking-text-main: #1e293b;
            --booking-text-muted: #64748b;
        }

        body {
            background-color: var(--booking-bg);
        }

        .booking-wrapper {
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .booking-container {
            display: grid;
            grid-template-columns: 280px 1fr 340px;
            gap: 0;
            background: var(--booking-card-bg);
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            max-width: 1200px;
            margin: auto;
            min-height: 650px;
        }

        /* Sidebar Progress */
        .booking-steps-sidebar {
            background: #fdfdfd;
            border-right: 1px solid var(--booking-border);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
        }

        .promo-banner {
            background: #fff8e1;
            border: 1px dashed #ffbf00;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 40px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 35px;
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 12px;
            top: 30px;
            height: calc(100% - 10px);
            width: 1px;
            background: #cbd5e1;
        }

        .step-circle {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            background: white;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            border-color: var(--booking-secondary);
            background: var(--booking-secondary);
            box-shadow: 0 0 0 4px rgba(255, 191, 0, 0.2);
        }

        .step-item.active .step-circle::after {
            content: '';
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .step-content .step-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--booking-text-muted);
            margin-bottom: 2px;
        }

        .step-item.active .step-title {
            color: var(--booking-text-main);
        }

        /* Main Content */
        .booking-main-content {
            padding: 40px;
            overflow-y: auto;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #4b5a44;
            margin-bottom: 25px;
        }

        /* Mode Selection Squares */
        .mode-selection-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 35px;
        }

        .mode-square {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }

        .mode-square i {
            font-size: 1.5rem;
            color: #4b5a44;
        }

        .mode-square span {
            font-size: 0.8rem;
            font-weight: 600;
            color: #4b5a44;
        }

        .mode-square.active {
            background: #6b7c5c;
            border-color: #6b7c5c;
        }

        .mode-square.active i,
        .mode-square.active span {
            color: white;
        }

        /* Session Duration Info */
        .duration-info-box {
            margin-top: 40px;
        }

        .duration-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #4b5a44;
            margin-bottom: 15px;
        }

        .duration-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }

        .duration-text {
            font-size: 1rem;
            font-weight: 700;
            color: #f7724a;
            /* Salmon/Orange color from ref */
        }

        .price-text {
            font-size: 1rem;
            font-weight: 600;
            color: #64748b;
        }

        .price-amount {
            font-weight: 700;
            color: #1e293b;
        }

        .mode-card {
            border: 2px solid var(--booking-border);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 25px;
        }

        .mode-card.selected {
            border-color: #a7f3d0;
            background: #f0fdf4;
        }

        .mode-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .mode-icon {
            width: 48px;
            height: 48px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--booking-primary);
        }

        .address-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .therapist-mini-card {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--booking-border);
        }

        /* Service Selection Cards */
        .service-selection-card {
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
            border: 2px solid #e2e8f0 !important;
        }

        .service-selection-card:hover {
            border-color: #cbd5e1 !important;
            transform: translateY(-2px);
        }

        .service-selection-card.active {
            border-color: var(--booking-primary) !important;
            background: #f0f7ff;
            box-shadow: 0 4px 12px rgba(4, 74, 128, 0.1);
        }

        .service-check-circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            position: relative;
        }

        .service-selection-card.active .service-check-circle {
            border-color: var(--booking-primary);
            background: var(--booking-primary);
        }

        .service-selection-card.active .service-check-circle::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .therapist-mini-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
        }

        /* Date and Time Panel */
        .booking-datetime-panel {
            background: #fdfdfd;
            border-left: 1px solid var(--booking-border);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
        }

        .calendar-strip {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 8px;
        }

        .calendar-day {
            flex: 1;
            text-align: center;
            padding: 10px 5px;
            border-radius: 12px;
            border: 1px solid var(--booking-border);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .calendar-day.active {
            background: var(--booking-primary);
            border-color: var(--booking-primary);
            color: white;
        }

        .calendar-day .day-name {
            font-size: 0.7rem;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: 600;
            opacity: 0.8;
        }

        .calendar-day .day-number {
            font-size: 1rem;
            font-weight: 700;
        }

        .time-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--booking-text-muted);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 25px;
        }

        .time-slot {
            background: white;
            border: 1px solid var(--booking-border);
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .time-slot:hover {
            border-color: var(--booking-primary);
            color: var(--booking-primary);
        }

        .time-slot.selected {
            background: var(--booking-primary);
            color: white;
            border-color: var(--booking-primary);
        }

        .continue-btn {
            margin-top: auto;
            background: var(--booking-secondary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .continue-btn:hover {
            background: #e6ab00;
            transform: translateY(-2px);
        }

        @media (max-width: 991px) {
            .booking-container {
                grid-template-columns: 1fr;
            }

            .booking-steps-sidebar,
            .booking-datetime-panel {
                border: none;
            }
        }
    </style>

    <div class="booking-wrapper">
        <div class="container">
            <div class="booking-container shadow-2xl">
                <!-- Left Sidebar -->
                <div class="booking-steps-sidebar">
                    <!-- <div class="promo-banner">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-percent text-warning fs-5"></i>
                                                <span class="fw-bold text-dark">20% OFF</span>
                                            </div>
                                            <p class="small text-muted mb-0">20% Off on Pre-Booking First Session</p>
                                        </div> -->

                    <div class="booking-steps">
                        <div class="step-item active" id="sidebar-step1">
                            <div class="step-circle"></div>
                            <div class="step-content">
                                <div class="step-title">Select session details</div>
                            </div>
                        </div>
                        <div class="step-item" id="sidebar-step2">
                            <div class="step-circle"></div>
                            <div class="step-content">
                                <div class="step-title">Enter your details</div>
                            </div>
                        </div>
                        <div class="step-item" id="sidebar-step3">
                            <div class="step-circle"></div>
                            <div class="step-content">
                                <div class="step-title">Complete your booking</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button class="btn btn-link text-decoration-none text-muted p-0 p-lg-1" id="backBtn"
                            onclick="goBack()">
                            <i class="bi bi-arrow-left me-2"></i> Back
                        </button>
                    </div>
                </div>

                <!-- Main Panel -->
                <div class="booking-main-content">
                    @php
                        $therapistMode = strtolower($team->mode ?? '');
                        $showInPerson = str_contains($therapistMode, 'in-person') || str_contains($therapistMode, 'offline') || empty($therapistMode);
                        $showOnline = str_contains($therapistMode, 'online') || str_contains($therapistMode, 'video') || str_contains($therapistMode, 'phone') || empty($therapistMode);

                        $defaultMode = $showInPerson ? 'In-person' : 'Video call';
                    @endphp

                    <!-- Step 1 Content -->
                    <div id="center-step1">
                        @if($team->services->count() > 0)
                            <h4 class="section-title">Select Service</h4>
                            <div class="row g-3 mb-4">
                                @foreach($team->services as $service)
                                    <div class="col-md-6">
                                        <div class="service-selection-card p-3 rounded-4 border {{ $loop->first ? 'active' : '' }}"
                                            onclick="selectService(this, '{{ $service->id }}', '{{ $service->pivot->fees ?? $team->fees ?? 1800 }}', '{{ $service->title }}')">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="service-check-circle"></div>
                                                <div class="fw-bold text-dark">{{ $service->title }}</div>
                                            </div>
                                            <div class="text-primary-color small fw-bold mt-1">
                                                ₹{{ number_format($service->pivot->fees ?? $team->fees ?? 1800) }} / session</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <h4 class="section-title">Mode of Session</h4>

                        <div class="mode-selection-grid">
                            @if($showInPerson)
                                <div class="mode-square {{ $defaultMode == 'In-person' ? 'active' : '' }}"
                                    onclick="selectMode(this, 'In-person')">
                                    <i class="bi bi-house"></i>
                                    <span>In-person</span>
                                </div>
                            @endif

                            @if($showOnline)
                                <div class="mode-square {{ $defaultMode == 'Video call' ? 'active' : '' }}"
                                    onclick="selectMode(this, 'Video call')">
                                    <i class="bi bi-camera-video"></i>
                                    <span>Video call</span>
                                </div>
                                <div class="mode-square {{ $defaultMode == 'Phone call' ? 'active' : '' }}"
                                    onclick="selectMode(this, 'Phone call')">
                                    <i class="bi bi-telephone"></i>
                                    <span>Phone call</span>
                                </div>
                            @endif
                        </div>

                        <!-- Dynamic Address Area -->
                        <div id="addressSection" class="mb-4"
                            style="display: {{ $defaultMode == 'In-person' ? 'block' : 'none' }};">
                            <div class="address-card">
                                <div class="d-flex gap-2 mb-2">
                                    <i class="bi bi-geo-alt-fill text-primary"></i>
                                    <p class="small text-muted fw-bold mb-0">Session Location:</p>
                                </div>
                                <p class="mb-0 fw-semibold text-dark">
                                    {{ $settings['booking_address'] ?? 'Address not set' }}
                                </p>
                            </div>
                        </div>

                        <div class="duration-info-box">
                            <h4 class="duration-label">Session Duration</h4>
                            <div class="duration-details">
                                <div class="duration-text">{{ $settings['session_duration'] ?? '50 mins' }}, 1 session</div>
                                <div class="price-text">
                                    <span class="price-amount">₹{{ number_format($team->fees ?? 1800) }}</span> / session
                                </div>
                            </div>
                        </div>

                        <div class="therapist-mini-card">
                            <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                class="therapist-mini-img shadow-sm">
                            <div>
                                <div class="fw-bold text-dark mb-0 fs-5">{{ $team->name }}</div>
                                <div class="small text-muted">{{ $team->designation }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Content (Session Details Summary) -->
                    <div id="center-step2" style="display: none;">
                        <h4 class="section-title">Your Session Details:</h4>

                        <div class="bg-light rounded-4 p-4 border border-secondary-subtle">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                        class="rounded-circle border border-2 border-white shadow-sm"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <p class="small text-muted mb-0">Therapy session with</p>
                                        <h5 class="fw-bold mb-0 text-dark">{{ $team->name }}</h5>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold"
                                    onclick="goToStep(1)">
                                    <i class="bi bi-pencil-square me-1"></i> EDIT
                                </button>
                            </div>

                            <p class="text-dark fw-bold mb-3">Ahaana Mental Health Hospital</p>

                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-house text-primary fs-5"></i>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0 text-dark" id="summary-datetime">Sat, 14 Feb 2026, 11:00 AM IST
                                    </p>
                                    <p class="small text-muted mb-0" id="summary-mode">at In-person,
                                        {{ $settings['session_duration'] ?? '50 mins' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="booking-datetime-panel">
                    <!-- Step 1 Right Content -->
                    <div id="right-step1">
                        <h4 class="section-title">Date and Time</h4>

                        <div class="calendar-strip" id="calendarStrip">
                            <!-- Javascript will populate this -->
                        </div>

                        <div class="time-slots-container">
                            <div class="time-section-title">
                                <i class="bi bi-brightness-high"></i> Morning
                            </div>
                            <div class="time-slots">
                                <div class="time-slot" data-time="10:00 AM">10:00 AM</div>
                                <div class="time-slot" data-time="10:55 AM">10:55 AM</div>
                                <div class="time-slot" data-time="11:50 AM">11:50 AM</div>
                            </div>

                            <div class="time-section-title">
                                <i class="bi bi-sun"></i> Afternoon
                            </div>
                            <div class="time-slots">
                                <div class="time-slot" data-time="02:00 PM">02:00 PM</div>
                                <div class="time-slot" data-time="02:55 PM">02:55 PM</div>
                                <div class="time-slot" data-time="03:50 PM">03:50 PM</div>
                                <div class="time-slot" data-time="04:45 PM">04:45 PM</div>
                            </div>
                        </div>

                        <button class="continue-btn w-100 mt-auto shadow-lg" id="continueBooking">
                            Continue
                        </button>
                    </div>

                    <!-- Step 2 Right Content (Personal Details Form) -->
                    <div id="right-step2" style="display: none;">
                        <h4 class="section-title">Personal Details</h4>
                        <p class="small text-muted mb-4">Please verify your details to complete your session booking.</p>

                        <form id="detailsForm">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">FULL NAME*</label>
                                <input type="text" name="name" class="form-control rounded-3 py-2 border-secondary-subtle"
                                    required placeholder="Enter full name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">GENDER*</label>
                                <select name="gender" class="form-select rounded-3 py-2 border-secondary-subtle" required>
                                    <option value="" selected disabled>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">CITY/LOCATION*</label>
                                <input type="text" name="location"
                                    class="form-control rounded-3 py-2 border-secondary-subtle" required
                                    placeholder="Enter your city or location">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">PHONE NUMBER*</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary-subtle text-muted">🇮🇳
                                        +91</span>
                                    <input type="tel" name="phone" class="form-control border-secondary-subtle py-2"
                                        required placeholder="Enter phone number">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">EMAIL ADDRESS*</label>
                                <input type="email" name="email" class="form-control rounded-3 py-2 border-secondary-subtle"
                                    required placeholder="name@example.com">
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">ANY MESSAGE (OPTIONAL)</label>
                                <textarea name="message" class="form-control rounded-3 border-secondary-subtle" rows="3"
                                    placeholder="Additional information..."></textarea>
                            </div>

                            <button type="submit" class="continue-btn w-100 shadow-lg">
                                CONFIRM BOOKING
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const strip = document.getElementById('calendarStrip');
            const slotsContainer = document.querySelector('.time-slots-container');
            const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            const months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

            // Therapist Availability Data
            let availability = @json($team->availability ?? []);
            const availabilityType = @json($team->availability_type ?? 'date');
            const weeklyAvailability = @json($team->weekly_availability ?? []);

            let availableDates = [];

            if (availabilityType === 'weekly') {
                // Clean availability for recreation
                availability = {};
                for (let i = 0; i < 30; i++) { // Show up to 30 days for weekly
                    const d = new Date();
                    d.setHours(0, 0, 0, 0);
                    d.setDate(d.getDate() + i);

                    const dayNamesFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const dayName = dayNamesFull[d.getDay()];

                    if (weeklyAvailability[dayName] && weeklyAvailability[dayName].length > 0) {
                        const y = d.getFullYear();
                        const m = String(d.getMonth() + 1).padStart(2, '0');
                        const day = String(d.getDate()).padStart(2, '0');
                        const dateStr = `${y}-${m}-${day}`;

                        availableDates.push(dateStr);
                        availability[dateStr] = weeklyAvailability[dayName];
                    }
                }
            } else {
                availableDates = Object.keys(availability).sort();
            }

            let selectedDateStr = null;

            function renderTimeSlots(dateStr) {
                const times = availability[dateStr] || [];

                if (times.length === 0) {
                    slotsContainer.innerHTML = '<div class="alert alert-light text-center py-4 border">No slots available for this day.</div>';
                    return;
                }

                // Split into Morning (before 12 PM) and Afternoon (12 PM onwards)
                const morning = times.filter(t => t.toUpperCase().includes('AM') || (t.includes('12:') && t.toUpperCase().includes('AM')));
                const afternoon = times.filter(t => !morning.includes(t));

                let html = '';

                if (morning.length > 0) {
                    html += `<div class="time-section-title"><i class="bi bi-brightness-high"></i> Morning</div>`;
                    html += `<div class="time-slots">`;
                    morning.forEach(t => {
                        html += `<div class="time-slot" data-time="${t}">${t}</div>`;
                    });
                    html += '</div>';
                }

                if (afternoon.length > 0) {
                    html += `<div class="time-section-title"><i class="bi bi-sun"></i> Afternoon</div>`;
                    html += `<div class="time-slots">`;
                    afternoon.forEach(t => {
                        html += `<div class="time-slot" data-time="${t}">${t}</div>`;
                    });
                    html += '</div>';
                }

                slotsContainer.innerHTML = html;

                // Re-bind click events
                document.querySelectorAll('.time-slot').forEach(slot => {
                    slot.onclick = function () {
                        document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                        slot.classList.add('selected');
                    };
                });
            }

            if (availableDates.length > 0) {
                availableDates.forEach((dateStr, i) => {
                    const dateObj = new Date(dateStr);
                    const dayDiv = document.createElement('div');
                    dayDiv.className = 'calendar-day' + (i === 0 ? ' active' : '');

                    if (i === 0) {
                        selectedDateStr = dateStr;
                        renderTimeSlots(dateStr);
                    }

                    dayDiv.innerHTML = `
                                                    <div class="day-name">${days[dateObj.getDay()]}</div>
                                                    <div class="day-number">${dateObj.getDate()} ${months[dateObj.getMonth()]}</div>
                                                `;

                    dayDiv.onclick = function () {
                        document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('active'));
                        dayDiv.classList.add('active');
                        selectedDateStr = dateStr;
                        renderTimeSlots(dateStr);
                    };

                    strip.appendChild(dayDiv);
                });
            } else {
                strip.innerHTML = '<div class="alert alert-warning small w-100 text-center">No availability set by therapist.</div>';
                slotsContainer.innerHTML = '';
            }

            let currentStep = 1;
            let selectedModeName = @json($defaultMode);
            let selectedServiceId = @json($team->services->first()->id ?? null);
            let selectedServiceName = @json($team->services->first()->title ?? 'Therapy Session');

            window.selectService = function (element, id, price, name) {
                selectedServiceId = id;
                selectedServiceName = name;
                document.querySelectorAll('.service-selection-card').forEach(c => c.classList.remove('active'));
                element.classList.add('active');

                // Update price display
                document.querySelector('.price-amount').innerText = '₹' + parseInt(price).toLocaleString();
            };
            window.goToStep = function (step) {
                currentStep = step;

                // Update sidebar
                document.querySelectorAll('.step-item').forEach(s => s.classList.remove('active'));
                document.getElementById(`sidebar-step${step}`).classList.add('active');

                // Update panels
                document.getElementById('center-step1').style.display = (step === 1 ? 'block' : 'none');
                document.getElementById('center-step2').style.display = (step === 2 ? 'block' : 'none');
                document.getElementById('right-step1').style.display = (step === 1 ? 'block' : 'none');
                document.getElementById('right-step2').style.display = (step === 2 ? 'block' : 'none');
            };

            window.goBack = function () {
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                } else {
                    history.back();
                }
            };

            // Mode Selection Logic
            window.selectMode = function (element, mode) {
                selectedModeName = mode;
                document.querySelectorAll('.mode-square').forEach(s => s.classList.remove('active'));
                element.classList.add('active');

                const addressSection = document.getElementById('addressSection');
                if (mode === 'In-person') {
                    addressSection.style.display = 'block';
                } else {
                    addressSection.style.display = 'none';
                }
            };

            // Continue button logic
            document.getElementById('continueBooking').onclick = function () {
                const selectedDateNode = document.querySelector('.calendar-day.active .day-number');
                const selectedDayNode = document.querySelector('.calendar-day.active .day-name');
                const selectedTime = document.querySelector('.time-slot.selected')?.dataset.time;

                if (!selectedTime) {
                    alert('Please select a time slot first.');
                    return;
                }

                // Populate Step 2 Summary
                const dateText = selectedDateNode.innerText;
                const dayText = selectedDayNode.innerText;
                const currentYear = new Date().getFullYear();

                document.getElementById('summary-datetime').innerText = `${dayText}, ${dateText} ${currentYear}, ${selectedTime} IST`;
                document.getElementById('summary-mode').innerText = `at ${selectedModeName}, {{ $settings['session_duration'] ?? '50 mins' }}`;

                goToStep(2);
            };

            // Form Submission with Razorpay
            document.getElementById('detailsForm').onsubmit = function (e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerText;
                submitBtn.disabled = true;
                submitBtn.innerText = 'PROCCESSING...';

                const formData = {
                    _token: "{{ csrf_token() }}",
                    team_id: "{{ $team->id }}",
                    service_id: selectedServiceId,
                    name: this.elements['name'].value,
                    gender: this.elements['gender'].value,
                    location: this.elements['location'].value,
                    phone: this.elements['phone'].value,
                    email: this.elements['email'].value,
                    message: this.elements['message'].value,
                    date: selectedDateStr,
                    time: document.querySelector('.time-slot.selected')?.dataset.time,
                    mode: selectedModeName
                };

                // 1. Initialize Booking
                $.ajax({
                    url: "{{ route('com.therapist.booking.initialize') }}",
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            // 2. Open Razorpay
                            const options = {
                                "key": response.razorpay_key,
                                "amount": response.amount,
                                "currency": "INR",
                                "name": "YWP Therapy",
                                "description": "Session Booking Fees",
                                "image": "{{ asset('image/logo-ywp.png') }}",
                                "handler": function (payResponse) {
                                    // 3. Verify Payment
                                    $.ajax({
                                        url: "{{ route('com.therapist.booking.verify') }}",
                                        method: 'POST',
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            booking_id: response.booking_id,
                                            razorpay_payment_id: payResponse.razorpay_payment_id,
                                            razorpay_order_id: payResponse.razorpay_order_id,
                                            razorpay_signature: payResponse.razorpay_signature
                                        },
                                        success: function (verifyResponse) {
                                            if (verifyResponse.success) {
                                                let msg = 'Success! Your session has been booked.';
                                                if (verifyResponse.email_status && verifyResponse.email_status.includes('failed')) {
                                                    msg += '\n\nNote: We completed your booking but had trouble sending the confirmation email. Please contact support if needed.';
                                                } else {
                                                    msg += ' Confirmation emails have been sent.';
                                                }

                                                alert(msg);
                                                window.location.href = "{{ route('com.home') }}";
                                            } else {
                                                alert('Verification failed: ' + verifyResponse.message);
                                                submitBtn.disabled = false;
                                                submitBtn.innerText = originalText;
                                            }
                                        },
                                        error: function (xhr) {
                                            console.error('Verification Error:', xhr);
                                            alert('Server error during verification. Please contact support with your Payment ID: ' + payResponse.razorpay_payment_id);
                                            submitBtn.disabled = false;
                                            submitBtn.innerText = originalText;
                                        }
                                    });
                                },
                                "prefill": {
                                    "name": response.customer.name,
                                    "email": response.customer.email,
                                    "contact": response.customer.contact
                                },
                                "theme": {
                                    "color": "#044A80"
                                },
                                "modal": {
                                    "ondismiss": function () {
                                        submitBtn.disabled = false;
                                        submitBtn.innerText = originalText;
                                    }
                                }
                            };
                            const rzp1 = new Razorpay(options);
                            rzp1.open();
                        } else {
                            alert('Booking failed: ' + response.message);
                            submitBtn.disabled = false;
                            submitBtn.innerText = originalText;
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON?.errors;
                        let msg = 'Error initializing booking.';
                        if (errors) {
                            msg = Object.values(errors).flat().join('\n');
                        }
                        alert(msg);
                        submitBtn.disabled = false;
                        submitBtn.innerText = originalText;
                    }
                });
            };
        });
    </script>
@endsection