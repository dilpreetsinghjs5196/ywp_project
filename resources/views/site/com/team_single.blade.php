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
    <section class="section py-5 bg-white">
        <div class="b-container">
            <div class="row g-5">
                <!-- Left Column: Image -->
                <div class="col-lg-5" data-aos="fade-right" data-aos-duration="1000">
                    <div class="position-relative rounded-5 overflow-hidden shadow-lg border-4 border-white">
                        <div class="ratio ratio-1x1">
                            <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                alt="{{ $team->name }}" class="w-100 h-100 object-fit-cover shadow">
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
                        @if($team->facebook)
                            <a href="{{ $team->facebook }}" target="_blank"
                                class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm fw-bold">Facebook</a>
                        @endif
                        @if($team->twitter)
                            <a href="{{ $team->twitter }}" target="_blank"
                                class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm fw-bold">Twitter</a>
                        @endif
                        @if($team->instagram)
                            <a href="{{ $team->instagram }}" target="_blank"
                                class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm fw-bold">Instagram</a>
                        @endif
                        @if($team->linkedin)
                            <a href="{{ $team->linkedin }}" target="_blank"
                                class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm fw-bold">LinkedIn</a>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Details & Booking -->
                <div class="col-lg-7" data-aos="fade-left" data-aos-duration="1000">
                    <h6 class="text-primary-color fw-bold text-uppercase mb-2 letter-spacing-1">{{ $team->designation }}
                    </h6>
                    <h2 class="font-1 fw-bold display-5 mb-4">{{ $team->name }}</h2>

                    <div class="mb-4">
                        <h4 class="fw-bold mb-3 font-1 text-dark">About {{ $team->name }}</h4>
                        <p class="text-muted-color fs-5 mb-0" style="line-height: 1.8;">
                            {!! nl2br(e($team->description ?? 'No description available.')) !!}
                        </p>
                    </div>

                    <div class="row g-4 mb-4 mt-2">
                        @if($team->mode)
                            <div class="col-md-6">
                                <div>
                                    <div class="fw-bold small text-muted text-uppercase">Mode</div>
                                    <div class="fw-semibold text-dark fs-5">{{ $team->mode }}</div>
                                </div>
                            </div>
                        @endif
                        @if($team->languages)
                            <div class="col-md-6">
                                <div>
                                    <div class="fw-bold small text-muted text-uppercase">Languages</div>
                                    <div class="fw-semibold text-dark fs-5">{{ $team->languages }}</div>
                                </div>
                            </div>
                        @endif
                        @if($team->session_type)
                            <div class="col-md-6">
                                <div>
                                    <div class="fw-bold small text-muted text-uppercase">Session Type</div>
                                    <div class="fw-semibold text-dark fs-5">{{ $team->session_type }}</div>
                                </div>
                            </div>
                        @endif
                        @if($team->office_address || !empty($team->weekly_addresses))
                            <div class="col-12">
                                <div class="bg-light p-3 rounded-4 border-start border-primary border-4 mb-3">
                                    <div class="fw-bold small text-muted text-uppercase mb-2"><i class="bi bi-geo-alt-fill me-1"></i> Session Locations</div>
                                    @if($team->office_address)
                                        <div class="fw-semibold text-dark fs-6 mb-1">Primary: {{ $team->office_address }}</div>
                                    @endif
                                    @if(!empty($team->weekly_addresses))
                                        <div class="mt-2 text-dark">
                                            <p class="small fw-bold text-muted mb-1">Weekly Schedule:</p>
                                            <ul class="list-unstyled small mb-0">
                                                @foreach($team->weekly_addresses as $day => $addr)
                                                    @if($addr)
                                                        <li><span class="text-primary fw-bold">{{ $day }}:</span> {{ $addr }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($team->specialization)
                            <div class="col-12">
                                <div>
                                    <div class="fw-bold small text-muted text-uppercase">Specialization</div>
                                    <div class="fw-semibold text-dark fs-5">{{ $team->specialization }}</div>
                                </div>
                            </div>
                        @endif
                        @if($team->services->count() > 0)
                            <div class="col-12">
                                <div>
                                    <div class="fw-bold small text-muted text-uppercase">Services & Durations</div>
                                    <div class="fw-semibold text-dark fs-5">
                                        @foreach($team->services as $service)
                                            <span class="d-inline-block me-3 mb-1">
                                                <i class="bi bi-check2-circle text-primary me-1"></i>
                                                {{ $service->title }} 
                                                <small class="text-muted">({{ $service->pivot->duration ?? $settings['session_duration'] ?? '50 mins' }})</small>
                                                @if(!$loop->last) <span class="text-muted-subtle ms-1">|</span> @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($team->specialties)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 font-1 text-dark">Areas of Expertise</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $specialties = $team->specialties ? preg_split('/[,\n]+/', $team->specialties) : [];
                                @endphp
                                @foreach($specialties as $tag)
                                    @if(trim($tag))
                                        <span
                                            class="badge bg-light text-dark border px-3 py-2 rounded-pill fs-6 fw-medium shadow-xs text-wrap text-start"
                                            style="max-width: 100%; white-space: normal;">
                                            {{ trim($tag) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($team->qualifications)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 font-1 text-dark">Education & Background</h5>
                            <div class="text-muted-color fs-6 bg-light p-3 rounded-4 border-start border-primary border-4">
                                {!! nl2br(e($team->qualifications)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Booking Section -->
                    <div class="booking-cta-card p-5 rounded-5 shadow-lg border-0 mt-5 overflow-hidden position-relative"
                        style="background: linear-gradient(135deg, var(--primary-color), #0a5fa0);">



                        <div class="position-relative" style="z-index: 2;">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <h3 class="font-1 fw-bold text-white mb-3">Begin Your Wellness Journey</h3>
                                    <p class="text-white-50 mb-4 fs-5 fw-medium">
                                        Connect with {{ $team->name }} today for personalized compassionate care.
                                    </p>
                                    <a href="{{ route('com.therapist.booking', $team->id) }}"
                                        class="btn btn-secondary-solid btn-lg px-5 py-3 fw-bold rounded-pill shadow transition-hover">
                                        Book Appointment Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="reviews-section" class="section py-5 bg-gradient-secondary">
        <div class="b-container">
            <div class="row g-5">
                <!-- Display Reviews -->
                <div class="{{ auth()->check() ? 'col-lg-7' : 'col-lg-12' }}" data-aos="fade-right">
                    <h3 class="font-1 fw-bold mb-4 text-white {{ auth()->check() ? '' : 'text-center' }}">Patient Reviews</h3>
                    @if($reviews->count() > 0)
                        <div class="reviews-list {{ auth()->check() ? '' : 'd-flex flex-wrap gap-4 justify-content-center' }}">
                            @foreach($reviews as $review)
                                <div
                                    class="card border-0 shadow-lg rounded-4 p-4 mb-4 bg-white transition-hover position-relative overflow-hidden {{ auth()->check() ? '' : 'flex-grow-1' }}"
                                    style="{{ auth()->check() ? '' : 'min-width: 300px; max-width: 450px;' }}">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="fw-bold mb-0 text-primary-color">
                                                {{ $review->is_anonymous ? 'Verified Patient' : $review->name }}
                                            </h5>
                                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div class="bg-warning-subtle px-3 py-1 rounded-pill">
                                            <div class="text-warning small">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted-color mb-0 fs-6 lh-base italic">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="text-center py-5 bg-white bg-opacity-10 rounded-5 border border-white border-opacity-25 shadow-sm">
                            <i class="bi bi-chat-dots-fill fs-1 text-white opacity-50 mb-3 d-block"></i>
                            <p class="text-white mb-0 fs-5">No reviews yet. Be the first to share your experience!</p>
                            {{-- @guest
                                <div class="mt-4">
                                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold">Login to be the first</a>
                                </div>
                            @endguest --}}
                        </div>
                    @endif
                </div>

                @auth
                    <!-- Add Review Form -->
                    <div class="col-lg-5" data-aos="fade-left">
                        <div class="card border-0 shadow-lg rounded-5 p-5 bg-white sticky-top" style="top: 120px; z-index: 1;">
                            <div class="text-center mb-4">
                                <i class="bi bi-pencil-square text-primary-color display-6 mb-2 d-block"></i>
                                <h4 class="font-1 fw-bold mb-0">Share Your Experience</h4>
                                <p class="small text-muted">Your feedback helps others find the right support.</p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('review.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="team_id" value="{{ $team->id }}">

                                <div class="mb-4 text-center">
                                    <label class="form-label fw-bold d-block mb-3">Rate Your Session</label>
                                    <div class="rating-stars d-flex justify-content-center gap-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="d-none" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{ $i }}"
                                                class="cursor-pointer text-warning fs-2 rating-star-label transition-all"
                                                data-value="{{ $i }}">
                                                <i class="bi bi-star{{ $i <= 5 ? '-fill' : '' }}"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 text-start">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" id="name"
                                                class="form-control rounded-4 border-0 bg-light px-4" required
                                                placeholder="Full Name" value="{{ auth()->user()->name }}">
                                            <label for="name" class="ps-4">Full Name</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-start">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" id="email"
                                                class="form-control rounded-4 border-0 bg-light px-4" required
                                                placeholder="Email Address" value="{{ auth()->user()->email }}" readonly>
                                            <label for="email" class="ps-4">Email Address</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-start">
                                        <div class="form-floating mb-3">
                                            <textarea name="comment" id="comment"
                                                class="form-control rounded-4 border-0 bg-light px-4" style="height: 120px"
                                                required placeholder="Write your review here..."></textarea>
                                            <label for="comment" class="ps-4">How was your experience?</label>
                                        </div>
                                    </div>

                                    <!-- Anonymous Review Toggle -->
                                    <div class="col-12">
                                        <div
                                            class="form-check form-switch d-flex align-items-center gap-3 mb-4 bg-light p-3 rounded-4 px-5">
                                            <input class="form-check-input ms-0" type="checkbox" name="is_anonymous"
                                                id="is_anonymous" value="1" style="width: 3em; height: 1.5em; cursor: pointer;">
                                            <label class="form-check-label fw-semibold text-dark mb-0 fs-6 cursor-pointer"
                                                for="is_anonymous">
                                                Keep my review anonymous
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary-solid btn-lg w-100 rounded-pill fw-bold shadow transition-hover py-3">
                                    <i class="bi bi-send-fill me-2"></i> Submit Review
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <!-- Other Therapists Section -->
    @if($recentTeams->count() > 0)
        <section class="section py-5 bg-white border-top">
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
        // Star Rating Interaction
        const starLabels = document.querySelectorAll('.rating-star-label');
        starLabels.forEach(label => {
            label.addEventListener('click', function () {
                const value = parseInt(this.getAttribute('data-value'));
                updateStars(value);
            });

            label.addEventListener('mouseover', function () {
                const value = parseInt(this.getAttribute('data-value'));
                highlightStars(value);
            });

            label.addEventListener('mouseout', function () {
                const selectedRating = document.querySelector('input[name="rating"]:checked');
                const value = selectedRating ? parseInt(selectedRating.value) : 0;
                highlightStars(value);
            });
        });

        function updateStars(value) {
            starLabels.forEach(label => {
                const labelValue = parseInt(label.getAttribute('data-value'));
                const icon = label.querySelector('i');
                if (labelValue <= value) {
                    icon.classList.remove('bi-star');
                    icon.classList.add('bi-star-fill');
                } else {
                    icon.classList.remove('bi-star-fill');
                    icon.classList.add('bi-star');
                }
            });
        }

        function highlightStars(value) {
            starLabels.forEach(label => {
                const labelValue = parseInt(label.getAttribute('data-value'));
                const icon = label.querySelector('i');
                if (labelValue <= value) {
                    icon.classList.remove('bi-star');
                    icon.classList.add('bi-star-fill');
                } else {
                    icon.classList.remove('bi-star-fill');
                    icon.classList.add('bi-star');
                }
            });
        }

        // Initialize stars
        const initialRating = document.querySelector('input[name="rating"]:checked');
        if (initialRating) {
            updateStars(parseInt(initialRating.value));
        }
    </script>
@endpush