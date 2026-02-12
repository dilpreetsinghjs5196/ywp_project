@extends('site.com.layouts.app')

@section('title', 'Home')

@section('content')

  <!-- Hero Section -->
  @php
    // Logic for background image path
    $bgImagePath = $contents['hero']['hero_bg_image'] ?? 'image/Homehero.png';
    $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);

    // Logic for foreground image path
    $heroImagePath = $contents['hero']['hero_image'] ?? 'image/hero-img.png';
    $heroFullUrl = Str::startsWith($heroImagePath, 'image/') ? asset($heroImagePath) : asset('storage/' . $heroImagePath);

    $backgroundStyle = "background: url('$bgFullUrl');";
  @endphp
  <section class="section hero-section d-flex align-items-center pb-0"
    style="{{ $backgroundStyle }} background-size: cover; background-position: center;">
    <div class="b-container px-3 px-sm-4 px-md-0">
      <div class="row row-cols-1 row-cols-lg-2 g-4 align-items-center text-white">
        <!-- Left Content -->
        <div class="col mt-md-5 text-center text-lg-start d-flex flex-column align-items-center align-items-lg-start"
          data-aos="fade-up" data-aos-easing="linear" data-aos-delay="500" data-aos-duration="1000">
          <h6 class="text-primary-color fw-semibold">FIND BALANCE, EMBRACE LIFE</h6>
          <h1 class="display-md-4 lh-sm font-1" style="font-weight: 900;">
            {!! str_replace('Inner', '<span class="text-primary-color">Inner</span>', $contents['hero']['main_title'] ?? 'Caring for Your Inner Peace') !!}
          </h1>
          <hr class="border border-white border-2 opacity-75 w-75 my-4 mx-auto mx-lg-0">
          <p class="fs-5 my-4">
            {{ $contents['hero']['subtitle'] ?? 'Discover clarity, confidence, and emotional wellness through guided support.' }}
          </p>
          <div class="d-flex gap-3 align-items-center my-4 flex-nowrap justify-content-lg-start justify-content-center">
            <a href="appointment.html" role="button" class="btn btn-primary-solid">Start A Checkup
              Now</a>
            <button class="btn btn-secondary-solid rounded-circle fs-2 p-2 btn-play" type="button"
              style="width: 60px; height: 60px;" onclick="showVideoOverlay()">
              <i class="bi bi-play-fill"></i>
            </button>
          </div>
        </div>
        <!-- Video Overlay -->
        <div id="videoOverlay" class="video-overlay d-none mt-0">
          <button type="button" class="position-absolute top-0 end-0 m-3 text-white fs-2 border-0 bg-transparent"
            onclick="hideVideoOverlay()" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
          <div class="video-box">
            <div class="ratio ratio-16x9">
              <iframe id="youtubeFrame" src="https://www.youtube.com/embed/N3Te3HeEFoA?si=YT6iTnj0qgbxYQ-H"
                title="YouTube video" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!-- #video end -->

        <!-- Right Image -->
        <div class="col position-relative text-center pt-lg-4 pt-xl-3">
          <img src="{{ $heroFullUrl }}" alt="Hero Talent" class="img-fluid position-relative" style="z-index: 2;">
          <!-- Badge Review -->
          <div
            class="badge-cta position-absolute top-50 start-0 translate-middle-y bg-secondary-color py-3 px-4 rounded-5 text-white text-center d-none d-md-block"
            style="z-index: 3;">
            <h3 class="mb-0 font-1 fw-bolder count-up" data-count="4.9" data-suffix=" /5">0</h3>
            <p class="mb-0">Review on Google</p>
          </div>
          <!-- Badge Phone -->
          <div
            class="badge-cta position-absolute top-0 end-0 bg-primary-color py-3 px-4 rounded-5 d-flex align-items-center gap-3 justify-content-start"
            style=" z-index: 1;">
            <div class=" d-flex align-items-center justify-content-center rounded-circle bg-white"
              style="width: 60px; height: 60px;">
              <i class=" bi bi-telephone-fill text-primary-color fs-2"></i>
            </div>
            <div class="justify-content-start">
              <p class="mb-0">Call us anytime</p>
              <h3 class="font-1 fw-bolder">{{ $settings['contact_phone'] ?? '(555) 123-4567' }}</h3>
            </div>
          </div>
        </div>
      </div>
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

          <div class="row d-flex flex-column flex-md-row my-4">
            <div class="col d-flex justify-content-center justify-content-lg-start">
              <ul class="list-unstyled font-1">
                <li class="d-flex align-items-start fw-bolder mb-2">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2"></i>
                  <h5 class="fw-bolder py-1">{{ $contents['about_us']['list_item_1'] ?? 'Free Consultation' }}</h5>
                </li>
                <li class="d-flex align-items-start fw-bolder mb-2">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2"></i>
                  <h5 class="fw-bolder py-1">{{ $contents['about_us']['list_item_2'] ?? 'Emergency Service' }}</h5>
                </li>
              </ul>
            </div>
            <div class="col d-flex justify-content-center justify-content-lg-start">
              <ul class="list-unstyled font-1">
                <li class="d-flex align-items-start fw-bolder mb-2">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2"></i>
                  <h5 class="fw-bolder py-1">{{ $contents['about_us']['list_item_3'] ?? 'Mental Satisfaction' }}</h5>
                </li>
                <li class="d-flex align-items-start fw-bolder mb-2">
                  <i class="bi bi-check-circle-fill text-primary-color fs-4 me-2"></i>
                  <h5 class="fw-bolder py-1">{{ $contents['about_us']['list_item_4'] ?? 'Psychologists Services' }}</h5>
                </li>
              </ul>
            </div>
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
            <a href="{{ route('com.about') }}" class="btn btn-primary-solid">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- #about end -->

  <!-- Appointment Section -->
  <section class="section py-5 text-white bg-gradient-secondary my-5">
    <div class="b-container">
      <div class="row align-items-center g-4 pt-5">
        <!-- Left content -->
        <div class="col-12 col-xl-5 order-1 order-md-3 order-xl-1 text-white mt-5 text-center text-xl-start">
          <p class="text-uppercase text-primary-color fs-5 fw-semibold mb-2">
            {{ $contents['appointment']['small_heading'] ?? 'Why Choose Us ?' }}
          </p>
          <h2 class="font-1 display-5 mb-4" style="font-weight: 800;">
            {!! str_replace(['Hope', 'At A Time'], ['<span class="text-primary-color">Hope</span>', '<span class="text-primary-color">At A Time</span>'], $contents['appointment']['title'] ?? 'Restoring Hope, One Day At A Time') !!}
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
              <h5 class="fw-bolder py-1">{{ $contents['appointment']['list_item_3'] ?? 'Safe & Supportive Environment' }}
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
              alt="Appointment" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="750" data-aos-duration="1000">
          </div>
        </div>
        <!-- Right content -->
        <div class="col-12 col-md-5 col-xl-2 d-flex flex-column gap-3 order-3 order-md-2 order-xl-3">
          <div class="card bg-primary-color rounded-4 border-0" data-aos="fade-left" data-aos-easing="linear"
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
                    <a href="{{ route('com.home') }}"
                      class="btn btn-dark btn-lg rounded-pill position-absolute top-0 end-0 me-3 fw-medium scale-hover"
                      style="margin-top: -25px;">Read More</a>
                    <h3 class="font-1 mt-5" style="font-weight: 800;">{{ $service->title }}</h3>
                    <hr class="border-primary border-1 opacity-100 w-100 my-4">
                    <p class="mb-3">{{ $service->description }}</p>
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
  <!-- #services end -->

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
                  <div class="position-absolute w-75" style="margin-top: -9rem; margin-left: 12.5%;">
                    <div
                      class="bg-primary-color d-flex flex-column text-white py-3 align-items-center text-center rounded-5">
                      <div class="mb-2">
                        <h4 class="font-1 fw-bolder">{{ $member->name }}</h4>
                        <p class="mb-0">{{ $member->designation }}</p>
                      </div>
                      <div class="social-box justify-content-center mb-2">
                        @if($member->facebook)
                          <a href="{{ $member->facebook }}" class="fs-6 rounded-1 py-1" style="width: 30px; height: 30px;"><i
                              class="bi bi-facebook text-white"></i></a>
                        @endif
                        @if($member->twitter)
                          <a href="{{ $member->twitter }}" class="fs-6 rounded-1 py-1" style="width: 30px; height: 30px;"><i
                              class="bi bi-twitter-x text-white"></i></a>
                        @endif
                        @if($member->instagram)
                          <a href="{{ $member->instagram }}" class="fs-6 rounded-1 py-1" style="width: 30px; height: 30px;"><i
                              class="bi bi-instagram text-white"></i></a>
                        @endif
                        @if($member->linkedin)
                          <a href="{{ $member->linkedin }}" class="fs-6 rounded-1 py-1" style="width: 30px; height: 30px;"><i
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
                    <img
                      src="{{ $item->client_image ? (Str::startsWith($item->client_image, 'image/') ? asset($item->client_image) : asset('storage/' . $item->client_image)) : asset('image/default-user.jpg') }}"
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

  <!-- Quotes Section -->
  <section class="quotes-section py-5">
    <div class="quotes-background"></div>
    <div class="container py-5 px-2 px-md-0">
      <div class="row justify-content-center text-center text-white">
        <div class="col-12 col-xl-10">
          <h6 class="text-primary-color fw-semibold mb-2">
            {{ $contents['get_in_touch']['small_heading'] ?? 'GET A QUOTE' }}</h6>
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

                  <div class="d-flex align-items-center gap-3 justify-content-start" data-aos="fade-left"
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
                  </div>
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
      new Swiper('.services-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: false,
        pagination: {
          el: '.services-slider .swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.services-slider + .swiper-button-next',
          prevEl: '.services-slider + .swiper-button-prev',
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