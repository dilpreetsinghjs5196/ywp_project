@extends('site.com.layouts.app')

@section('title', 'Our Team - Meet Our Therapists')

@section('content')
<!-- Banner Section -->
<section class="section position-relative"
  style="background-image: url('{{ asset('image/footer-img.jpg') }}'); height: 40vh;">
  <div class="bg-overlay-secondary"></div>
  <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
    <div
      class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
      <h1 class="display-2 mb-0" style="font-weight: 900;">Our Team</h1>
      <nav aria-label="breadcrumb" style="font-weight: 900;">
        <ol class="breadcrumb justify-content-center align-items-center">
          <li class="breadcrumb-item font-1 {{ request()->routeIs('com.home') ? 'active' : '' }}">
            <a class="text-decoration-none {{ request()->routeIs('com.home') ? 'text-white' : 'text-primary-color' }}" 
              href="{{ route('com.home') }}"
              {{ request()->routeIs('com.home') ? 'aria-current="page"' : '' }}>Homepage</a>
          </li>
          <li class="breadcrumb-item {{ request()->routeIs('com.team') ? 'text-white active' : 'text-white' }}" 
            {{ request()->routeIs('com.team') ? 'aria-current="page"' : '' }}>
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
    <div class="row text-center mb-5" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200" data-aos-duration="1000">
      <div class="col-lg-8 mx-auto">
        <h6 class="text-primary-color fw-semibold mb-2">OUR SPECIALIST</h6>
        <h2 class="font-1 mb-4" style="font-weight: 800;">
          Meet Our Dedicated Team of Therapists & Counselors
        </h2>
        <p class="text-muted-color" style="font-size: large;">
          Our team consists of highly qualified and compassionate mental health professionals committed to supporting your journey toward emotional wellness and personal growth.
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
              <img
                src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
                alt="{{ $member->name }}" class="rounded-5 w-100 h-100 position-absolute" style="object-fit: cover;">
            </div>
            <div class="position-absolute start-50 translate-middle-x" style="width: 95%; bottom: -3rem;">
              <div
                class="bg-primary-color d-flex flex-column text-white py-2 px-1 align-items-center text-center rounded-5 shadow-lg">
                <div class="mb-1">
                  <h5 class="font-1 fw-bolder mb-0" style="font-size: 1.1rem;">{{ $member->name }}</h5>
                  <p class="mb-2 fw-semibold" style="font-size: 0.85rem;">{{ $member->designation }}</p>
                </div>
                <div class="social-box justify-content-center mb-1 d-flex gap-2">
                  @if($member->facebook)
                    <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center text-decoration-none" 
                      style="width: 24px; height: 24px;" title="Facebook"><i class="bi bi-facebook text-white fs-6"></i></a>
                  @endif
                  @if($member->twitter)
                    <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center text-decoration-none" 
                      style="width: 24px; height: 24px;" title="Twitter"><i class="bi bi-twitter-x text-white fs-6"></i></a>
                  @endif
                  @if($member->instagram)
                    <a href="{{ $member->instagram }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center text-decoration-none" 
                      style="width: 24px; height: 24px;" title="Instagram"><i class="bi bi-instagram text-white fs-6"></i></a>
                  @endif
                  @if($member->linkedin)
                    <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center text-decoration-none" 
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

<section class="section py-5 text-white bg-gradient-secondary" style="margin-top: 3rem !important;">
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

@endsection

@push('js')
<script>
  // Add any team-specific JavaScript here if needed
</script>
@endpush
