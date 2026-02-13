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
            <img src="{{ $blackLogoUrl }}" alt="Logo" width="160"></a>
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
            <ul class="navbar-nav mx-auto mb-2 mb-xl-0 justify-content-center flex-grow-1 pe-3">
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
                <a class="nav-link {{ request()->routeIs('com.services') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.services') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.services') }}">Our Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.team') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.team') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.team') }}">Our Therapists</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.corporate') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.corporate') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.corporate') }}">Corporate Well-Being</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="wellnessDropdown" role="button" data-bs-toggle="dropdown"
                  data-bs-display="static" aria-expanded="false" data-bs-auto-close="outside">
                  Wellness Hub
                </a>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="wellnessDropdown">
                  <li><a class="dropdown-item" href="service-detail.html">Free Mental Health Tests</a></li>
                  <li><a class="dropdown-item" href="appointment.html">Blog</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.store') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.store') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.store') }}">Wonder Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('com.contact') ? 'active' : '' }}" 
                  {{ request()->routeIs('com.contact') ? 'aria-current="page"' : '' }} 
                  href="{{ route('com.contact') }}">Contact Us</a>
              </li>
            </ul>
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0 gap-2">
              @auth
              <div class="dropdown">
                <button class="btn btn-outline-primary position-relative rounded-pill px-3 py-2 border-2 dropdown-toggle no-caret" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle fs-5"></i>
                  <span id="cart-badge-main" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="display: none; padding: 0.35em 0.65em; font-size: 0.7rem; z-index: 10;">
                    0
                  </span>
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
              <a href="{{ route('com.cart') }}" class="btn btn-outline-primary position-relative rounded-pill px-3 py-2 border-2 {{ request()->routeIs('com.cart') ? 'active' : '' }}" title="Shopping Cart">
                <i class="bi bi-cart3 fs-5"></i>
                <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="display: none; padding: 0.35em 0.65em; font-size: 0.7rem; z-index: 10;">
                  0
                </span>
              </a>
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

    // Mobile dropdown toggle fix for offcanvas
    const dropdownToggles = document.querySelectorAll('.offcanvas-body .dropdown-toggle');
    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        if (window.innerWidth < 992) {
          e.preventDefault();
          e.stopPropagation();
          const menu = this.nextElementSibling;
          if (menu && menu.classList.contains('dropdown-menu')) {
            const isShown = menu.classList.contains('show');
            // Close all other dropdowns in offcanvas
            document.querySelectorAll('.offcanvas-body .dropdown-menu.show').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.offcanvas-body .dropdown-toggle.show').forEach(t => t.classList.remove('show'));
            
            if (!isShown) {
              menu.classList.add('show');
              this.classList.add('show');
            }
          }
        }
      });
    });
  });
</script>