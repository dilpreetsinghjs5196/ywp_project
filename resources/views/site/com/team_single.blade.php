@extends('site.com.layouts.app')

@section('title', $team->name . ' - ' . $team->designation)

@section('content')
    <!-- Banner Section -->
    <section class="section position-relative"
        style="background-image: url('{{ asset('image/footer-img.jpg') }}'); height: 40vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
            <div
                class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
                <h1 class="display-2 mb-0" style="font-weight: 900;">{{ $team->name }}</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none {{ request()->routeIs('com.home') ? 'text-primary-color' : 'text-white' }}"
                                href="{{ route('com.home') }}">Homepage</a>
                        </li>
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none {{ request()->routeIs('com.team') ? 'text-primary-color' : 'text-white' }}"
                                href="{{ route('com.team') }}">Our Team</a>
                        </li>
                        <li class="breadcrumb-item {{ request()->routeIs('com.team.single', $team->id) ? 'text-primary-color' : 'text-white' }}"
                            aria-current="page">
                            {{ $team->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- #banner end -->

    <!-- Team Member Details Section -->
    <section class="section py-5">
        <div class="b-container">
            <div class="row g-5">
                <!-- Left Column: Image -->
                <div class="col-lg-5" data-aos="fade-right" data-aos-duration="1000">
                    <div class="position-relative rounded-5 overflow-hidden shadow-lg">
                        <div class="ratio ratio-1x1">
                            <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                alt="{{ $team->name }}" class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>

                    <!-- Social Links (Optional placement below image) -->
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        @if($team->facebook)
                            <a href="{{ $team->facebook }}" target="_blank"
                                class="btn btn-primary-solid rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"><i class="bi bi-facebook fs-5"></i></a>
                        @endif
                        @if($team->twitter)
                            <a href="{{ $team->twitter }}" target="_blank"
                                class="btn btn-primary-solid rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"><i class="bi bi-twitter-x fs-5"></i></a>
                        @endif
                        @if($team->instagram)
                            <a href="{{ $team->instagram }}" target="_blank"
                                class="btn btn-primary-solid rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"><i class="bi bi-instagram fs-5"></i></a>
                        @endif
                        @if($team->linkedin)
                            <a href="{{ $team->linkedin }}" target="_blank"
                                class="btn btn-primary-solid rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;"><i class="bi bi-linkedin fs-5"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Details & Booking -->
                <div class="col-lg-7" data-aos="fade-left" data-aos-duration="1000">
                    <h5 class="text-primary-color fw-bold text-uppercase mb-2">{{ $team->designation }}</h5>
                    <h2 class="font-1 fw-bold display-5 mb-4">{{ $team->name }}</h2>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 font-1">About Me</h5>
                        <p class="text-muted-color fs-5" style="line-height: 1.8;">
                            {!! nl2br(e($team->description ?? 'No description available.')) !!}
                        </p>
                    </div>

                    <!-- Booking Section -->
                    <div class="bg-light p-4 rounded-4 shadow-sm border border-secondary-subtle">
                        <h4 class="font-1 fw-bold mb-4">Book an Appointment</h4>
                        <form action="#" method="POST"> <!-- Placeholder action -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="bookingDate" class="form-label fw-semibold">Select Date</label>
                                    <input type="date" class="form-control py-2" id="bookingDate" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="bookingTime" class="form-label fw-semibold">Select Time Slot</label>
                                    <select class="form-select py-2" id="bookingTime" required>
                                        <option selected disabled value="">Choose a time...</option>
                                        <option value="09:00">09:00 AM - 10:00 AM</option>
                                        <option value="10:00">10:00 AM - 11:00 AM</option>
                                        <option value="11:00">11:00 AM - 12:00 PM</option>
                                        <option value="13:00">01:00 PM - 02:00 PM</option>
                                        <option value="14:00">02:00 PM - 03:00 PM</option>
                                        <option value="15:00">03:00 PM - 04:00 PM</option>
                                        <option value="16:00">04:00 PM - 05:00 PM</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary-solid btn-lg w-100 py-3 fw-bold">Confirm
                                        Booking</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Other Therapists Section (Optional) -->
    @if($recentTeams->count() > 0)
        <section class="section py-5 bg-light">
            <div class="b-container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h3 class="font-1 fw-bold">Other Specialists</h3>
                    </div>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($recentTeams as $member)
                        <div class="col-md-4 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="ratio ratio-1x1">
                                    <a href="{{ route('com.team.single', $member->id) }}">
                                        <img src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                                            class="card-img-top object-fit-cover w-100 h-100" alt="{{ $member->name }}">
                                    </a>
                                </div>
                                <div class="card-body text-center bg-white">
                                    <h5 class="card-title font-1 fw-bold mb-1">
                                        <a href="{{ route('com.team.single', $member->id) }}"
                                            class="text-decoration-none text-dark">{{ $member->name }}</a>
                                    </h5>
                                    <p class="card-text text-muted small mb-2">{{ $member->designation }}</p>
                                    <a href="{{ route('com.team.single', $member->id) }}"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-4">View Profile</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@push('js')
    <script>
        // Set minimum date to today
        const dateInput = document.getElementById('bookingDate');
        if (dateInput) {
            dateInput.min = new Date().toISOString().split("T")[0];
        }
    </script>
@endpush