<!-- Footer -->
<footer class="footer py-5 px-4">
  <div class="footer-background"></div>
  <div class="b-container">
    <div class="row row-cols-1 pt-5 px-0">
      <div class="footer-logo col-12 col-lg-3 mb-5 text-lg-start text-center">
        @php
          $whiteLogo = $settings['site_logo'] ?? 'image/white-logo.png';
          $whiteLogoUrl = Str::startsWith($whiteLogo, 'image/') ? asset($whiteLogo) : asset('storage/' . $whiteLogo);
        @endphp
        <img src="{{ $whiteLogoUrl }}" alt="Footer Logo" width="200px">
        <p class="my-4">
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
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
        <h4 class="text-secondary-color-2 mb-4">Contact</h4>
        <p>{{ $settings['office_address'] ?? '123 Serenity Lane, Blissfield, CA 90210, United States' }}</p>
        <p>{{ $settings['contact_email'] ?? 'Info@yourmail.com' }}</p>
        <p>{{ $settings['contact_phone'] ?? '(555) 123-4567' }}</p>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
        <h4 class="text-secondary-color-2 mb-4">Quick Links</h4>
        <ul class="d-flex flex-column p-0">
          <li class="mb-2"><a href="{{ route('com.home') }}" class="links-secondary">Homepage</a></li>
          <li class="mb-2"><a href="{{ route('com.about') }}" class="links-secondary">About Us</a></li>
          <li class="mb-2"><a href="{{ route('com.contact') }}" class="links-secondary">Contact Us</a></li>
          <li class="mb-2"><a href="{{ route('com.corporate') }}" class="links-secondary">Corporate Well-Being</a></li>
          <li class="mb-2"><a href="#" class="links-secondary">Services</a></li>
          <li class="mb-2"><a href="#" class="links-secondary">Appointment</a></li>
          <li class="mb-2"><a href="blogs.html" class="links-secondary">Privacy Policy</a></li>
          <li class="mb-2"><a href="faqs.html" class="links-secondary">Terms & Conditions</a></li>
        </ul>
      </div>
      <div class="col-12 col-md-4 col-lg-3 mb-3 text-md-start text-center">
        <h4
          class="font-1 fw-bolder text-secondary-color-2 mb-4 justify-content-md-start justify-content-center align-items-center mt-md-0 mt-sm-4">
          Newsletter</h4>
        <p class="fw-bolder">Get the latest news other tips.</p>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast success_msg_subscribe text-bg-light" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                <i class="bi bi-check-circle-fill"></i> Your Subscribe Send Successfully.
              </div>
              <button type="button" class="btn me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
          </div>
        </div>
        <form class="d-flex flex-column w-100 gap-2 needs-validation" novalidate>
          <input type="text" name="action" value="subscribe" hidden>
          <input type="email" name="email" class="form-control form-control-lg rounded-5" placeholder="Your email here"
            required>
          <div class="invalid-feedback text-white">
            Please provide a valid email format (e.g.,
            user@example.com).
          </div>
          <button type="submit" class="btn btn-block btn-secondary-solid submit_subscribe">Subscribe
            now</button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center py-4 mt-4 border-top">
      <p class="text-center w-100 mb-0">Copyright &copy; 2025 Widagdos. All Rights Reserved. Designed by <a
          href="https://japnaazsoftware.com/" target="_blank" style="color: #ffbf00;font-weight: 600;">Japnaaz
          Software</a></p>
    </div>
  </div>
</footer>
<!-- #footer end -->