@extends('site.com.layouts.app')

@section('title', 'About Us')

@section('content')
  @php
    $bgImagePath = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
    $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);

    $aboutImagePath = $contents['about']['about_image'] ?? 'image/about-page.jpg';
    $aboutFullUrl = Str::startsWith($aboutImagePath, 'image/') ? asset($aboutImagePath) : asset('storage/' . $aboutImagePath);
  @endphp
  <!-- Banner Section -->
  <section class="section position-relative"
      style="background-image: url('{{ $bgFullUrl }}'); height: 40vh;">
      <div class="bg-overlay-secondary"></div>
      <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
        <div
          class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
          <h1 class="display-2 mb-0" style="font-weight: 900;">About Us</h1>
          <nav aria-label="breadcrumb" style="font-weight: 900;">
            <ol class="breadcrumb justify-content-center align-items-center">
              <li class="breadcrumb-item font-1">
                <a class="text-decoration-none text-white" href="index.html">Home</a>
              </li>
              <li class="breadcrumb-item text-primary-color" aria-current="page">
                About Us
              </li>
            </ol>
          </nav>
        </div>
      </div>
  </section>
  <!-- #banner end -->

  <!-- About Section -->
  <section class="section about-section pb-5" style="margin-bottom: 3rem !important;">
    <div class="b-container">
      <div class="row align-items-center g-5">
        <!-- Left Image Side -->
        <div class="col-xl-4 d-flex position-relative">
          <div class="position-relative mx-auto img-container">
            <!-- Primary Image -->
            <div class="ratio-wrapper-429">
              <img src="{{ $aboutFullUrl }}" alt="{{ $contents['about']['about_title'] ?? 'About Us' }}"
                class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 rounded-5" data-aos="fade-right"
                data-aos-easing="ease-in-sine" data-aos-delay="500" data-aos-duration="1000">
            </div>
          </div>
        </div>
        <!-- Center Text Side -->
        <div class="col-xl-8">
          <div class="row">
            <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['about']['about_label'] ?? 'ABOUT US' }}</h6>
            <h2 class="font-1 mb-4" style="font-weight: 800;">{!! nl2br($contents['about']['about_title'] ?? 'Because Your Mental<br>Health Matters') !!}</h2>
          </div>
          <div class="row">
            <div class="col-12 col-md-7">
              <ul class="list-unstyled fs-5">
                <li class="d-flex align-items-start mb-2">
                  <i class="bi bi-chevron-right text-primary-color me-2 py-3"></i>
                  <span>{{ $contents['about']['about_point_1'] ?? 'Prioritizing well-being helps you thrive emotionally, socially, and personally every day.' }}</span>
                </li>
                <li class="d-flex align-items-start mb-2">
                  <i class="bi bi-chevron-right text-primary-color me-2 py-3"></i>
                  <span>{{ $contents['about']['about_point_2'] ?? 'Strong minds build strong lives; support and care create lasting peace.' }}</span>
                </li>
                <li class="d-flex align-items-start mb-2">
                  <i class="bi bi-chevron-right text-primary-color me-2 py-3"></i>
                  <span>{{ $contents['about']['about_point_3'] ?? 'Inner peace starts with awareness, acceptance, and support when it\'s needed most.' }}</span>
                </li>
                <li class="d-flex align-items-start mb-2">
                  <i class="bi bi-chevron-right text-primary-color me-2 py-3"></i>
                  <span>{{ $contents['about']['about_point_4'] ?? 'Emotional strength shapes how we live, connect, and move forward confidently.' }}</span>
                </li>
              </ul>
            </div>
            <div class="col-12 col-md-5 mt-sm-4" data-aos="fade-up" data-aos-easing="ease-in-sine"
              data-aos-delay="500" data-aos-duration="1000">
              <div class="card bg-primary-color p-4 rounded-5 border-0">
                <div class="card-body text-white">
                  <h4 class="font-1" style="font-weight: 900; line-height: 25px !important;">{{ $contents['about']['about_card_title'] ?? 'Together, We overcome' }}</h4>
                  <div class="row mt-4">
                    <div class="mb-4 fs-5">
                      <i class="bi bi-check-circle-fill text-secondary-color-2 me-2"></i>
                      {{ $contents['about']['about_card_item_1'] ?? 'Free Consultation' }}
                    </div>
                    <div class="mb-4 fs-5">
                      <i class="bi bi-check-circle-fill text-secondary-color-2 me-2"></i>
                      {{ $contents['about']['about_card_item_2'] ?? 'Mental Satisfaction' }}
                    </div>
                    <div class="mb-4 fs-5">
                      <i class="bi bi-check-circle-fill text-secondary-color-2 me-2"></i>
                      {{ $contents['about']['about_card_item_3'] ?? 'Emergency Service' }}
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
  <!-- #about end -->

  <!-- Consult Section -->
  <section class="section py-5 text-white bg-gradient-secondary my-5">
    <div class="b-container">
      <div class="row justify-content-center text-center text-xl-start my-5">
        <div class="col-12 col-xl-7">
          <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['consult']['consult_label'] ?? 'HOW WE WORK ?' }}</h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            {!! str_replace(['Health', 'Here'], ['<span class="text-primary-color">Health</span>', '<span class="text-primary-color">Here</span>'], $contents['consult']['consult_title'] ?? 'Here For Your Health, Here For Your Heart') !!}
          </h2>
        </div>
        <div class="col-12 col-xl-5 mt-4 mt-md-0">
          <p class="mb-4" style="font-size: large;">{{ $contents['consult']['consult_description'] ?? 'We offer compassionate care, combining physical and emotional support to help you thrive in every aspect.' }}</p>
          <a href="contact-us.html" class="btn btn-primary-solid">{{ $contents['consult']['consult_button_text'] ?? 'Get Consult Now' }}</a>
        </div>
      </div>

      <hr class="border-white solid border-2 my-5">

      <div class="row text-white mb-0 mb-xl-5 pt-5">
        <div class="step-box col-12 col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-delay="500"
          data-aos-duration="1000">
          <h1>01</h1>
          <h3>{{ $contents['steps']['step_1_title'] ?? 'Listen & Understand' }}</h3>
          <p>{{ $contents['steps']['step_1_description'] ?? 'Your wellness journey matters. We’re dedicated to supporting both your mental clarity and emotional strength every step forward.' }}</p>
        </div>
        <div class="step-box col-12 col-lg-4" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="500"
          data-aos-duration="1000">
          <h1>02</h1>
          <h3>{{ $contents['steps']['step_2_title'] ?? 'Create A Tailored Plan' }}</h3>
          <p>{{ $contents['steps']['step_2_description'] ?? 'From everyday stress to life’s hardest moments, our team stands ready to support your healing and overall well-being.' }}</p>
        </div>
        <div class="step-box col-12 col-lg-4" data-aos="fade-left" data-aos-easing="linear" data-aos-delay="500"
          data-aos-duration="1000">
          <h1>03</h1>
          <h3>{{ $contents['steps']['step_3_title'] ?? 'Support & Empower' }}</h3>
          <p>{{ $contents['steps']['step_3_description'] ?? 'Empowering you to live well with care that nurtures your body, mind, and emotional peace every single day.' }}</p>
        </div>
      </div>
    </div>
  </section>
  <!-- #consult end -->

  <!-- Teams Section -->
  <section class="section py-5 mt-5 bg-half-gradient">
    <div class="b-container" style="padding-top: 50px;">
      <div class="row text-center">
        <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['teams']['small_heading'] ?? 'OUR SPECIALIST' }}</h6>
        <h2 class="font-1 mb-5" style="font-weight: 800;">{!! nl2br($contents['teams']['title'] ?? 'Meet Our Senior<br>Therapist') !!}</h2>
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

  <!-- FAQs Section -->
  <section class="section bg-gradient-secondary py-5 text-white">
    <div class="b-container">
      <div class="row row-cols-1 row-cols-lg-2 py-5">
        <div class="col d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
          <h6 class="text-primary-color fw-semibold mb-4">{{ $contents['faqs']['faqs_label'] ?? 'FREQUENTLY ASKED QUESTION' }}</h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            {!! str_replace(['Most', 'We Got'], ['<span class="text-primary-color">Most</span>', '<span class="text-primary-color">We Got </span>'], $contents['faqs']['faqs_title'] ?? 'The Most Question We Got So Far') !!}
          </h2>

          <hr class="border-white solid border-2 p-0 m-0">

          <div class="bg-primary-color d-flex flex-column text-white px-4 rounded-5 w-auto">
            <div class="d-flex justify-content-between gap-5">
              <div class="text-warning fs-5 pt-3 pb-0">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
              </div>
              <p class="font-1 fs-5 fw-bolder pt-3 p-0">{{ $contents['faqs']['faqs_rating'] ?? '4,9 /5' }}</p>
            </div>
          </div>
          <p class="mt-4 mb-5" style="font-size: large;">{{ $contents['faqs']['faqs_description'] ?? 'Through consistent care and compassionate guidance, we help individuals rediscover strength, build resilience, and move forward toward a brighter, healthier future at their own pace.' }}</p>
        </div>
        <div class="col mt-5">
          <div class="accordion" id="accordionFaqs" data-aos="fade-up" data-aos-easing="ease-out-cubic"
            data-aos-delay="500" data-aos-duration="1000">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1"
                  aria-expanded="false" aria-controls="faq-1">
                  &nbsp;{{ $contents['faqs']['faq_1_question'] ?? 'What is mental health, and why is it important?' }}
                </button>
              </h2>
              <div id="faq-1" class="accordion-collapse collapse show" data-bs-parent="#accordionFaqs">
                <div class="accordion-body">{{ $contents['faqs']['faq_1_answer'] ?? 'If you experience persistent feelings of sadness, anxiety, or stress that interfere with daily life, it may be time to seek professional support. Other signs include difficulty concentrating, changes in sleep patterns, or feelings of isolation and hopelessness.' }}
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
                  &nbsp;{{ $contents['faqs']['faq_2_question'] ?? 'How can I tell if I need professional mental health support?' }}
                </button>
              </h2>
              <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body">{{ $contents['faqs']['faq_2_answer'] ?? 'Mental health refers to a person’s emotional, psychological, and social well-being. It affects how people think, feel, and behave. Maintaining good mental health is essential for handling stress, building relationships, and making decisions in daily life.' }}</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">
                  &nbsp;{{ $contents['faqs']['faq_3_question'] ?? 'Are online therapy sessions effective?' }}
                </button>
              </h2>
              <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body">{{ $contents['faqs']['faq_3_answer'] ?? 'Yes, online therapy can be very effective for many individuals. It offers flexibility, accessibility, and privacy, making it easier for people to access professional help from the comfort of their own homes.' }}</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-4" aria-expanded="false" aria-controls="faq-4">
                  &nbsp;{{ $contents['faqs']['faq_4_question'] ?? 'What can I do to improve my mental well-being daily?' }}
                </button>
              </h2>
              <div id="faq-4" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body">{{ $contents['faqs']['faq_4_answer'] ?? 'You can improve your mental well-being by practicing self-care, such as regular exercise, a healthy diet, mindfulness, and getting enough sleep. Additionally, staying connected with loved ones and seeking help when needed are essential steps toward better mental health.' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- #faqs end -->

@endsection

@push('js')
  <script>
    $(document).ready(function () {
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
    });
  </script>
@endpush
