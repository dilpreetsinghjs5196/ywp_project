@extends('site.com.layouts.app')

@section('title', 'Our Services')

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
    });
  </script>
@endpush

@section('content')
  @php
    $bgImagePath = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
    $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);
  @endphp

  <!-- Banner Section -->
  <section class="section position-relative" style="background-image: url('{{ $bgFullUrl }}'); height: 40vh;">
    <div class="bg-overlay-secondary"></div>
    <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
      <div
        class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
        <h1 class="display-2 mb-0" style="font-weight: 900;">Our Services</h1>
        <nav aria-label="breadcrumb" style="font-weight: 900;">
          <ol class="breadcrumb justify-content-center align-items-center">
            <li class="breadcrumb-item font-1">
              <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
            </li>
            <li class="breadcrumb-item text-primary-color" aria-current="page">
              Services
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- #banner end -->

  <!-- Services Section -->
  <section class="section py-5">
    <div class="b-container">
      <div class="row text-center mb-5 pt-5">
        <h6 class="text-primary-color fw-semibold mb-2">
          {{ $contents['services_head']['services_label'] ?? 'WHATEVER WE DO' }}
        </h6>
        <h2 class="font-1 mb-4" style="font-weight: 800;">
          {{ $contents['services_head']['services_title'] ?? 'Services We Provide' }}
        </h2>
        <p class="text-muted mx-auto" style="max-width: 700px;">
          {{ $contents['services_head']['services_description'] ?? 'We offer a wide range of mental health services tailored to your needs. Our professional therapists are here to support you every step of the way.' }}
        </p>
      </div>

      <div class="position-relative px-md-5">
        <div class="swiper-container services-slider" style="overflow: hidden;">
          <div class="swiper-wrapper">
            @foreach($services as $service)
              <div class="swiper-slide h-auto mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-5 overflow-hidden transition-hover mx-2"
                  data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                  @php
                    $servImg = $service->image ?? 'image/serv1.jpg';
                    $servImgUrl = Str::startsWith($servImg, 'image/') ? asset($servImg) : asset('storage/' . $servImg);

                    $iconImg = $service->icon_image;
                    $iconImgUrl = $iconImg ? (Str::startsWith($iconImg, 'image/') ? asset($iconImg) : asset('storage/' . $iconImg)) : null;
                  @endphp
                  <div class="position-relative overflow-hidden" style="height: 200px;">
                    <img src="{{ $servImgUrl }}" class="w-100 h-100 object-fit-cover" alt="{{ $service->title }}">
                  </div>
                  <div class="bg-accent-color-2 card-body p-4 position-relative">
                    <div class="position-absolute top-0 start-0 translate-middle-y ms-4" style="margin-top: -10px;">
                      @if($iconImgUrl)
                        <div class="bg-white rounded-circle shadow-sm p-2 d-flex align-items-center justify-content-center"
                          style="width: 70px; height: 70px;">
                          <img src="{{ $iconImgUrl }}" alt="{{ $service->title }} Icon"
                            style="width: 100px; height: 70px; object-fit: contain;">
                        </div>
                      @elseif($service->icon)
                        <div
                          class="bg-primary-color rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                          style="width: 70px; height: 70px;">
                          <i class="{{ $service->icon }} text-white fs-3"></i>
                        </div>
                      @else
                        <div
                          class="bg-primary-color rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                          style="width: 70px; height: 70px;">
                          <i class="bi bi-heart-pulse text-white fs-3"></i>
                        </div>
                      @endif
                    </div>
                    <h4 class="font-1 fw-bold mb-3 mt-3">{{ $service->title }}</h4>
                    <p class="text-muted-color mb-3 line-clamp-6 service-description">{{ $service->description }}</p>

                    @if($service->goals)
                      <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold text-primary-color mb-3">Goals include:</h6>
                        <ul class="list-unstyled mb-0">
                          @foreach(explode("\n", str_replace("\r", "", $service->goals)) as $goal)
                            @if(trim($goal))
                              <li class="d-flex align-items-start mb-2 small text-muted-color">
                                <i class="bi bi-check2-circle text-primary-color me-2 mt-1"></i>
                                <span>{{ trim($goal) }}</span>
                              </li>
                            @endif
                          @endforeach
                        </ul>
                      </div>
                    @endif
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

  <!-- Therapy Process Section (Copy from About Us - How We Work) -->
  <section class="section py-5 text-white bg-gradient-secondary mt-5">
    <div class="b-container">
      <div class="row justify-content-center text-center text-xl-start mt-5 mb-4">
        <div class="col-12 col-xl-7">
          <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['consult']['consult_label'] ?? 'THERAPY PROCESS' }}
          </h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            {!! str_replace(['Intake', 'Follow-up'], ['<span class="text-primary-color">Intake</span>', '<span class="text-primary-color">Follow-up</span>'], $contents['consult']['consult_title'] ?? 'From Intake to Follow-up Process') !!}
          </h2>
        </div>
        <div class="col-12 col-xl-5 mt-4 mt-md-0">
          <p class="mb-4" style="font-size: large;">
            {{ $contents['consult']['consult_description'] ?? 'We follow a structured yet compassionate approach to ensure you receive the best care from your first session to your long-term wellness goals.' }}
          </p>
        </div>
      </div>

      <hr class="border-white solid border-2 my-4">

      <div class="row text-white mb-0">
        <div class="step-box col-12 col-lg-4" data-aos="fade-right" data-aos-delay="200">
          <h1>01</h1>
          <h3>{{ $contents['steps']['step_1_title'] ?? 'Initial Consultation' }}</h3>
          <p>
            {{ $contents['steps']['step_1_description'] ?? 'We start with a thorough intake to understand your history, current challenges, and goals for therapy.' }}
          </p>
        </div>
        <div class="step-box col-12 col-lg-4" data-aos="fade-up" data-aos-delay="400">
          <h1>02</h1>
          <h3>{{ $contents['steps']['step_2_title'] ?? 'Therapy Sessions' }}</h3>
          <p>
            {{ $contents['steps']['step_2_description'] ?? 'Regular sessions tailored to your specific needs, using evidence-based practices to help you progress.' }}
          </p>
        </div>
        <div class="step-box col-12 col-lg-4" data-aos="fade-left" data-aos-delay="600">
          <h1>03</h1>
          <h3>{{ $contents['steps']['step_3_title'] ?? 'Follow-up & Support' }}</h3>
          <p>
            {{ $contents['steps']['step_3_description'] ?? 'Ongoing assessment and support to ensure lasting change and continued mental well-being.' }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Fees Section -->
  <section class="section py-5 mt-5">
    <div class="b-container pb-4">
      <div class="card bg-light border-0 rounded-5 p-5 text-center">
        <h6 class="text-primary-color fw-semibold mb-2">{{ $contents['fees']['fees_label'] ?? 'TRANSPARENCY' }}</h6>
        <h2 class="font-1 mb-4" style="font-weight: 800;">{{ $contents['fees']['fees_title'] ?? 'Therapy Fees' }}</h2>
        <p class="text-muted-color mb-5">
          {{ $contents['fees']['fees_description'] ?? 'We believe in making therapy accessible and being transparent about our costs.' }}
        </p>

        <button class="btn btn-primary-solid px-5 py-3" type="button" data-bs-toggle="collapse"
          data-bs-target="#feesDetails" aria-expanded="false" aria-controls="feesDetails">
          {{ $contents['fees']['fees_button_text'] ?? 'Show Fee Details' }}
        </button>

        <div class="collapse mt-5 text-start" id="feesDetails">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="table-responsive bg-white rounded-5 shadow-sm p-4">
                <table class="table table-borderless align-middle mb-0">
                  <thead class="border-bottom">
                    <tr>
                      <th class="py-3 font-1">Type of Session</th>
                      <th class="py-3 font-1 text-end">Fees (INR)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="border-bottom">
                      <td class="py-4">
                        <h5 class="mb-1">{{ $contents['fees']['fee_1_name'] ?? 'Individual Therapy' }}</h5>
                        <p class="small text-muted mb-0">
                          {{ $contents['fees']['fee_1_description'] ?? '50-minute session for one person' }}
                        </p>
                      </td>
                      <td class="py-4 text-end">
                        <h5 class="text-primary-color mb-0">
                          {{ $contents['fees']['fee_1_price'] ?? 'Γé╣ 1,200 - Γé╣ 2,500' }}
                        </h5>
                      </td>
                    </tr>
                    <tr class="border-bottom">
                      <td class="py-4">
                        <h5 class="mb-1">{{ $contents['fees']['fee_2_name'] ?? 'Couples Counseling' }}</h5>
                        <p class="small text-muted mb-0">
                          {{ $contents['fees']['fee_2_description'] ?? '60-90 minute session for partners' }}
                        </p>
                      </td>
                      <td class="py-4 text-end">
                        <h5 class="text-primary-color mb-0">
                          {{ $contents['fees']['fee_2_price'] ?? 'Γé╣ 2,000 - Γé╣ 3,500' }}
                        </h5>
                      </td>
                    </tr>
                    <tr>
                      <td class="py-4">
                        <h5 class="mb-1">{{ $contents['fees']['fee_3_name'] ?? 'Group Session' }}</h5>
                        <p class="small text-muted mb-0">
                          {{ $contents['fees']['fee_3_description'] ?? 'Variable duration, small groups' }}
                        </p>
                      </td>
                      <td class="py-4 text-end">
                        <h5 class="text-primary-color mb-0">
                          {{ $contents['fees']['fee_3_price'] ?? 'Γé╣ 500 - Γé╣ 1,000' }}
                        </h5>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="alert alert-info border-0 rounded-4 mt-4 mb-0">
                  <i class="bi bi-info-circle-fill me-2"></i>
                  {{ $contents['fees']['fee_info_note'] ?? 'Fees vary depending on the specialist\'s experience and the session type. Payment can be made online at the time of booking.' }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQs Section -->
  <section class="section bg-gradient-secondary py-5 text-white mt-5">
    <div class="b-container py-4">
      <div class="row row-cols-1 row-cols-lg-2">
        <div class="col d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
          <h6 class="text-primary-color fw-semibold mb-4">
            {{ $contents['faqs']['faqs_label'] ?? 'FREQUENTLY ASKED QUESTIONS' }}
          </h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            {{ $contents['faqs']['faqs_title'] ?? 'Common Questions About Our Services' }}
          </h2>
          <p class="mt-4 mb-5" style="font-size: large;">
            {{ $contents['faqs']['faqs_description'] ?? 'Find answers to the most common questions about how our therapy sessions work and what you can expect from our services.' }}
          </p>
        </div>
        <div class="col">
          <div class="accordion" id="accordionFaqs">
            <div class="accordion-item bg-transparent border-0 mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed rounded-4 shadow-sm" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-1" aria-expanded="false" aria-controls="faq-1">
                  {{ $contents['faqs']['faq_1_question'] ?? 'How long is each therapy session?' }}
                </button>
              </h2>
              <div id="faq-1" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body text-white-50">
                  {{ $contents['faqs']['faq_1_answer'] ?? 'Standard individual therapy sessions are 50 minutes long. Couples sessions may range from 60 to 90 minutes.' }}
                </div>
              </div>
            </div>
            <div class="accordion-item bg-transparent border-0 mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed rounded-4 shadow-sm" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
                  {{ $contents['faqs']['faq_2_question'] ?? 'Are sessions conducted online or in-person?' }}
                </button>
              </h2>
              <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body text-white-50">
                  {{ $contents['faqs']['faq_2_answer'] ?? 'We provide both online (via video call) and in-person sessions depending on your location and preference.' }}
                </div>
              </div>
            </div>
            <div class="accordion-item bg-transparent border-0 mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed rounded-4 shadow-sm" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">
                  {{ $contents['faqs']['faq_3_question'] ?? 'How do I pay for the sessions?' }}
                </button>
              </h2>
              <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                <div class="accordion-body text-white-50">
                  {{ $contents['faqs']['faq_3_answer'] ?? 'Payments can be made securely through our website at the time of booking using various payment modes like UPI, Credit/Debit cards, etc.' }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Disclaimer & Privacy Section -->
  <section class="section py-5 bg-light">
    <div class="b-container py-4">
      <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="p-4 bg-white rounded-5 shadow-sm h-100">
            <h4 class="font-1 fw-bold text-primary-color mb-4"><i
                class="bi bi-exclamation-triangle-fill me-2"></i>{{ $contents['legal']['disclaimer_title'] ?? 'Disclaimer' }}
            </h4>
            <p class="text-muted-color">
              {{ $contents['legal']['disclaimer_text'] ?? 'The information provided on this website is for general educational purposes only and is not a substitute for professional mental health advice, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical or mental health condition.' }}
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-4 bg-white rounded-5 shadow-sm h-100">
            <h4 class="font-1 fw-bold text-primary-color mb-4"><i
                class="bi bi-shield-lock-fill me-2"></i>{{ $contents['legal']['privacy_title'] ?? 'Privacy Note' }}</h4>
            <p class="text-muted-color">
              {{ $contents['legal']['privacy_text'] ?? 'Your privacy is our priority. All conversations and records are strictly confidential. We adhere to the highest standards of data protection and ethical guidelines to ensure your information remains secure and private at all times.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection

@push('css')
  <style>
    .transition-hover {
      transition: transform 0.3s ease, shadow 0.3s ease;
    }

    .transition-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
    }

    .bg-gradient-secondary {
      background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
    }

    .accordion-button:not(.collapsed) {
      background-color: var(--primary-color) !important;
      color: white !important;
    }

    .accordion-button::after {
      filter: brightness(0) invert(1);
    }

    .accordion-item {
      background: rgba(255, 255, 255, 0.05) !important;
    }

    .accordion-button {
      background: rgba(255, 255, 255, 0.1) !important;
      color: white !important;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
  </style>
@endpush