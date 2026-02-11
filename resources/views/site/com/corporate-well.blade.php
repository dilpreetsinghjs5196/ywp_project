@extends('site.com.layouts.app')

@section('title', 'Corporate Well Being')

@section('content')
    @php
        $heroTitle = $contents['hero']['title'] ?? 'Healthy employees are a key to <span class="text-secondary-color">Success</span>';
        $heroDesc = $contents['hero']['description'] ?? 'We provide organisations with an easy access to therapy sessions, webinars, self-care tools, a community and an end to end professional support. Thus, taking care of people who take care of your business.';
        $heroImage = $contents['hero']['image'] ?? 'image/about1.jpg';
        $heroImageUrl = Str::startsWith($heroImage, 'image/') ? asset($heroImage) : asset('storage/' . $heroImage);

        $bgImage = $contents['hero']['bg_image'] ?? 'image/Homehero.png';
        $bgImageUrl = Str::startsWith($bgImage, 'image/') ? asset($bgImage) : asset('storage/' . $bgImage);
    @endphp

    <!-- Banner Section -->
    @php
        $bannerBg = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bannerBgUrl = Str::startsWith($bannerBg, 'image/') ? asset($bannerBg) : asset('storage/' . $bannerBg);
        $bannerTitle = $contents['banner']['banner_title'] ?? 'Corporate Well-Being';
    @endphp
    <section class="section position-relative"
        style="background: url('{{ $bannerBgUrl }}'); background-size: cover; background-position: center; height: 50vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative text-white" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center">
                <h1 class="display-1 mb-3" style="font-weight: 900; letter-spacing: -1px;">{{ $bannerTitle }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-center align-items-center"
                        style="font-weight: 700; font-size: 1.1rem;">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-white opacity-75"
                                href="{{ route('com.home') }}">Home</a></li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">{{ $bannerTitle }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: "/" !important;
            color: rgba(255, 255, 255, 0.7) !important;
            padding-inline: 10px;
        }
    </style>
    <!-- #banner end -->

    <!-- Corporate Hero Section -->
    <section class="section d-flex align-items-center"
        style="min-height: 80vh; background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('{{ $bgImageUrl }}'); background-size: cover; background-position: center;">
        <div class="b-container">
            <div class="row align-items-center g-5">
                <!-- Text Content -->
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                    <h1 class="display-md-4 lh-sm font-1 my-4" style="font-weight: 900 !important;">
                        {!! $heroTitle !!}
                    </h1>
                    <p class="fs-5 my-4">
                        {{ $heroDesc }}
                    </p>
                    <div class="d-flex flex-wrap gap-4">
                        <a href="contact-us.html" class="btn btn-modify px-5 py-3 fs-5">
                            Get In Touch
                        </a>
                        <a href="#explore" class="btn btn-outline-secondary rounded-pill px-5 py-3 fs-5 fw-bold border-2"
                            style="border-color: var(--secondary-color); color: var(--secondary-color);">
                            Scroll To Explore
                        </a>
                    </div>
                </div>

                <!-- Circular Image -->
                <div class="col-lg-5 text-center" data-aos="zoom-in" data-aos-duration="1200" data-aos-delay="400">
                    <div class="position-relative d-inline-block">
                        <div class="rounded-circle overflow-hidden shadow-lg border border-5 border-white"
                            style="width: 450px; height: 450px;">
                            <img src="{{ $heroImageUrl }}" alt="Corporate Well Being" class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- #hero end -->

    <!-- Brands That Trust Us -->

    <section class="section py-5 bg-white">
        <div class="b-container" style="padding-top:50px;">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-4 font-1 fw-bold" style="color:#1e1d1d;">
                    {{ $contents['brands']['brands_title'] ?? 'Brands That Trust Us' }}
                </h2>
            </div>

            <div class="position-relative px-md-5">
                <div class="swiper brands-slider mt-4">
                    <div class="swiper-wrapper d-flex align-items-center">
                        @php
                            // Duplicate brands if few to ensure swiper loop works correctly
                            $displayBrands = $brands->all();
                            if (count($displayBrands) > 0 && count($displayBrands) < 10) {
                                $displayBrands = array_merge($displayBrands, $displayBrands, $displayBrands);
                            }
                        @endphp
                        @foreach ($displayBrands as $brand)
                            <div class="swiper-slide text-center d-flex align-items-center justify-content-center">
                                <img src="{{ $brand->image ? (Str::startsWith($brand->image, 'image/') ? asset($brand->image) : asset('storage/' . $brand->image)) : asset('image/default-brand.jpg') }}"
                                    alt="{{ $brand->name ?? 'Brand' }}" class="img-fluid brand-logo"
                                    style="max-height: 150px; width: 350px !important; object-fit: contain; transition: all 0.3s ease;">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Navigation Arrows -->
                <!-- <div class="d-flex justify-content-center gap-4 mt-5">
                                        <div class="brands-prev-btn cursor-pointer text-dark"><i class="bi bi-chevron-left fs-3"></i></div>
                                        <div class="brands-next-btn cursor-pointer text-dark"><i class="bi bi-chevron-right fs-3"></i></div>
                                    </div> -->
            </div>
        </div>
    </section>
    <!-- #brands end -->
    <!-- Workshops Section -->
    <section class="section py-5" id="workshops" style="background: #f7fbff;">
        <div class="b-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-primary-color fw-semibold mb-2">
                    {{ $contents['workshops']['heading'] ?? 'OUR INITIATIVES' }}
                </h6>
                <h2 class="display-4 font-1 fw-bold" style="color:#1e1d1d;">
                    {{ $contents['workshops']['title'] ?? 'Our Workshops & Initiatives' }}
                </h2>
                <div class="mx-auto bg-primary-color mt-3" style="height: 4px; width: 80px; border-radius: 2px;"></div>
            </div>

            @for ($i = 1; $i <= 8; $i++)
                @php
                    $wTitle = $contents['workshops']["workshop_{$i}_title"] ?? null;
                    $wDesc = $contents['workshops']["workshop_{$i}_description"] ?? null;
                    $wImage1 = $contents['workshops']["workshop_{$i}_image_1"] ?? null;
                    $wImage2 = $contents['workshops']["workshop_{$i}_image_2"] ?? null;
                    $wIcon = $contents['workshops']["workshop_{$i}_icon"] ?? 'bi-star-fill';
                    
                    $wImg1Url = $wImage1 ? (Str::startsWith($wImage1, 'image/') ? asset($wImage1) : asset('storage/' . $wImage1)) : asset('image/Place-Holder-600x900.jpg');
                    $wImg2Url = $wImage2 ? (Str::startsWith($wImage2, 'image/') ? asset($wImage2) : asset('storage/' . $wImage2)) : null;
                    
                    $isEven = $i % 2 == 0;
                @endphp

                @if ($wTitle)
                    <div class="workshop-block mb-5 py-4" data-aos="{{ $isEven ? 'fade-left' : 'fade-right' }}" data-aos-duration="1000">
                        <div class="row align-items-center g-5 {{ $isEven ? 'flex-row-reverse' : '' }}">
                            <!-- Text Column -->
                            <div class="col-lg-6">
                                <div class="workshop-info p-3">
                                    <div class="d-flex align-items-center mb-4 workshop-header">
                                        <div class="workshop-icon-box bg-primary-color text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm">
                                            <i class="bi {{ $wIcon }} fs-3"></i>
                                        </div>
                                        <h3 class="workshop-heading display-6 font-1 fw-bold mb-0 transition-all text-primary-color">
                                            {{ $wTitle }}
                                        </h3>
                                    </div>
                                    <p class="fs-5 text-muted-color lh-base mb-4 journal-text">
                                        {{ $wDesc }}
                                    </p>
                                </div>
                            </div>
                            <!-- Image Column -->
                            <div class="col-lg-6">
                                <div class="workshop-gallery position-relative p-2">
                                    <div class="workshop-main-img-container rounded-5 overflow-hidden shadow-lg border border-5 border-white">
                                        <img src="{{ $wImg1Url }}" alt="{{ $wTitle }}" class="img-fluid w-100 object-fit-cover workshop-main-img">
                                    </div>
                                    @if($wImg2Url)
                                        <div class="workshop-sub-img-container position-absolute rounded-4 overflow-hidden shadow border border-4 border-white d-none d-md-block" 
                                             style="width: 220px; height: 160px; bottom: -20px; {{ $isEven ? 'left: -30px;' : 'right: -30px;' }} z-index: 5;">
                                            <img src="{{ $wImg2Url }}" alt="{{ $wTitle }} detail" class="w-100 h-100 object-fit-cover">
                                        </div>
                                    @endif
                                    <!-- Decorative Circle -->
                                    <div class="decor-circle d-none d-lg-block" 
                                         style="width: 350px; height: 350px; top: -70px; {{ $isEven ? 'right: -120px;' : 'left: -120px;' }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </section>

    <style>
        .workshop-block {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }
        .workshop-block:last-child {
            border-bottom: none;
        }

        .workshop-info {
            position: relative;
            z-index: 2;
        }

        .workshop-icon-box {
            width: 60px;
            height: 60px;
            min-width: 60px;
            transition: all 0.5s ease;
            flex-shrink: 0;
        }

        .workshop-heading {
            cursor: pointer;
            position: relative;
            display: inline-block;
            word-wrap: break-word;
        }

        .workshop-heading::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background-color: var(--secondary-color);
            transition: width 0.4s ease;
        }

        .workshop-header:hover .workshop-heading {
            color: var(--secondary-color) !important;
            transform: translateX(10px);
        }

        .workshop-header:hover .workshop-heading::after {
            width: 100%;
        }

        .workshop-header:hover .workshop-icon-box {
            transform: scale(1.1) rotate(15deg);
            background-color: var(--secondary-color) !important;
        }

        .workshop-gallery {
            position: relative;
            z-index: 1;
        }

        .workshop-main-img-container {
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            z-index: 2;
        }

        .workshop-gallery:hover .workshop-main-img-container {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .workshop-main-img {
            height: 450px;
            transition: all 1s ease;
        }

        .journal-text {
            text-align: justify;
            opacity: 0.85;
            line-height: 1.6;
        }

        /* Decorative circle fix */
        .decor-circle {
            position: absolute;
            border-radius: 50%;
            background-color: var(--primary-color);
            opacity: 0.05; /* Reduced opacity significantly */
            z-index: 0;
            pointer-events: none;
        }

        @media (max-width: 991px) {
            .workshop-main-img {
                height: 350px;
            }
            .workshop-block {
                text-align: center;
                padding-bottom: 3rem !important;
            }
            .workshop-header {
                flex-direction: column;
                justify-content: center;
                text-align: center;
            }
            .workshop-icon-box {
                margin-right: 0 !important;
                margin-bottom: 1rem;
            }
            .workshop-features {
                justify-content: center;
            }
            .workshop-sub-img-container {
                display: none !important;
            }
        }
    </style>

    <!-- Feedback Section -->
    <section class="section py-5 bg-gray-light">
        <div class="b-container" style="padding-top: 50px;">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 text-center text-lg-start">
                    <h6 class="text-primary-color fw-semibold mb-2">
                        {{ $contents['testimonials']['small_heading'] ?? 'CLIENT FEEDBACKS' }}
                    </h6>
                    <h2 class="font-1" style="font-weight: 800;">
                        {{ $contents['testimonials']['title'] ?? 'Healing Begins with a Conversation' }}
                    </h2>
                </div>
                <div class="col-12 col-lg-5 text-center text-lg-start mt-4 mt-md-0">
                    <p class="my-4 text-muted-color" style="font-size: large;">
                        {{ $contents['testimonials']['description'] ?? '"Healing is support—not just a process. Our team walks with you every step of the way."' }}
                    </p>
                </div>
            </div>

            <div class="position-relative px-md-5">
                <div class="swiper testimonials-slider mt-4" style="overflow: hidden; padding-bottom: 50px;">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $item)
                            <div class="swiper-slide mt-4">
                                <div class="card feedback-card h-100">
                                    <div class="d-flex align-content-center mb-3">
                                        <div class="mb-2 text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="fw-bold">"{{ $item->feedback }}"</p>
                                    <div class="d-flex align-items-center mt-auto pt-3">
                                        <img src="{{ $item->client_image ? (Str::startsWith($item->client_image, 'image/') ? asset($item->client_image) : asset('storage/' . $item->client_image)) : asset('image/default-user.jpg') }}"
                                            alt="{{ $item->client_name }}" class="rounded-circle me-3"
                                            style="width: 64px; height: 64px; object-fit: cover;">
                                        <div class="mt-2">
                                            <h5 class="font-1 fw-bold text-primary-color mb-0">{{ $item->client_name }}</h5>
                                            <p class="text-muted-color mb-0">{{ $item->designation }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination mt-4 position-relative"></div>
                </div>
                <!-- Navigation Arrows -->
                <div class="swiper-button-next text-primary-color"></div>
                <div class="swiper-button-prev text-primary-color"></div>
            </div>
        </div>
    </section>
    <!-- #feedback end -->

    <!-- Appointment Section -->
    <section class="section py-5 text-white bg-gradient-secondary">
        <div class="b-container">
            <div class="row align-items-center g-4 pt-5">
                <!-- Left content -->
                <div class="col-12 col-xl-5 order-1 order-md-3 order-xl-1 text-white mt-5 text-center text-xl-start">
                    <p class="text-uppercase text-primary-color fs-5 fw-semibold mb-2">
                        {{ $contents['appointment']['small_heading'] ?? 'Why Choose Us ?' }}
                    </p>
                    <h2 class="font-1 display-5 mb-4" style="font-weight: 800;">
                        {!! str_replace(['Minds', 'Organization'], ['<span class="text-primary-color">Minds</span>', '<span class="text-primary-color">Organization</span>'], $contents['appointment']['title'] ?? 'Empowering Minds, One Organization At A Time') !!}
                    </h2>
                    <p class="mb-4" style="font-size: large;">
                        {{ $contents['appointment']['description'] ?? 'Through consistent care and compassionate guidance...' }}
                    </p>
                    <ul class="list-unstyled font-1 text-center text-xl-start">
                        <li class="d-flex flex-row justify-content-center justify-content-xl-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary-color fs-4 mb-2 mb-xl-0 me-2"></i>
                            <h5 class="fw-bolder py-1">
                                {{ $contents['appointment']['list_item_1'] ?? 'Compassionate & Experienced Professionals' }}
                            </h5>
                        </li>
                        <li class="d-flex flex-row justify-content-center justify-content-xl-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary-color fs-4 mb-2 mb-xl-0 me-2"></i>
                            <h5 class="fw-bolder py-1">
                                {{ $contents['appointment']['list_item_2'] ?? 'Holistic Approach To Well-Being' }}
                            </h5>
                        </li>
                        <li class="d-flex flex-row justify-content-center justify-content-xl-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary-color fs-4 mb-2 mb-xl-0 me-2"></i>
                            <h5 class="fw-bolder py-1">
                                {{ $contents['appointment']['list_item_3'] ?? 'Safe & Supportive Environment' }}
                            </h5>
                        </li>
                    </ul>
                    <a href="{{ route('com.home') }}" class="btn btn-primary-solid mb-5">Make An Appointment</a>
                </div>

                <!-- Middle content -->
                <div class="col-12 col-md-7 col-xl-5 order-2 order-md-1">
                    <div class="ratio ratio-1x1">
                        @php
                            $chooseImagePath = $contents['appointment']['main_image'] ?? 'image/choose.jpg';
                            $chooseImageUrl = Str::startsWith($chooseImagePath, 'image/') ? asset($chooseImagePath) : asset('storage/' . $chooseImagePath);
                        @endphp
                        <img src="{{ $chooseImageUrl }}" class="w-100 h-100 object-fit-cover position-absolute rounded-5"
                            alt="Appointment" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="750"
                            data-aos-duration="1000">
                    </div>
                </div>
                <!-- Right content -->
                <div class="col-12 col-md-5 col-xl-2 d-flex flex-column gap-3 order-3 order-md-2 order-xl-3">
                    <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
                        data-aos-delay="500" data-aos-duration="1000">
                        <div class="card-body text-center text-white p-3 font-1">
                            <div class="display-5"><i class="bi bi-emoji-smile-fill accent-secondary-color"></i></div>
                            <div class="mb-0 fs-2 fw-bold text-white">
                                {{ $contents['appointment']['stat_1_number'] ?? '100%' }}
                            </div>
                            <p class="mb-0">{{ $contents['appointment']['stat_1_text'] ?? 'Satisfaction' }}</p>
                        </div>
                    </div>
                    <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
                        data-aos-delay="750" data-aos-duration="1000">
                        <div class="card-body text-center text-white p-3 font-1">
                            <div class="display-5"><i class="bi bi-hand-thumbs-up-fill accent-secondary-color"></i></div>
                            <div class="mb-0 fs-2 fw-bold text-white">
                                {{ $contents['appointment']['stat_2_number'] ?? '257+' }}
                            </div>
                            <p class="mb-0">{{ $contents['appointment']['stat_2_text'] ?? 'Happy Patient' }}</p>
                        </div>
                    </div>
                    <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
                        data-aos-delay="1000" data-aos-duration="1000">
                        <div class="card-body text-center text-white p-3 font-1">
                            <div class="display-5"><i class="bi bi-person-plus-fill accent-secondary-color"></i></div>
                            <div class="mb-0 fs-2 fw-bold text-white">
                                {{ $contents['appointment']['stat_3_number'] ?? '10+' }}
                            </div>
                            <p class="mb-0">{{ $contents['appointment']['stat_3_text'] ?? 'Expert Therapist' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- #appointment end -->

    <!-- Teams Section -->
    <section class="section py-5 bg-half-gradient">
        <div class="b-container" style="padding-top: 50px;">
            <div class="row text-center" data-aos="fade-up" data-aos-duration="1000">
                <h6 class="text-primary-color fw-semibold mb-2">
                    {{ $contents['teams']['small_heading'] ?? 'OUR SPECIALIST' }}
                </h6>
                <h2 class="font-1 mb-5" style="font-weight: 800;">
                    {!! nl2br($contents['teams']['title'] ?? 'Meet Our Senior<br>Therapist') !!}
                </h2>
            </div>
            <div class="position-relative px-md-5">
                <div class="swiper teams-slider" style="overflow: hidden; padding-bottom: 50px;">
                    <div class="swiper-wrapper">
                        @foreach ($teams as $member)
                            <div class="swiper-slide mb-5" data-aos="fade-up" data-aos-easing="linear"
                                data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
                                <div class="position-relative rounded-5 transition-hover mx-auto img-container"
                                    style="max-width: 350px;">
                                    <div class="ratio-wrapper-419">
                                        <img src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                                            alt="{{ $member->name }}" class="rounded-5 w-100 h-100 position-absolute"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="position-absolute w-75" style="bottom: -20px; left: 12.5%; z-index: 10;">
                                        <div
                                            class="bg-primary-color d-flex flex-column text-white py-3 align-items-center text-center rounded-5 shadow">
                                            <div class="mb-2">
                                                <h4 class="font-1 fw-bolder mb-0 fs-5 px-2">{{ $member->name }}</h4>
                                                <p class="mb-0 small opacity-75">{{ $member->designation }}</p>
                                            </div>
                                            <div class="social-box justify-content-center mb-2">
                                                @if ($member->facebook)
                                                    <a href="{{ $member->facebook }}" class="fs-6 rounded-1 py-1"
                                                        style="width: 30px; height: 30px;"><i
                                                            class="bi bi-facebook text-white"></i></a>
                                                @endif
                                                @if ($member->twitter)
                                                    <a href="{{ $member->twitter }}" class="fs-6 rounded-1 py-1"
                                                        style="width: 30px; height: 30px;"><i
                                                            class="bi bi-twitter-x text-white"></i></a>
                                                @endif
                                                @if ($member->instagram)
                                                    <a href="{{ $member->instagram }}" class="fs-6 rounded-1 py-1"
                                                        style="width: 30px; height: 30px;"><i
                                                            class="bi bi-instagram text-white"></i></a>
                                                @endif
                                                @if ($member->linkedin)
                                                    <a href="{{ $member->linkedin }}" class="fs-6 rounded-1 py-1"
                                                        style="width: 30px; height: 30px;"><i
                                                            class="bi bi-linkedin text-white"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination mt-4 position-relative"></div>
                </div>
                <!-- Navigation Arrows -->
                <div class="swiper-button-next text-primary-color"></div>
                <div class="swiper-button-prev text-primary-color"></div>
            </div>
        </div>
    </section>
    <!-- #teams end -->

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Testimonials Slider
            new Swiper('.testimonials-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.testimonials-slider .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.testimonials-slider + .swiper-button-next',
                    prevEl: '.testimonials-slider + .swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });

            // Teams Slider
            new Swiper('.teams-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.teams-slider .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.teams-slider + .swiper-button-next',
                    prevEl: '.teams-slider + .swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });

            // Brands Slider
            new Swiper('.brands-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.brands-next-btn',
                    prevEl: '.brands-prev-btn',
                },
                observer: true,
                observeParents: true,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 5,
                    }
                }
            });
        });
    </script>
@endpush