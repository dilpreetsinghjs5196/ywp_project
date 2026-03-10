<!-- Footer -->
<footer class="footer py-5 px-4">
  <div class="footer-background"></div>
  <div class="b-container">
    <div class="row pt-5 gx-lg-5 px-0">
      <div class="footer-logo col-12 col-lg-5 mb-5 mb-lg-0 text-lg-start text-center">
        @php
          $whiteLogo = $settings['site_logo'] ?? 'image/white-logo.png';
          $whiteLogoUrl = Str::startsWith($whiteLogo, 'image/') ? asset($whiteLogo) : asset('storage/' . $whiteLogo);
        @endphp
        <img src="{{ $whiteLogoUrl }}" alt="Footer Logo" width="200px">
        <p class="my-4 pe-lg-5">
          {{ $settings['footer_about'] ?? 'Professional, responsive, and soothing design for therapists, counselors, and life coaches.' }}
        </p>
        <div class="social-box d-flex justify-content-lg-start justify-content-center w-100">
          <a href="https://www.facebook.com" class="rounded-5 py-2" style="width: 40px; height: 40px;"><i
              class="bi bi-facebook text-white"></i></a>
          <a href="https://x.com" class="rounded-5 py-2" style="width: 40px; height: 40px;"><i
              class="bi bi-twitter-x text-white"></i></a>
          <a href="https://www.linkedin.com" class="rounded-5 py-2" style="width: 40px; height: 40px;"><i
              class="bi bi-linkedin text-white"></i></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-4 mb-5 mb-lg-0 text-lg-start text-center">
        <h4 class="text-secondary-color-2 mb-4">Contact</h4>
        <div class="d-flex flex-column align-items-lg-start align-items-center">
          <p class="mb-3">{{ $settings['office_address'] ?? '22, Asaf Ali Rd, Kucha Pati Ram, Ajmeri Gate, New Delhi' }}</p>
          <p class="text-break mb-0">
            <a href="mailto:{{ $settings['contact_email'] ?? 'workplacewellbeingbyywp@gmail.com' }}"
              class="links-secondary">
              {{ $settings['contact_email'] ?? 'workplacewellbeingbyywp@gmail.com' }}
            </a>
          </p>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 mb-0 text-lg-start text-center">
        <h4 class="text-secondary-color-2 mb-4">Quick Links</h4>
        <ul class="d-flex flex-column p-0 align-items-lg-start align-items-center">
          <li class="mb-2"><a href="{{ route('com.home') }}" class="links-secondary">Homepage</a></li>
          <li class="mb-2"><a href="{{ route('com.corporate') }}" class="links-secondary">Corporate Well-Being</a></li>
          <li class="mb-2"><a href="{{ route('com.services') }}" class="links-secondary">Services</a></li>
          <li class="mb-2"><a href="{{ route('com.team') }}" class="links-secondary">Appointment</a></li>
          <li class="mb-2"><a href="#" class="links-secondary">Privacy Policy</a></li>
          <li class="mb-2"><a href="#" class="links-secondary">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
    <div class="row justify-content-center py-4 mt-5 border-top">
      <p class="text-center w-100 mb-0">Copyright &copy; 2025 Widagdos. All Rights Reserved. Designed by <a
          href="https://japnaazsoftware.com/" target="_blank" style="color: #ffbf00;font-weight: 600;">Japnaaz
          Software</a></p>
    </div>
  </div>
</footer>
<!-- #footer end -->