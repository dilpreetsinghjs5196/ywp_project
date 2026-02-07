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

<!-- Why Choose Our Team Section -->
<section class="section py-5 bg-accent-color-3">
  <div class="b-container">
    <div class="row text-center mb-5" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200" data-aos-duration="1000">
      <div class="col-lg-8 mx-auto">
        <h6 class="text-primary-color fw-semibold mb-2">WHY CHOOSE US</h6>
        <h2 class="font-1" style="font-weight: 800;">
          What Sets Our Team Apart
        </h2>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="100" data-aos-duration="1000">
        <div class="card border-0 rounded-4 h-100 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-5 text-primary-color mb-3">
              <i class="bi bi-mortarboard"></i>
            </div>
            <h5 class="font-1 fw-bold mb-2">Highly Qualified</h5>
            <p class="text-muted-color">Licensed and certified mental health professionals with years of experience.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200" data-aos-duration="1000">
        <div class="card border-0 rounded-4 h-100 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-5 text-primary-color mb-3">
              <i class="bi bi-heart"></i>
            </div>
            <h5 class="font-1 fw-bold mb-2">Compassionate Care</h5>
            <p class="text-muted-color">We listen, understand, and provide genuine support for your mental health journey.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="300" data-aos-duration="1000">
        <div class="card border-0 rounded-4 h-100 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-5 text-primary-color mb-3">
              <i class="bi bi-person-check"></i>
            </div>
            <h5 class="font-1 fw-bold mb-2">Personalized Approach</h5>
            <p class="text-muted-color">Each therapy plan is tailored to your unique needs and goals.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="400" data-aos-duration="1000">
        <div class="card border-0 rounded-4 h-100 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="display-5 text-primary-color mb-3">
              <i class="bi bi-shield-lock"></i>
            </div>
            <h5 class="font-1 fw-bold mb-2">Confidential & Safe</h5>
            <p class="text-muted-color">Your privacy is our priority. All sessions are completely confidential.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- #why-choose-us end -->

<!-- CTA Section -->
<section class="section py-5 bg-gradient-secondary text-white">
  <div class="b-container">
    <div class="row text-center" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="200" data-aos-duration="1000">
      <div class="col-lg-8 mx-auto">
        <h2 class="font-1 mb-4" style="font-weight: 800;">
          Ready to Start Your Wellness Journey?
        </h2>
        <p class="fs-5 mb-4">Connect with one of our therapists today and take the first step toward a healthier, happier you.</p>
        <a href="{{ route('com.home') }}" class="btn btn-primary-solid btn-lg">Schedule Your Appointment</a>
      </div>
    </div>
  </div>
</section>
<!-- #cta end -->

@endsection

@push('js')
<script>
  // Add any team-specific JavaScript here if needed
</script>
@endpush
