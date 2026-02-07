<!-- Top Bar -->
<div class="top-bar">
    <div class="b-container">
        <div class="d-flex justify-content-between align-items-center text-white px-3">
            <div class="d-flex align-items-center">
                <p class="my-1 py-1 pe-3">Office Time : Mon - Fri 8:00 - 6:30</p>
                |
                <p class="my-1 py-1 ps-3">123 Serenity Lane, Blissfield, CA</p>
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
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('image/black-logo.png') }}" alt="Logo" width="200px" >
            </a>

            <button class="navbar-toggler bg-primary-color" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#menu">
                <span class="bi bi-list text-white fs-2"></span>
            </button>

            <div class="offcanvas offcanvas-start" id="menu">
                <div class="offcanvas-header">
                    <img src="{{ asset('image/logo2.png') }}" alt="Logo">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-xl-4 justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="about-us.html">About Us</a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Corporate Well-Being
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="services.html">Wellness Hub</a></li>
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
                    <a href="#" class="btn btn-modify">Get Quotes</a>
                </div>
            </div>
        </nav>
    </div>
</header>