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
            <p class="my-1 py-1">123 Serenity Lane, Blissfield, CA 90210</p>
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
            <a href="index.html" class="navbar-brand">
              <img src="{{ asset('image/black-logo.png') }}" alt="Logo" width="200px"></a>
          </div>
          <button class="navbar-toggler bg-primary-color border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="bi bi-list text-white fs-2"></span>
          </button>
          <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header" id="offcanvasNavbarLabel">
              <div class="logo-drawer">
                <a href="index.html" class="navbar-brand"><img src="{{ asset('image/black-logo.png') }}" alt="Drawer Logo"
                    class="img-fluid"></a>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-xl-2 justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('com.about') }}">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#">
                            Our Therapists
                            </a>
                            {{-- <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="services.html">Our Therapists</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="service-detail.html">Service Detail</a></li>
                                <li><a class="dropdown-item" href="appointment.html">Appointment</a></li> --}}
                            {{-- </ul> --}}
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