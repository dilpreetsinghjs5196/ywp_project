<!-- Top Bar -->
<div class="top-bar py-3">
  <div class="b-container">
    <div class="d-flex justify-content-between align-items-center text-white px-3">
      <div class="d-flex align-items-center">
        <div class="pe-3 border-end">
          @if(!empty($settings['therapist_application_url']))
            <a href="{{ $settings['therapist_application_url'] }}" target="_blank"
               class="text-white text-decoration-none fw-bold small d-flex align-items-center bg-primary-color px-3 py-1 rounded-pill">
              <i class="bi bi-person-plus-fill me-2"></i> JOIN US
            </a>
          @else
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#joinUsModal"
               class="text-white text-decoration-none fw-bold small d-flex align-items-center bg-primary-color px-3 py-1 rounded-pill" style="cursor: pointer;">
              <i class="bi bi-person-plus-fill me-2"></i> JOIN US
            </a>
          @endif
        </div>
        <div class="ps-3">
          <p class="my-1 py-1 small">{{ $settings['office_address'] ?? '123 Serenity Lane, Blissfield, CA 90210' }}</p>
        </div>
      </div>
      <div class="social-box">
        <a href="https://www.facebook.com/yourewonderfulproject" class="fs-5" target="_blank"><i class="bi bi-facebook text-white"></i></a>
        <a href="https://www.instagram.com/yourewonderfulproject/?hl=en" class="fs-5" target="_blank"><i class="bi bi-instagram text-white"></i></a>
        <a href="https://www.linkedin.com/company/ywpindia/" class="fs-5" target="_blank"><i class="bi bi-linkedin text-white"></i></a>
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
          <a href="{{ route('com.home') }}" class="navbar-brand me-0">
            <img src="{{ $blackLogoUrl }}" alt="Logo" class="main-logo"></a>
        </div>
        
        <!-- Mobile/Tablet Login Button (Center) -->
        <div class="d-lg-none flex-grow-1 text-center">
          @auth
            <a href="{{ route('com.profile') }}" class="btn btn-outline-primary rounded-pill px-3 py-1 small fw-bold">
              Profile
            </a>
          @else
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary rounded-pill px-3 py-1 small fw-bold">Login</a>
          @endguest
        </div>

        <button class="navbar-toggler bg-primary-color border-0 ms-auto" type="button" data-bs-toggle="offcanvas"
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
            <ul class="navbar-nav mx-auto mb-2 mb-xl-0 justify-content-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.home') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.home') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.services') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.services') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.services') }}">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.team') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.team') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.team') }}">Therapists</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.corporate') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.corporate') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.corporate') }}">Corporate Well-Being</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('com.blogs.*') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.blogs.*') ? 'aria-current="page"' : '' }}
                  href="{{ route('com.blogs.index') }}" id="wellnessDropdown" role="button" data-bs-toggle="dropdown"
                  data-bs-display="static" aria-expanded="false" data-bs-auto-close="outside">
                  Wellness Hub
                </a>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="wellnessDropdown">
                  <!-- <li><a class="dropdown-item" href="service-detail.html">Free Mental Health Tests</a></li> -->
                  <li><a class="dropdown-item" href="{{ route('com.blogs.index') }}">Blog</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.store') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.store') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.store') }}">Wonder Store</a>
              </li>
            </ul>
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0 gap-2">
              @auth
              <div class="dropdown">
                <button class="btn btn-outline-primary position-relative rounded-pill px-3 py-2 border-2 dropdown-toggle no-caret" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle fs-5 me-1"></i> Profile
                  @if(request()->routeIs('com.store'))
                    <span id="cart-badge-main" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="display: none; padding: 0.35em 0.65em; font-size: 0.7rem; z-index: 10;">
                      0
                    </span>
                  @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-2" aria-labelledby="userMenu">
                  <li>
                    <a class="dropdown-item py-2 px-4 rounded-top-4" href="{{ route('com.profile') }}">
                      <i class="bi bi-person me-2"></i> My Profile
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item py-2 px-4 d-flex justify-content-between align-items-center" href="{{ route('com.cart') }}">
                      <span><i class="bi bi-cart3 me-2"></i> My Cart</span>
                      <span id="cart-badge-dropdown" class="badge rounded-pill bg-danger ms-2" style="display: none;">0</span>
                    </a>
                  </li>
                  <li><hr class="dropdown-divider mx-3"></li>
                  <li>
                    <a class="dropdown-item py-2 px-4 text-danger rounded-bottom-4" href="{{ route('com.logout') }}">
                      <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                  </li>
                </ul>
              </div>
              @else
              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary rounded-pill px-4 py-2 fw-bold text-uppercase d-none d-lg-inline-flex me-2">
                Login
              </a>
              @if(request()->routeIs('com.store'))
                <a href="{{ route('com.cart') }}" class="btn btn-outline-primary position-relative rounded-pill px-3 py-2 border-2 {{ request()->routeIs('com.cart') ? 'active' : '' }}" title="Shopping Cart">
                  <i class="bi bi-cart3 fs-5"></i>
                  <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="display: none; padding: 0.35em 0.65em; font-size: 0.7rem; z-index: 10;">
                    0
                  </span>
                </a>
              @endif
              @endauth
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- #navbar end -->
  </div>
</header>

<style>
  .no-caret::after { display: none !important; }
  #userMenu:hover, #guestMenu:hover { background-color: var(--primary-color); color: white; }

  /* Show dropdown on hover for desktop */
  @media (min-width: 992px) {
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initial cart count
    if (typeof updateCartBadge === 'undefined') {
        window.updateCartBadge = function() {
            $.ajax({
                url: "{{ route('cart.count') }}",
                type: 'GET',
                success: function(data) {
                    const badges = $('#cart-badge, #cart-badge-main');
                    const dropdownBadge = $('#cart-badge-dropdown');
                    if (data.count > 0) {
                        badges.text(data.count).attr('style', 'display: block !important; padding: 0.35em 0.65em; font-size: 0.7rem; z-index: 10;');
                        dropdownBadge.text(data.count).show();
                    } else {
                        badges.hide();
                        dropdownBadge.hide();
                    }
                },
                error: function() {
                    console.error('Failed to fetch cart count');
                }
            });
        }
    }
    
    updateCartBadge();

    // Dropdown handling: Mobile toggle & Desktop navigation
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        if (window.innerWidth >= 992) {
          // On desktop, navigate to the link if it has a valid href
          const href = this.getAttribute('href');
          if (href && href !== '#' && href !== 'javascript:void(0)') {
            window.location.href = href;
          }
        }
      });
    });
  });
</script>

<style>
  .main-logo {
    width: auto;
    max-height: 80px;
    transition: all 0.3s ease;
  }
  @media (max-width: 991.98px) {
    .main-logo {
      max-height: 50px;
    }
    .navbar-toggler {
      padding: 0.25rem 0.5rem;
    }
    .navbar-toggler span {
      font-size: 1.5rem !important;
    }
  }
</style>