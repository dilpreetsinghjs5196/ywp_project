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
            <div class="row g-5">
                @forelse($teams as $member)
                    <div class="col-12 col-sm-6 col-xl-3 mb-5" data-aos="fade-up" data-aos-easing="linear"
                        data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
                        <div class="position-relative rounded-5 transition-hover mx-auto img-container h-100"
                            style="max-width: 100%;">
                            <div class="ratio-wrapper-419">
                                <a href="{{ route('com.team.single', $member->id) }}">
                                    <img src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                                        alt="{{ $member->name }}" class="rounded-5 w-100 h-100 position-absolute"
                                        style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="position-absolute start-50 translate-middle-x" style="width: 95%; bottom: -3rem;">
                                <div
                                    class="bg-primary-color d-flex flex-column text-white py-2 px-1 align-items-center text-center rounded-5 shadow-lg">
                                    <div class="mb-1">
                                        <a href="{{ route('com.team.single', $member->id) }}"
                                            class="text-white text-decoration-none">
                                            <h5 class="font-1 fw-bolder mb-0" style="font-size: 1.1rem;">{{ $member->name }}
                                            </h5>
                                        </a>
                                        <p class="mb-2 fw-semibold" style="font-size: 0.85rem;">{{ $member->designation }}</p>
                                    </div>
                                    <div class="social-box justify-content-center mb-1 d-flex gap-2">
                                        @if($member->facebook)
                                            <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer"
                                                class="d-flex align-items-center justify-content-center text-decoration-none"
                                                style="width: 24px; height: 24px;" title="Facebook"><i
                                                    class="bi bi-facebook text-white fs-6"></i></a>
                                        @endif
                                        @if($member->twitter)
                                            <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer"
                                                class="d-flex align-items-center justify-content-center text-decoration-none"
                                                style="width: 24px; height: 24px;" title="Twitter"><i
                                                    class="bi bi-twitter-x text-white fs-6"></i></a>
                                        @endif
                                        @if($member->instagram)
                                            <a href="{{ $member->instagram }}" target="_blank" rel="noopener noreferrer"
                                                class="d-flex align-items-center justify-content-center text-decoration-none"
                                                style="width: 24px; height: 24px;" title="Instagram"><i
                                                    class="bi bi-instagram text-white fs-6"></i></a>
                                        @endif
                                        @if($member->linkedin)
                                            <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer"
                                                class="d-flex align-items-center justify-content-center text-decoration-none"
                                                style="width: 24px; height: 24px;" title="LinkedIn"><i
                                                    class="bi bi-linkedin text-white fs-6"></i></a>
                                        @endif
                                    </div>
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
        </div>
    </section>
    <!-- #team end -->

@endsection