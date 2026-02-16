@extends('site.com.layouts.app')

@section('title', 'Our Team - Meet Our Therapists')

@section('content')
  @php
    $bgImagePath = $contents['banner']['bg_image'] ?? 'image/footer-img.jpg';
    $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);
  @endphp
  <!-- Banner Section -->
  <section class="section position-relative" style="background-image: url('{{ $bgFullUrl }}'); height: 40vh;">
    <div class="bg-overlay-secondary"></div>
    <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
      <div
        class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
        <h1 class="display-2 mb-0" style="font-weight: 900;">{{ $contents['banner']['title'] ?? 'Our Team' }}</h1>
        <nav aria-label="breadcrumb" style="font-weight: 900;">
          <ol class="breadcrumb justify-content-center align-items-center">
            <li class="breadcrumb-item font-1">
              <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Homepage</a>
            </li>
            <li class="breadcrumb-item text-primary-color active" aria-current="page">
              Our Team
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- #banner end -->

  <!-- Team Introduction Section -->
  <section class="section py-5">
    <div class="b-container">
      <div class="row text-center mb-5" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200"
        data-aos-duration="1000">
        <div class="col-lg-8 mx-auto">
          <h6 class="text-primary-color fw-semibold mb-2">OUR SPECIALIST</h6>
          <h2 class="font-1 mb-4" style="font-weight: 800;">
            Meet Our Dedicated Team of Therapists & Counselors
          </h2>
          <p class="text-muted-color" style="font-size: large;">
            Our team consists of highly qualified and compassionate mental health professionals committed to supporting
            your journey toward emotional wellness and personal growth.
          </p>
        </div>
      </div>

      <!-- Team Members Grid -->
      <div class="row g-5">
        @forelse($teams as $member)
          <div class="col-12 col-sm-6 col-xl-3 mb-5" data-aos="fade-up" data-aos-easing="linear"
            data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
            <div class="position-relative rounded-5 transition-hover mx-auto img-container h-100" style="max-width: 100%;">
              <div class="ratio-wrapper-419">
                <a href="{{ route('com.team.single', $member->id) }}">
                  <img
                    src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                    alt="{{ $member->name }}" class="rounded-5 w-100 h-100 position-absolute" style="object-fit: cover;">
                </a>
              </div>
              <div class="position-absolute start-50 translate-middle-x" style="width: 95%; bottom: -3.5rem;">
                <div
                  class="bg-primary-color d-flex flex-column text-white py-2 px-1 align-items-center text-center rounded-5 shadow-lg">
                  <div class="mb-1">
                    <a href="{{ route('com.team.single', $member->id) }}" class="text-white text-decoration-none">
                      <h5 class="font-1 fw-bolder mb-0" style="font-size: 1.1rem;">{{ $member->name }}</h5>
                    </a>
                    <p class="mb-2 fw-semibold" style="font-size: 0.85rem;">{{ $member->designation }}</p>
                  </div>
                  <div class="d-flex gap-2 mb-2">
                    <a href="{{ route('com.therapist.booking', $member->id) }}"
                      class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-primary-color">Book Now</a>
                  </div>
                  <div class="social-box justify-content-center mb-1 d-flex gap-2">
                    @if($member->facebook)
                      <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer"
                        class="d-flex align-items-center justify-content-center text-decoration-none"
                        style="width: 24px; height: 24px;" title="Facebook"><i class="bi bi-facebook text-white fs-6"></i></a>
                    @endif
                    @if($member->twitter)
                      <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer"
                        class="d-flex align-items-center justify-content-center text-decoration-none"
                        style="width: 24px; height: 24px;" title="Twitter"><i class="bi bi-twitter-x text-white fs-6"></i></a>
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
                        style="width: 24px; height: 24px;" title="LinkedIn"><i class="bi bi-linkedin text-white fs-6"></i></a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted-color fs-5">No team members found.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
  <!-- #team end -->

  <!-- Booking Steps Section -->
  <section class="section py-5 text-white bg-gradient-secondary">
    <div class="b-container">
      <div class="row justify-content-center text-center text-xl-start my-5">
        <div class="col-12 col-xl-7">
          <h6 class="text-primary-color fw-semibold mb-2 uppercase">
            {{ $contents['booking_steps']['label'] ?? 'BOOKING PROCESS' }}
          </h6>
          <h2 class="font-1 mb-4 fw-bold" style="font-weight: 800;">
            {!! str_replace(['Book', 'Therapist'], ['<span class="text-primary-color">Book</span>', '<span class="text-primary-color">Therapist</span>'], $contents['booking_steps']['title'] ?? 'How to Book Your Therapist') !!}
          </h2>
        </div>
        <div class="col-12 col-xl-5 mt-4 mt-md-0">
          <p class="mb-4" style="font-size: large;">
            {{ $contents['booking_steps']['description'] ?? 'Select your preferred therapist, choose a convenient time slot, and confirm your appointment in just a few clicks.' }}
          </p>
          <a href="{{ route('com.contact') }}" class="btn btn-primary-solid">Book Appointment Now</a>
        </div>
      </div>

      <hr class="border-white solid border-2 my-5">

      <div class="row text-white mb-0 mb-xl-5 pt-5">
        @for($i = 1; $i <= 3; $i++)
          <div class="step-box col-12 col-lg-4" data-aos="fade-{{ $i == 1 ? 'right' : ($i == 2 ? 'up' : 'left') }}"
            data-aos-easing="linear" data-aos-delay="500" data-aos-duration="1000">
            <h1>0{{ $i }}</h1>
            <h3>{{ $contents['booking_steps']["step_{$i}_title"] ?? '' }}</h3>
            <p>{{ $contents['booking_steps']["step_{$i}_description"] ?? '' }}</p>
          </div>
        @endfor
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="section bg-light py-5">
    <div class="b-container py-5">
      <div class="row align-items-center">
        <div class="col-lg-5 mb-5 mb-lg-0">
          <h2 class="font-1 display-5 fw-bold mb-4">{{ $contents['faqs']['title'] ?? 'Frequently Asked Questions' }}</h2>
          <div class="bg-primary-color p-4 rounded-5 text-white shadow-lg d-inline-block">
            <p class="mb-0 fs-5"><i class="bi bi-info-circle me-2"></i> Need more help?</p>
            <a href="{{ route('com.contact') }}" class="text-white fw-bold">Contact our support team</a>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="accordion" id="teamFaqAccordion">
            @for($i = 1; $i <= 2; $i++)
              @if(isset($contents['faqs']["faq_{$i}_question"]))
                <div class="accordion-item border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button class="accordion-button {{ $i == 1 ? '' : 'collapsed' }} fw-bold" type="button"
                      data-bs-toggle="collapse" data-bs-target="#team-faq-{{ $i }}">
                      {{ $contents['faqs']["faq_{$i}_question"] }}
                    </button>
                  </h2>
                  <div id="team-faq-{{ $i }}" class="accordion-collapse collapse {{ $i == 1 ? 'show' : '' }}"
                    data-bs-parent="#teamFaqAccordion">
                    <div class="accordion-body text-muted">
                      {{ $contents['faqs']["faq_{$i}_answer"] }}
                    </div>
                  </div>
                </div>
              @endif
            @endfor
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Disclaimer Section -->
  <section class="section py-5 mb-5">
    <div class="b-container mb-5">
      <div class="card border-0 bg-secondary-color-2 rounded-5 p-4 shadow-sm">
        <div class="card-body">
          <h4 class="font-1 fw-bold text-dark mb-3"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
            {{ $contents['disclaimer']['title'] ?? 'Disclaimer' }}</h4>
          <p class="mb-0 text-dark fs-5">
            {{ $contents['disclaimer']['content'] ?? '' }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <style>
    .accordion-button:not(.collapsed) {
      background-color: var(--primary-color);
      color: white;
    }

    .accordion-button:focus {
      box-shadow: none;
    }
  </style>

@endsection

@push('js')
  <script>
    // Team page interactions
  </script>
@endpush