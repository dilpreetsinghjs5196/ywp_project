@extends('site.com.layouts.app')

@section('title', 'Therapists for ' . $service->title)

@section('content')
    <!-- Banner Section -->
    <section class="section position-relative"
        style="background-image: url('{{ asset('image/footer-img.jpg') }}'); height: 40vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
            <div
                class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
                <h1 class="display-3 mb-0" style="font-weight: 900;">{{ $service->title }}</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Homepage</a>
                        </li>
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.services') }}">Services</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Our Specialists
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- #banner end -->

    <!-- Team Section -->
    <section class="section py-5">
        <div class="b-container">
            <div class="row text-center mb-5" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200"
                data-aos-duration="1000">
                <div class="col-lg-8 mx-auto">
                    <h6 class="text-primary-color fw-semibold mb-2">SERVICE SPECIALISTS</h6>
                    <h2 class="font-1 mb-4" style="font-weight: 800;">
                        Meet Our Experts specializing in {{ $service->title }}
                    </h2>
                    <p class="text-muted-color" style="font-size: large;">
                        These dedicated professionals are specifically trained and experienced in providing
                        {{ strtolower($service->title) }} to help you achieve your mental health goals.
                    </p>
                </div>
            </div>

            <!-- Team Members Grid -->
            <div class="row g-4">
                @forelse($teams as $member)
                    <div class="col-12 col-lg-6 mb-4" data-aos="fade-up" data-aos-easing="linear"
                        data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
                        <div
                            class="therapist-brief-card h-100 bg-white rounded-4 shadow-sm border overflow-hidden d-flex flex-column flex-md-row">
                            <!-- Image Section -->
                            <div class="therapist-image-box position-relative">
                                <img src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                                    alt="{{ $member->name }}" class="w-100 h-100" style="object-fit: cover;">
                                @if($member->is_active)
                                    <span
                                        class="position-absolute top-0 start-0 m-3 badge bg-success rounded-pill px-3 shadow-sm">Available</span>
                                @endif
                            </div>

                            <!-- Content Section -->
                            <div class="therapist-details-box p-4 flex-grow-1 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h4 class="font-1 fw-bold mb-1 text-dark">{{ $member->name }}</h4>
                                        <p class="text-muted mb-0 fw-medium">{{ $member->designation ?? 'Therapist' }}</p>
                                    </div>
                                </div>

                                <!-- Expertise Tags -->
                                @php
                                    $specialties = $member->specialties ? explode(',', $member->specialties) : ($member->specialization ? explode(',', $member->specialization) : []);
                                @endphp
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @foreach(array_slice($specialties, 0, 3) as $spec)
                                        <span class="expertise-tag">{{ trim($spec) }}</span>
                                    @endforeach
                                    @if(count($specialties) > 3)
                                        <span class="expertise-tag text-muted">+{{ count($specialties) - 3 }} more</span>
                                    @endif
                                </div>

                                <!-- Info List -->
                                <div class="info-list mb-2">
                                    @if($member->services->count() > 0)
                                        <div class="info-item d-flex align-items-center mb-1">
                                            <i class="bi bi-patch-check text-primary-color me-2"></i>
                                            <span class="text-muted small">Services: <span class="text-dark fw-medium">{{ $member->services->pluck('title')->implode(', ') }}</span></span>
                                        </div>
                                    @endif
                                    @if($member->languages)
                                        <div class="info-item d-flex align-items-center mb-1">
                                            <i class="bi bi-translate text-primary-color me-2"></i>
                                            <span class="text-muted small">Speaks: <span
                                                    class="text-dark fw-medium">{{ $member->languages }}</span></span>
                                        </div>
                                    @endif
                                    @if($member->mode)
                                        <div class="info-item d-flex align-items-center mb-1">
                                            <i class="bi bi-geo-alt text-primary-color me-2"></i>
                                            <span class="text-muted small">Mode: <span
                                                    class="text-dark fw-medium">{{ $member->mode }}</span></span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Section -->
                                <div class="mt-auto pt-3 border-top d-flex gap-3">
                                    <a href="{{ route('com.team.single', $member->id) }}"
                                        class="btn btn-view-profile rounded-pill px-3 fw-bold py-3 text-decoration-none text-center text-nowrap">VIEW
                                        PROFILE</a>
                                    <a href="{{ route('com.therapist.booking', $member->id) }}"
                                        class="btn btn-book-now rounded-pill px-4 fw-bold py-3 text-white text-decoration-none text-center text-nowrap">BOOK
                                        NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted-color fs-5">No therapists currently assigned to this service.</p>
                        <a href="{{ route('com.services') }}" class="btn btn-primary-solid mt-3">View All Services</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Section -->
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $teams->links() }}
                </div>
            </div>
        </div>
    </section>

    <style>
        .therapist-brief-card {
            transition: all 0.3s ease;
            border: 1px solid #eee !important;
        }

        .therapist-brief-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color) !important;
        }

        .therapist-image-box {
            width: 100%;
            aspect-ratio: 1/1;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .therapist-image-box {
                width: 250px;
                height: 250px;
                flex-shrink: 0;
            }
        }

        .therapist-details-box {
            padding: 1.5rem !important;
        }

        .expertise-tag {
            background-color: #f0f7ff;
            color: #007bff;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid #e0efff;
        }

        .btn-view-profile {
            color: #333;
            border: 1px solid #ddd;
            background: #fff;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
        }

        .btn-view-profile:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            color: #000 !important;
        }

        .btn-book-now {
            background-color: var(--primary-color);
            border: 1px solid var(--primary-color);
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-book-now:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection