@extends('site.com.layouts.app')

@section('title', 'Home')

@section('content')

  <!-- Hero Section -->
  @php
    // If no slides, create a default one from database content or static values
    if ($heroSlides->isEmpty()) {
      $defaultSlide = new \App\Models\HomeHeroSlide();
      $defaultSlide->image = $contents['hero']['hero_bg_image'] ?? 'image/Homehero.png';
      $defaultSlide->title = $contents['hero']['main_title'] ?? 'Caring for Your Inner Peace';
      $defaultSlide->subtitle = $contents['hero']['subtitle'] ?? 'Discover clarity, confidence, and emotional wellness through guided support.';
      $defaultSlide->button_text = 'Start A Checkup Now';
      $defaultSlide->button_link = route('com.team');
      $heroSlides = collect([$defaultSlide]);
    }
  @endphp

  <section class="hero-carousel-wrapper">
    <div class="swiper-container hero-slider" style="overflow: hidden;">
      <div class="swiper-wrapper">
        @foreach($heroSlides as $slide)
          <div class="swiper-slide d-flex align-items-center py-5"
            style="background: url('{{ Str::startsWith($slide->image, 'image/') ? asset($slide->image) : asset('storage/' . $slide->image) }}'); background-size: cover; background-position: center; min-height: 80vh; position: relative;">

            <!-- Subtle Overlay for readability -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.15);"></div>

            <div class="b-container px-3 px-sm-4 px-md-0 w-100 position-relative z-1">
              <div class="row justify-content-center text-white">
                <div class="col-12 col-lg-10 col-xl-9 text-center d-flex flex-column align-items-center" data-aos="fade-up"
                  data-aos-duration="1200">

                  {{-- <h6
                    class="text-primary-color fw-bold mb-3 tracking-widest text-uppercase py-2 px-3 rounded-2 shadow-sm"
                    style="background: rgba(255,255,255,0.9); font-size: 0.85rem;">
                    {{ $contents['hero']['small_heading'] ?? 'Find Balance, Embrace Life' }}
                  </h6> --}}

                  @if($slide->title)
                    <h1 class="display-2 lh-sm font-1 mb-4"
                      style="font-weight: 850; text-shadow: 2px 2px 15px rgba(0,0,0,0.2);">
                      {!! str_replace('Inner', '<span class="text-primary-color">Inner</span>', $slide->title) !!}
                    </h1>
                    <div class="bg-white opacity-75 my-3" style="height: 3px; width: 100px; border-radius: 2px;"></div>
                  @endif

                  @if($slide->subtitle)
                    <p class="fs-4 my-4 opacity-100 mx-auto fw-medium" style="max-width: 800px; line-height: 1.4;">
                      {{ $slide->subtitle }}
                    </p>
                  @endif

                  @if($slide->button_text)
                    <div class="d-flex gap-3 align-items-center mt-4">
                      <a href="{{ $slide->button_link ?? '#' }}" role="button"
                        class="btn btn-primary-solid px-5 py-3 shadow-lg scale-hover">
                        {{ $slide->button_text }}
                      </a>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if($heroSlides->count() > 1)
        <!-- Pagination -->
        <div class="swiper-pagination hero-pagination"></div>
        <!-- Navigation -->
        <div class="swiper-button-next hero-next text-white d-none d-md-flex"></div>
        <div class="swiper-button-prev hero-prev text-white d-none d-md-flex"></div>
      @endif
    </div>
  </section>
  <!-- #hero end -->


  <!-- About Section -->
  <section class=" section pb-5 my-5">
    <div class="b-container">
      <div class="row row-cols-1 row-cols-xl-2 g-5 align-items-center justify-content-center text-center text-xl-start">
        <!-- Left Content Side -->
        <div class="col position-relative d-flex justify-content-center">
          <div class="position-relative img-container px-0 px-lg-5">
            @php
              $about1Path = $contents['about_us']['about_image_1'] ?? 'image/about2.jpg';
              $about1Url = Str::startsWith($about1Path, 'image/') ? asset($about1Path) : asset('storage/' . $about1Path);

              $about2Path = $contents['about_us']['about_image_2'] ?? 'image/about1.jpg';
              $about2Url = Str::startsWith($about2Path, 'image/') ? asset($about2Path) : asset('storage/' . $about2Path);
            @endphp
            <!-- Primary Image -->
            <div class="ratio-wrapper-429">
              <img src="{{ $about1Url }}" alt="About Us"
                class="w-100 h-100 object-position-center position-absolute top-0 start-0 rounded-5" data-aos="fade-up"
                data-aos-easing="linear" data-aos-delay="500" data-aos-duration="1000">
            </div>
            <!-- Experience Label -->
            <div
              class="position-absolute bottom-0 end-0 bg-secondary-color text-white px-4 py-2 rounded-4 m-3 fw-bold small z-1 text-center"
              data-aos="fade-down" data-aos-easing="linear" data-aos-delay="500" data-aos-duration="1000">
              <span class="font-1 fs-2 fw-bold count-up"
                data-count="{{ (int) ($contents['about_us']['experience_years'] ?? 10) }}"
                data-suffix="+ Years">0</span><br>
              <span class="fs-5">Of Experience</span>
            </div>
            <!-- Circle Image -->
            <div class="position-absolute" style="top: -60px; left: 0; transform: translateX(-11%); z-index: 3;">
              <div class="img-circle rounded-circle overflow-hidden border border-4 border-white shadow"
                data-aos="fade-right" data-aos-easing="linear" data-aos-delay="500" data-aos-duration="1000">
                <img src="{{ $about2Url }}" alt="About Us Detail" class="w-100 h-100">
              </div>
            </div>
          </div>
        </div>
        <!-- Right Content Side -->
        <div class="col">
          <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['about_us']['small_heading'] ?? 'ABOUT US' }}</h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            {{ $contents['about_us']['title'] ?? 'Your Journey To Mental Wellness Starts Here' }}
          </h2>
          <p class="text-secondary" style="font-size: large;">
            {{ $contents['about_us']['description'] ?? 'Every small step toward better mental health is a significant achievement in our lives.' }}
          </p>

          <div class="d-flex justify-content-center justify-content-xl-start my-4">
            <ul class="list-unstyled font-1 mb-0 row row-cols-2 row-cols-md-2 g-3 g-md-4 text-start w-100"
              style="max-width: 500px;">
              <li class="col d-flex align-items-start fw-bolder">
                <div class="d-flex align-items-center" style="height: 1.7rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0"
                  style="font-size: 1.1rem; line-height: 1.4;">{{ $contents['about_us']['list_item_1'] ?? 'Free Consultation' }}</span>
              </li>
              <li class="col d-flex align-items-start fw-bolder">
                <div class="d-flex align-items-center" style="height: 1.7rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0"
                  style="font-size: 1.1rem; line-height: 1.4;">{{ $contents['about_us']['list_item_3'] ?? 'Mental Satisfaction' }}</span>
              </li>
              <li class="col d-flex align-items-start fw-bolder">
                <div class="d-flex align-items-center" style="height: 1.7rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0"
                  style="font-size: 1.1rem; line-height: 1.4;">{{ $contents['about_us']['list_item_2'] ?? 'Emergency Service' }}</span>
              </li>
              <li class="col d-flex align-items-start fw-bolder">
                <div class="d-flex align-items-center" style="height: 1.7rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0"
                  style="font-size: 1.1rem; line-height: 1.4;">{{ $contents['about_us']['list_item_4'] ?? 'Psychologists Services' }}</span>
              </li>
            </ul>
          </div>

          <p class="fst-italic fw-bold mb-4" style="font-size: large;">
            {{ $contents['about_us']['quote'] ?? 'Healing doesn’t mean the damage never existed; it means the strength to rise is greater than the pain' }}
          </p>

          <div class="d-flex align-items-center justify-content-center justify-content-xl-start gap-3">
            @php
              $signaturePath = $contents['about_us']['signature_image'] ?? 'image/Signature.png';
              $signatureUrl = Str::startsWith($signaturePath, 'image/') ? asset($signaturePath) : asset('storage/' . $signaturePath);
            @endphp
            <img src="{{ $signatureUrl }}" alt="Signature" style="height: 100px;">
            <a href="" class="btn btn-primary-solid">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- #about end -->

   <style>
    .therapist-info-box {
      bottom: 4%;
      left: 50%;
      transform: translateX(-50%);
      width: 85%;
      z-index: 5;
    }

    .therapist-info-inner {
      background-color: #044A80 !important;
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(5px);
    }

    @media (max-width: 576px) {
      .therapist-info-box {
        width: 92%;
        bottom: 1%;
      }

      .therapist-info-inner {
        padding: 0.5rem !important;
      }

      .therapist-name {
        font-size: 0.82rem !important;
      }

      .therapist-designation {
        font-size: 0.62rem !important;
        margin-bottom: 0.2rem !important;
      }

      .therapist-desc {
        display: none !important;
      }

      .btn-view-profile {
        font-size: 0.68rem !important;
        padding: 0.35rem 1rem !important;
        width: auto !important;
        min-width: 140px;
      }

      .social-box {
        margin-bottom: 0.25rem !important;
        gap: 0.5rem !important;
      }

      .social-icon-link {
        width: 16px !important;
        height: 16px !important;
      }

      .social-icon-link i {
        font-size: 0.5rem !important;
      }
    }
  </style>

  <!-- Teams Section -->
  <section class="section py-5 bg-half-gradient mt-5">
    <div class="b-container" style="padding-top: 50px;">
      <div class="row text-center">
        <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['teams']['small_heading'] ?? 'OUR SPECIALIST' }}</h6>
        <h2 class="font-1 mb-5" style="font-weight: 800;">
          {!! nl2br($contents['teams']['title'] ?? 'Meet Our Senior<br>Therapist') !!}
        </h2>
      </div>
      <div class="position-relative px-md-5">
        <div class="swiper-container teams-slider" style="overflow: hidden; padding-bottom: 50px;">
          <div class="swiper-wrapper">
            @foreach($teams as $member)
              <div class="swiper-slide mb-5" data-aos="fade-up" data-aos-easing="linear"
                data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
                <div class="position-relative rounded-5 transition-hover mx-auto img-container" style="max-width: 350px;">
                  <div class="ratio-wrapper-419">
                    <img
                      src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                      alt="{{ $member->name }}" class="rounded-5 w-100 h-100 position-absolute" style="object-fit: cover;">
                  </div>
                  <div class="position-absolute therapist-info-box">
                    <div
                      class="therapist-info-inner d-flex flex-column text-white p-3 align-items-center text-center rounded-5 shadow-lg">
                      <h6 class="therapist-name fw-bold mb-1 text-uppercase"
                        style="font-size: 1.1rem; line-height: 1.2 !important; letter-spacing: 0.5px;">{{ $member->name }}
                      </h6>
                      <p class="therapist-designation mb-2 opacity-75 fw-medium"
                        style="font-size: 0.75rem; line-height: 1.2;">
                        {{ $member->designation }}
                      </p>
                      @if($member->description)
                        <p class="therapist-desc mb-2 opacity-90 fw-light"
                          style="font-size: 0.75rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-style: italic;">
                          "{{ strip_tags($member->description) }}"
                        </p>
                      @endif
                      <div class="w-100 mt-auto">
                        @if($member->facebook || $member->twitter || $member->instagram || $member->linkedin)
                          <div class="social-box d-flex justify-content-center gap-2 mb-2">
                            @if($member->facebook)
                              <a href="{{ $member->facebook }}"
                                class="social-icon-link rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 20px; height: 20px; background: rgba(255,255,255,0.1);"><i
                                  class="bi bi-facebook text-white" style="font-size: 0.6rem;"></i></a>
                            @endif
                            @if($member->twitter)
                              <a href="{{ $member->twitter }}"
                                class="social-icon-link rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 20px; height: 20px; background: rgba(255,255,255,0.1);"><i
                                  class="bi bi-twitter-x text-white" style="font-size: 0.6rem;"></i></a>
                            @endif
                            @if($member->instagram)
                              <a href="{{ $member->instagram }}"
                                class="social-icon-link rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 20px; height: 20px; background: rgba(255,255,255,0.1);"><i
                                  class="bi bi-instagram text-white" style="font-size: 0.6rem;"></i></a>
                            @endif
                            @if($member->linkedin)
                              <a href="{{ $member->linkedin }}"
                                class="social-icon-link rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 20px; height: 20px; background: rgba(255,255,255,0.1);"><i
                                  class="bi bi-linkedin text-white" style="font-size: 0.6rem;"></i></a>
                            @endif
                          </div>
                        @endif
                        <a href="{{ route('com.team.single', $member->id) }}"
                          class="btn btn-secondary-solid btn-view-profile rounded-1 w-100 py-2 border-0"
                          style="font-size: 0.85rem; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; background-color: var(--secondary-color) !important; color: #000 !important; min-height: unset;">VIEW
                          PROFILE</a>
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
        <div class="swiper-button-next teams-next text-primary-color"></div>
        <div class="swiper-button-prev teams-prev text-primary-color"></div>
      </div>
    </div>
  </section>
  <!-- #teams end -->

    <!-- Services Section -->
  <section class="section py-5">
    <div class="b-container text-center">
      <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['services']['small_heading'] ?? 'OUR SERVICES' }}</h6>
      <h2 class="display-5 font-1 mb-5" style="font-weight: 800;">
        {{ $contents['services']['title'] ?? 'Breaking Stigmas, Building Strength' }}
      </h2>
      <div class="position-relative px-md-5">
        <div class="swiper-container services-slider" style="margin-top: 3rem !important; overflow: hidden;">
          <div class="swiper-wrapper">
            @foreach($services as $service)
              <!-- Dynamic Service Slide -->
              <div class="swiper-slide mb-5">
                <div class="card border-0 rounded-5 overflow-hidden h-100 shadow-sm scale-hover mx-2" data-aos="fade-up"
                  data-aos-easing="linear" data-aos-delay="{{ $loop->iteration * 100 }}" data-aos-duration="1000">
                  @php
                    $servImg = $service->image ?? 'image/serv1.jpg';
                    $servImgUrl = Str::startsWith($servImg, 'image/') ? asset($servImg) : asset('storage/' . $servImg);

                    $iconImg = $service->icon_image;
                    $iconImgUrl = $iconImg ? (Str::startsWith($iconImg, 'image/') ? asset($iconImg) : asset('storage/' . $iconImg)) : null;
                  @endphp
                  <img src="{{ $servImgUrl }}" class="w-100"
                    style="height: 250px; transform: scale(1.5); object-position: center;" alt="{{ $service->title }}">
                  <div class="bg-accent-color-2 text-start p-4 position-relative">
                    <div class="position-absolute top-0 start-0 translate-middle-y"
                      style="margin-top: 0; margin-left: 20px;">
                      @if($iconImgUrl)
                        <img src="{{ $iconImgUrl }}" alt="{{ $service->title }} Icon" width="100">
                      @else
                        <div class="bg-primary-color rounded-circle d-flex align-items-center justify-content-center"
                          style="width: 80px; height: 80px;">
                          <i class="bi {{ $service->icon }} text-white fs-2"></i>
                        </div>
                      @endif
                    </div>
                    <a href="#"
                      class="btn btn-dark btn-lg rounded-pill position-absolute top-0 end-0 me-3 fw-medium scale-hover"
                      style="margin-top: -25px;">Read More</a>
                    <h3 class="font-1 mt-5" style="font-weight: 800;">{{ $service->title }}</h3>
                    <hr class="border-primary border-1 opacity-100 w-100 my-4">
                    <p class="mb-3 line-clamp-6 service-description">{{ $service->description }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <!-- Pagination -->
          <div class="swiper-pagination mt-4 position-relative"></div>
        </div>
        <!-- Navigation Arrows -->
        <div class="swiper-button-next services-next text-primary-color"></div>
        <div class="swiper-button-prev services-prev text-primary-color"></div>
      </div>
    </div>
  </section>
  <!-- #services end -->

  <!-- Appointment Section -->
  <section class="section py-5 text-white bg-gradient-secondary my-5">
    <div class="b-container">
      <div class="row align-items-center g-4 pt-5">
        <!-- Left content -->
        <div class="col-12 col-xl-8 text-white mt-5 text-center text-xl-start">
          <p class="text-uppercase text-primary-color fs-5 fw-semibold mb-2">
            {{ $contents['appointment']['small_heading'] ?? 'Why Choose Us ?' }}
          </p>
          <h2 class="font-1 display-5 mb-4" style="font-weight: 800;">
            {!! str_replace(['Hope', 'At A Time'], ['<span class="text-primary-color">Hope</span>', '<span class="text-primary-color">At A Time</span>'], $contents['appointment']['title'] ?? 'Restoring Hope, One Day At A Time') !!}
          </h2>
          <p class="mb-4" style="font-size: large;">
            {{ $contents['appointment']['description'] ?? 'Through consistent care and compassionate guidance...' }}
          </p>
          <div class="d-flex justify-content-center justify-content-xl-start">
            <ul class="list-unstyled font-1 text-start d-inline-block text-xl-start mb-4">
              <li class="d-flex align-items-start mb-3">
                <div class="d-flex align-items-center" style="height: 1.75rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0" style="font-size: 1.25rem; line-height: 1.4;">
                  {{ $contents['appointment']['list_item_1'] ?? 'Compassionate & Experienced Professionals' }}
                </span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <div class="d-flex align-items-center" style="height: 1.75rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0" style="font-size: 1.25rem; line-height: 1.4;">
                  {{ $contents['appointment']['list_item_2'] ?? 'Holistic Approach To Well-Being' }}
                </span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <div class="d-flex align-items-center" style="height: 1.75rem;">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2 flex-shrink-0"></i>
                </div>
                <span class="fw-bolder mb-0" style="font-size: 1.25rem; line-height: 1.4;">
                  {{ $contents['appointment']['list_item_3'] ?? 'Safe & Supportive Environment' }}
                </span>
              </li>
            </ul>
          </div>
          <a href="{{ route('com.home') }}" class="btn btn-primary-solid mb-5">Make An Appointment</a>
        </div>

        <!-- Right content -->
        <div class="col-12 col-xl-4 d-flex flex-column gap-3">
          <div class="card bg-primary-color rounded-4 border-0 p-2" data-aos="fade-left" data-aos-easing="linear"
            data-aos-delay="500" data-aos-duration="1000">
            <div class="card-body text-center text-white p-3 font-1">
              <div class="display-5"><i class="bi bi-emoji-smile-fill accent-secondary-color"></i></div>
              <div class="mb-0 fs-2 fw-bold text-white">{{ $contents['appointment']['stat_1_number'] ?? '100%' }}</div>
              <p class="mb-0">{{ $contents['appointment']['stat_1_text'] ?? 'Satisfaction' }}</p>
            </div>
          </div>
          <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
            data-aos-delay="750" data-aos-duration="1000">
            <div class="card-body text-center text-white p-3 font-1">
              <div class="display-5"><i class="bi bi-hand-thumbs-up-fill accent-secondary-color"></i></div>
              <div class="mb-0 fs-2 fw-bold text-white">{{ $contents['appointment']['stat_2_number'] ?? '257+' }}</div>
              <p class="mb-0">{{ $contents['appointment']['stat_2_text'] ?? 'Happy Patient' }}</p>
            </div>
          </div>
          <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
            data-aos-delay="1000" data-aos-duration="1000">
            <div class="card-body text-center text-white p-3 font-1">
              <div class="display-5"><i class="bi bi-person-plus-fill accent-secondary-color"></i></div>
              <div class="mb-0 fs-2 fw-bold text-white">{{ $contents['appointment']['stat_3_number'] ?? '10+' }}</div>
              <p class="mb-0">{{ $contents['appointment']['stat_3_text'] ?? 'Expert Therapist' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- #appointment end -->



 

  <!-- Feedback Section -->
  <section class="section py-5 bg-light bg-white">
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
            @foreach($testimonials as $item)
              <div class="swiper-slide mt-4">
                <div class="card feedback-card h-100">
                  <div class="d-flex align-content-center mb-3">
                    <div class="mb-2 text-warning">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                      @endfor
                    </div>
                  </div>
                  <p class="fw-bold">"{{ $item->feedback }}"</p>
                  <div class="d-flex align-items-center mt-auto pt-3">
                    {{-- <img
                      src="{{ $item->client_image ? (Str::startsWith($item->client_image, 'image/') ? asset($item->client_image) : asset('storage/' . $item->client_image)) : asset('image/default-user.jpg') }}"
                      alt="{{ $item->client_name }}" class="rounded-circle me-3"
                      style="width: 64px; height: 64px; object-fit: cover;"> --}}
                    <div class="mt-2">
                      <h5 class="font-1 fw-bold text-primary-color mb-0">{{ $item->client_name }}</h5>
                      {{-- <p class="text-muted-color mb-0">{{ $item->designation }}</p> --}}
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
        <div class="swiper-button-next testimonials-next text-primary-color"></div>
        <div class="swiper-button-prev testimonials-prev text-primary-color"></div>
      </div>
    </div>
  </section>
  <!-- #feedback end -->

  <!-- Quotes Section -->
  <section class="quotes-section py-5">
    <div class="quotes-background"></div>
    <div class="container py-5 px-2 px-md-0">
      <div class="row justify-content-center text-center text-white">
        <div class="col-12 col-xl-10">
          <h6 class="text-primary-color fw-semibold mb-2">
            {{ $contents['get_in_touch']['small_heading'] ?? 'GET A QUOTE' }}
          </h6>
          <h2 class="font-1 text-white" style="font-weight: 800;">
            {!! $contents['get_in_touch']['quote_title'] ?? 'Take <span class="text-primary-color">The first step</span> toward a <span class="text-primary-color">healthier</span> mind. Join us today and start your journey to <span class="text-primary-color">well-being!</span>' !!}
          </h2>
        </div>
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-12 col-xl-10">
          <div class="card rounded-5 shadow-lg border-0 bg-secondary-gradient">
            <div class="card-body p-4 p-lg-5">
              <div class="row g-5 align-items-stretch">
                <div class="col-lg-6 col-md-12 order-lg-1 order-2">
                  <div
                    class="success_msg toast align-items-center w-100 shadow-none mb-3 border border-success rounded-pill my-4"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex p-2">
                      <div class="toast-body d-flex flex-row gap-3 align-items-center text-success">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        Your Message Successfully Send.
                      </div>
                      <button type="button" class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-success"
                        data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>
                  <div
                    class="error_msg toast align-items-center w-100 shadow-none border-danger mb-3 my-4 border rounded-pill"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex p-2">
                      <div class="toast-body d-flex flex-row gap-3 align-items-center text-danger">
                        <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                        Something Wrong ! Send Form Failed.
                      </div>
                      <button type="button" class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-danger"
                        data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>
                  <form id="homeAppointmentForm" class="needs-validation" data-aos="fade-up" data-aos-easing="linear"
                    data-aos-delay="500" data-aos-duration="1000" novalidate>
                    <div class="row g-3">
                      <div class="col-lg-6 col-sm-12">
                        <label for="name" class="form-label font-1 fs-4 fw-bold">Name</label>
                        <input type="text" class="form-control form-control-lg rounded-5" id="name"
                          placeholder="Your name here" name="name" required>
                        <div class="invalid-feedback">
                          Valid name is required.
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="email" class="form-label font-1 fs-4 fw-bold">Email</label>
                        <input type="email" class="form-control form-control-lg rounded-5" id="email"
                          placeholder="Your email here" name="email" required>
                        <div class="invalid-feedback">
                          Valid email is required.
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="phone" class="form-label font-1 fs-4 fw-bold">Phone</label>
                        <input type="number" class="form-control form-control-lg rounded-5" id="phone"
                          placeholder="Your phone number" name="phone" required>
                        <div class="invalid-feedback">
                          Valid phone is required.
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="date" class="form-label font-1 fs-4 fw-bold">Date</label>
                        <input type="date" class="form-control form-control-lg rounded-5" id="date" name="date" required>
                        <div class="invalid-feedback">
                          Valid date is required.
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="time" class="form-label font-1 fs-4 fw-bold">Time</label>
                        <input type="time" class="form-control form-control-lg rounded-5" id="time" name="time" required>
                        <div class="invalid-feedback">
                          What time is required.
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="subject" class="form-label font-1 fs-4 fw-bold">Subject</label>
                        <input type="text" class="form-control form-control-lg rounded-5" id="subject"
                          placeholder="Your subject." name="subject" required>
                        <div class="invalid-feedback">
                          Valid subject is required.
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="message" class="form-label font-1 fs-4 fw-bold">Message</label>
                        <textarea class="form-control form-control-lg rounded-5" id="message" name="message" rows="5"
                          placeholder="Tell us your story"></textarea>
                      </div>
                      <button type="submit" class="btn btn-block btn-primary-solid submit_form mt-4">Make An
                        Appoinment</button>
                    </div>
                  </form>
                </div>

                <div class="col-lg-6 col-md-12 order-lg-2 order-1 mb-4 mb-lg-0">
                  <div class="row">
                    <h2 class="font-1" style="font-weight: 800;">
                      {{ $contents['get_in_touch']['title'] ?? 'Need Any Help ? Get In Touch With Us' }}
                    </h2>
                    <p class="text-muted-color" style="font-size: large;">
                      {{ $contents['get_in_touch']['description'] ?? 'Every small step counts. We’re committed to walking with you through difficult moments, encouraging progress, and nurturing your journey toward lasting mental and emotional recovery.' }}
                    </p>
                  </div>

                  <!-- <div class="d-flex align-items-center gap-3 justify-content-start" data-aos="fade-left"
                            data-aos-easing="ease-out-cubic" data-aos-delay="250" data-aos-duration="1000">
                            <div
                              class="d-flex align-items-center justify-content-center rounded-circle border-white bg-secondary-color flex-shrink-0"
                              style="width: 65px; height: 65px; border: 2px solid white;">
                              <i class="bi bi-telephone-fill fs-2 text-white"></i>
                            </div>
                            <div class="ms-2 font-1 py-2">
                              <p class="fw-bold text-primary-color mb-0">Call us anytime</p>
                              <h5 class="fw-bold">{{ $contents['get_in_touch']['phone'] ?? '(555) 123-4567' }}</h5>
                            </div>
                          </div> -->
                  <div class="d-flex align-items-center gap-3 justify-content-start mt-3" data-aos="fade-left"
                    data-aos-easing="ease-out-cubic" data-aos-delay="500" data-aos-duration="1000">
                    <div
                      class="d-flex align-items-center justify-content-center rounded-circle border-2 border-white bg-secondary-color flex-shrink-0"
                      style="width: 65px; height: 65px;border: 2px solid white;">
                      <i class="bi bi-envelope-fill fs-2 text-white"></i>
                    </div>
                    <div class="ms-2 font-1 py-1">
                      <p class="fw-bold text-primary-color mb-0">Email us</p>
                      <div class="d-flex flex-column text-break">
                        @php
                          $email = $contents['get_in_touch']['email'] ?? 'workplacewellbeingbyywp@gmail.com';
                          $founderEmail = $contents['get_in_touch']['founder_email'] ?? 'akash@yourewonderfulproject.org';
                          $tertiaryEmail = $contents['get_in_touch']['tertiary_email'] ?? 'info@yourewonderfulproject.org';
                        @endphp
                        <a href="mailto:{{ $email }}?cc={{ $founderEmail }},{{ $tertiaryEmail }}"
                          class="text-decoration-none h5 fw-bold mb-1 text-dark d-block">
                          {{ $email }}
                        </a>
                        <a href="mailto:{{ $founderEmail }}?cc={{ $email }},{{ $tertiaryEmail }}"
                          class="text-decoration-none h5 fw-bold mb-0 text-dark d-block">
                          {{ $founderEmail }}
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3 justify-content-start" data-aos="fade-left"
                    data-aos-easing="ease-out-cubic" data-aos-delay="750" data-aos-duration="1000">
                    <div
                      class="d-flex align-items-center justify-content-center rounded-circle border-2 border-white bg-secondary-color flex-shrink-0"
                      style="width: 65px; height: 65px;border: 2px solid white;">
                      <i class="bi bi-geo-alt-fill fs-2 text-white"></i>
                    </div>
                    <div class="ms-2 font-1 py-2">
                      <p class="fw-bold text-primary-color mb-0">Our location</p>
                      <h5 class="fw-bold">
                        {!! nl2br($contents['get_in_touch']['address'] ?? '123 Serenity Lane, <br>Blissfield, CA 90210, US.') !!}
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- #quotes end -->

  {{-- Continue pasting remaining sections here --}}
  {{-- Features, About, Services, etc --}}

@endsection

@push('js')
  <script>
    $(document).ready(function () {
      new Swiper('.hero-slider', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.hero-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.hero-next',
          prevEl: '.hero-prev',
        },
      });

      new Swiper('.services-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: false,
        pagination: {
          el: '.services-slider .swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.services-next',
          prevEl: '.services-prev',
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

      new Swiper('.teams-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
          el: '.teams-slider .swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.teams-next',
          prevEl: '.teams-prev',
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
          nextEl: '.testimonials-next',
          prevEl: '.testimonials-prev',
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

      $('#homeAppointmentForm').on('submit', function (e) {
        e.preventDefault();

        if (this.checkValidity()) {
          const $form = $(this);
          const $submitBtn = $form.find('button[type="submit"]');
          const originalBtnText = $submitBtn.text();

          $submitBtn.prop('disabled', true).text('Sending...');

          const formData = {
            _token: "{{ csrf_token() }}",
            name: $form.find('#name').val(),
            email: $form.find('#email').val(),
            phone: $form.find('#phone').val(),
            date: $form.find('#date').val(),
            time: $form.find('#time').val(),
            subject: $form.find('#subject').val(),
            message: $form.find('#message').val()
          };

          $.ajax({
            url: "{{ route('com.appointment.submit') }}",
            method: "POST",
            data: formData,
            success: function (response) {
              if (response.status === 'success') {
                const workplaceEmail = "{{ $contents['get_in_touch']['email'] ?? 'workplacewellbeingbyywp@gmail.com' }}";
                const founderEmail = "{{ $contents['get_in_touch']['founder_email'] ?? 'akash@yourewonderfulproject.org' }}";
                const tertiaryEmail = "{{ $contents['get_in_touch']['tertiary_email'] ?? 'info@yourewonderfulproject.org' }}";

                const mailTo = workplaceEmail;
                const cc = `${founderEmail},${tertiaryEmail},${formData.email}`;
                const body = `Appointment Details:\n\nName: ${formData.name}\nEmail: ${formData.email}\nPhone: ${formData.phone}\nDate: ${formData.date}\nTime: ${formData.time}\n\nMessage:\n${formData.message}`;
                const mailtoLink = `mailto:${mailTo}?cc=${cc}&subject=${encodeURIComponent('Appointment Request: ' + formData.subject)}&body=${encodeURIComponent(body)}`;

                window.location.href = mailtoLink;
                $submitBtn.prop('disabled', false).text(originalBtnText);
              } else {
                alert('Error: ' + response.message);
                $submitBtn.prop('disabled', false).text(originalBtnText);
              }
            },
            error: function () {
              alert('Could not send automated email. Check SMTP settings.');
              $submitBtn.prop('disabled', false).text(originalBtnText);
            }
          });
        }
        $(this).addClass('was-validated');
      });
    });
  </script>
@endpush