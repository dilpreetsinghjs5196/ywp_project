<!-- Top Bar -->
<div class="top-bar py-3">
  <div class="b-container">
    <div class="d-flex justify-content-between align-items-center text-white px-3">
      <div class="d-flex align-items-center">
        <div class="pe-3">
          <p class="my-1 py-1">Office Time : Mon - Fri 8:00 - 6:30</p>
        </div>
        &nbsp;|&nbsp;
        <div class="ps-3">
          <p class="my-1 py-1">{{ $settings['office_address'] ?? '123 Serenity Lane, Blissfield, CA 90210' }}</p>
        </div>
      </div>
      <div class="social-box">
        <a href="#" class="fs-5"><i class="bi bi-facebook text-white"></i></a>
        <a href="#" class="fs-5"><i class="bi bi-twitter-x text-white"></i></a>
        <a href="#" class="fs-5"><i class="bi bi-linkedin text-white"></i></a>
      </div>
    </div>
  </div>
</div>

<!-- Header -->
<header class="bg-white">
  <div class="b-container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" aria-label="Offcanvas navbar large">
      <div class="container-fluid">
        <div class="logo-box">
          @php
            $blackLogo = $settings['site_logo_black'] ?? 'image/black-logo.png';
            $blackLogoUrl = Str::startsWith($blackLogo, 'image/') ? asset($blackLogo) : asset('storage/' . $blackLogo);
          @endphp
          <a href="{{ route('com.home') }}" class="navbar-brand">
            <img src="{{ $blackLogoUrl }}" alt="Logo" width="200px"></a>
        </div>
        <button class="navbar-toggler bg-primary-color border-0" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="bi bi-list text-white fs-2"></span>
        </button>
        <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header" id="offcanvasNavbarLabel">
            <div class="logo-drawer">
              <a href="{{ route('com.home') }}" class="navbar-brand"><img src="{{ $blackLogoUrl }}" alt="Drawer Logo"
                  class="img-fluid"></a>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-xl-2 justify-content-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.home') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.home') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.about') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.about') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.about') }}">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.team') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.team') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.team') }}">Our Therapists</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Corporate Well-Being
                </a>
                <!--<ul class="dropdown-menu" style="padding: 20px 10px;">-->
                <!--    <li><a class="dropdown-item" href="services.html">Wellness Hub</a></li>-->
                <!--    <li><a class="dropdown-item" href="service-detail.html">Free Mental Health Tests</a></li>-->
                <!--    <li><a class="dropdown-item" href="appointment.html">Blog</a></li>-->
                <!--</ul>-->
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Wellness Hub
                </a>
                <ul class="dropdown-menu" style="padding: 20px 10px;">
                  <!--<li><a class="dropdown-item" href="services.html">Wellness Hub</a></li>-->
                  <li><a class="dropdown-item" href="service-detail.html">Free Mental Health Tests</a></li>
                  <li><a class="dropdown-item" href="appointment.html">Blog</a></li>
                </ul>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="">Blog</a>
              </li> --}}
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Pages
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="pricing.html">Pricing</a></li>
                  <li><a class="dropdown-item" href="team.html">Team</a></li>
                  <li><a class="dropdown-item" href="blogs.html">Blogs</a></li>
                  <li><a class="dropdown-item" href="blog-detail.html">Blog Detail</a></li>
                  <li><a class="dropdown-item" href="faqs.html">FAQs</a></li>
                  <li><a class="dropdown-item" href="error-404.html">Error 404</a></li>
                </ul>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="">Wonder Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact-us.html">Contact Us</a>
              </li>
              
              <li class="nav-item d-flex align-items-center ms-xl-4">
                @auth
                  <div class="dropdown">
                    <button class="btn btn-primary-solid rounded-pill px-4 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow-sm border-0 p-2">
                      <li><a class="dropdown-item rounded-3" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item rounded-3 text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                          </button>
                        </form>
                      </li>
                    </ul>
                  </div>
                @else
                  <!-- <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary-color rounded-pill px-4">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-solid rounded-pill px-4">Sign Up</a>
                  </div> -->
                @endauth
              </li>
            </ul>
            <!--<div class="">-->
            <!--  <a href="contact-us.html" class="btn btn-modify">-->
            <!--    <i class="bi bi-journal-bookmark-fill pe-2"></i>-->
            <!--    Get Quotes</a>-->
            <!--</div>-->
          </div>
        </div>
      </div>
    </nav>
    <!-- #navbar end -->
  </div>
</header>