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

                    <div class="mb-4">
                        <h5 class="fw-bold mb-3 font-1">About Me</h5>
                        <p class="text-muted-color fs-5" style="line-height: 1.8;">
                            {!! nl2br(e($team->description ?? 'No description available.')) !!}
                        </p>
                    </div>

                    <div class="row g-3 mb-4">
                        @if($team->mode)
                            <div class="col-md-6 mb-2">
                                <div class="fw-bold small text-muted text-uppercase">Mode</div>
                                <div class="fw-semibold">{{ $team->mode }}</div>
                            </div>
                        @endif
                        @if($team->languages)
                            <div class="col-md-6 mb-2">
                                <div class="fw-bold small text-muted text-uppercase">Languages</div>
                                <div class="fw-semibold">{{ $team->languages }}</div>
                            </div>
                        @endif
                        @if($team->session_type)
                            <div class="col-md-6 mb-2">
                                <div class="fw-bold small text-muted text-uppercase">Session Type</div>
                                <div class="fw-semibold">{{ $team->session_type }}</div>
                            </div>
                        @endif
                        @if($team->specialization)
                            <div class="col-12 mb-2">
                                <div class="fw-bold small text-muted text-uppercase">Specialization</div>
                                <div class="fw-semibold">{{ $team->specialization }}</div>
                            </div>
                        @endif
                    </div>

                    @if($team->specialties)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-2 font-1">Specialties</h5>
                            <ul class="list-unstyled d-flex flex-wrap gap-2">
                                @foreach(explode("\n", $team->specialties) as $specialty)
                                    @if(trim($specialty))
                                        <li class="bg-light px-3 py-1 rounded-pill border small fw-semibold">
                                            {{ trim($specialty) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($team->qualifications)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-2 font-1">Qualifications</h5>
                            <div class="text-muted-color">
                                {!! nl2br(e($team->qualifications)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Booking Section -->
                    <div class="booking-cta-card p-4 rounded-5 shadow-lg border-0 mt-5"
                        style="background: linear-gradient(135deg, var(--primary-color), #086bb8); position: relative; overflow: hidden;">
                        <!-- Decorative background elements -->
                        <div class="position-absolute opacity-5"
                            style="right: -30px; bottom: -30px; transform: rotate(-15deg); pointer-events: none;">
                            <i class="bi bi-calendar-check text-white" style="font-size: 15rem;"></i>
                        </div>

                        <div class="position-relative" style="z-index: 2;">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h4 class="font-1 fw-bold text-white mb-3">Begin Your Healing Journey</h4>
                                    <p class="text-white mb-4 fs-6 fw-medium lh-base">
                                        Schedule a session with {{ $team->name }} to receive personalized care and support
                                        tailored to your wellness goals.
                                    </p>
                                    <!-- @if($team->fees)
                                <div class="mb-4">
                                    <span class="badge bg-white text-primary-color py-2 px-3 rounded-pill fs-6 fw-bold">
                                        Session Fees: ₹{{ number_format($team->fees) }}
                                    </span>
                                </div>
                            @endif -->
                                </div>
                            </div>

                            <a href="{{ route('com.therapist.booking', $team->id) }}"
                                class="btn btn-secondary-solid btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm transition-hover">
                                <i class="bi bi-calendar-plus me-2"></i> Book Appointment
                            </a>
                        </div>
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