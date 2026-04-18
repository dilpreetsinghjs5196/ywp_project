<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'YWP')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #044A80;
            --secondary-color: #ffbf00;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7f6;
            overflow-x: hidden;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--primary-color);
            min-height: 100vh;
            color: white;
            transition: all 0.3s;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1001;
            display: flex;
            flex-direction: column;
        }

        /* Hide scrollbar for sidebar but keep functionality */
        .sidebar-nav-container {
            flex-grow: 1;
            overflow-y: auto;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .sidebar-nav-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari and Opera */
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            margin: 5px 15px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            width: 100%;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 10px;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: #033a66;
        }

        /* Responsive Sidebar */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -250px;
                position: fixed;
            }

            .sidebar.active {
                margin-left: 0;
            }

            /* Enable scrollbar visually on mobile to indicate scrollability */
            .sidebar-nav-container {
                scrollbar-width: thin;
                -ms-overflow-style: auto;
            }

            .sidebar-nav-container::-webkit-scrollbar {
                display: block;
                width: 4px;
            }

            .sidebar-nav-container::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 10px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                top: 0;
                left: 0;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        /* Pagination Styling */
        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: var(--primary-color);
            padding: 0.4rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 5px;
            margin: 0 2px;
            border: 1px solid #e9ecef;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .pagination .page-item:not(.active) .page-link:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: var(--primary-color);
        }

        .pagination svg {
            width: 1rem;
            height: 1rem;
        }

        .pagination nav .flex.justify-between {
            display: none !important;
        }

        /* Custom Pagination Container */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        @media (max-width: 575.98px) {
            .pagination-wrapper {
                justify-content: center;
                text-align: center;
            }
        }
    </style>
    @stack('css')
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column" id="sidebar">
            <div class="p-4 text-center">
                <h4 class="fw-bold">YWP Admin</h4>
            </div>
            <div class="sidebar-nav-container">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-uppercase small fw-bold mt-3 opacity-50 px-4">Site Content</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pages/home*') ? 'active' : '' }}"
                            href="{{ route('admin.pages.edit', 'home') }}">
                            <i class="bi bi-house"></i> Home Page
                        </a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link {{ request()->routeIs('admin.home-hero-slides.*') ? 'active' : '' }}"
                            href="{{ route('admin.home-hero-slides.index') }}">
                            <i class="bi bi-images"></i> Hero Slides
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link"
                            href="">
                            <i class="bi bi-info-circle"></i> About Us
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pages/team*') ? 'active' : '' }}"
                            href="{{ route('admin.pages.edit', 'team') }}">
                            <i class="bi bi-people"></i> Our Team Page
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pages/corporate*') ? 'active' : '' }}"
                            href="{{ route('admin.pages.edit', 'corporate') }}">
                            <i class="bi bi-building"></i> Corporate Page
                        </a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}"
                            href="{{ route('admin.brands.index') }}">
                            <i class="bi bi-award"></i> Brand Partners
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pages/services*') ? 'active' : '' }}"
                            href="{{ route('admin.pages.edit', 'services') }}">
                            <i class="bi bi-gear"></i> Services Page
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                            href="{{ route('admin.services.index') }}">
                            <i class="bi bi-grid"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}"
                            href="{{ route('admin.teams.index') }}">
                            <i class="bi bi-people"></i> Team Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.blog-themes.*') ? 'active' : '' }}"
                            href="{{ route('admin.blog-themes.index') }}">
                            <i class="bi bi-collection"></i> Blog Themes
                        </a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                            href="{{ route('admin.blogs.index') }}">
                            <i class="bi bi-journal-text"></i> Blog Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.video-themes.*') ? 'active' : '' }}"
                            href="{{ route('admin.video-themes.index') }}">
                            <i class="bi bi-tags"></i> Video Themes
                        </a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link {{ request()->routeIs('admin.blog-videos.*') ? 'active' : '' }}"
                            href="{{ route('admin.blog-videos.index') }}">
                            <i class="bi bi-play-btn"></i> Blog Videos
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                            href="{{ route('admin.testimonials.index') }}">
                            <i class="bi bi-chat-left-quote"></i> Testimonials
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                            href="{{ route('admin.reviews.index') }}">
                            <i class="bi bi-star-half"></i> Therapist Reviews
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}"
                            href="{{ route('admin.appointments.index') }}">
                            <i class="bi bi-envelope-paper"></i> Appointment Queries
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <div class="nav-link text-uppercase small fw-bold mt-3 opacity-50 px-4">Wonder Store</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.wonder-store-categories.*') ? 'active' : '' }}"
                            href="{{ route('admin.wonder-store-categories.index') }}">
                            <i class="bi bi-tags"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.wonder-store-products.*') ? 'active' : '' }}"
                            href="{{ route('admin.wonder-store-products.index') }}">
                            <i class="bi bi-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pages/wonder_store') ? 'active' : '' }}"
                            href="{{ route('admin.pages.edit', 'wonder_store') }}">
                            <i class="bi bi-layout-text-window"></i> Banner & Title
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-uppercase small fw-bold mt-3 opacity-50 px-4">Queries & Bookings</div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                            href="{{ route('admin.bookings.index') }}">
                            <i class="bi bi-question-circle"></i> Appointment Queries
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}"
                            href="{{ route('admin.appointments.index') }}">
                            <i class="bi bi-envelope-paper"></i> Appointment Queries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.therapist-bookings.*') ? 'active' : '' }}"
                            href="{{ route('admin.therapist-bookings.index') }}">
                            <i class="bi bi-calendar-check"></i> Therapist Bookings
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-uppercase small fw-bold mt-3 opacity-50 px-4">Settings</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.branding') ? 'active' : '' }}"
                            href="{{ route('admin.settings.branding') }}">
                            <i class="bi bi-palette"></i> Branding & Colors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.contact') ? 'active' : '' }}"
                            href="{{ route('admin.settings.contact') }}">
                            <i class="bi bi-telephone"></i> Footer & Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.mail') ? 'active' : '' }}"
                            href="{{ route('admin.settings.mail') }}">
                            <i class="bi bi-envelope-at"></i> SMTP Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.google') ? 'active' : '' }}"
                            href="{{ route('admin.settings.google') }}">
                            <i class="bi bi-calendar-range"></i> Google Calendar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.payment') ? 'active' : '' }}"
                            href="{{ route('admin.settings.payment') }}">
                            <i class="bi bi-credit-card"></i> Payment Gateway
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-uppercase small fw-bold mt-3 opacity-50 px-4">Access Control</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                            href="{{ route('admin.roles.index') }}">
                            <i class="bi bi-shield-lock"></i> Manage Roles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                            href="{{ route('admin.users.index') }}">
                            <i class="bi bi-person-gear"></i> User Roles
                        </a>
                    </li>
                </ul>
            </div>
            <div class="p-4 border-top border-light">
                <a href="#" class="nav-link p-0 text-white opacity-75"
                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content d-flex flex-column">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg px-3 px-md-4 py-3">
                <div class="container-fluid">
                    <button class="btn btn-outline-primary d-lg-none me-2" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="navbar-text fw-bold text-dark">
                        @yield('page_title', 'Dashboard')
                    </span>
                    <div class="ms-auto d-flex align-items-center">
                        <a href="{{ route('com.home') }}" target="_blank"
                            class="btn btn-sm btn-outline-primary me-2 me-md-3 d-none d-sm-inline-flex">
                            <i class="bi bi-eye"></i> View Site
                        </a>
                        <div class="dropdown">
                            <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5 me-1"></i> <span
                                    class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                            class="bi bi-person me-2"></i> My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="container-fluid p-3 p-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        });

        document.getElementById('sidebarOverlay').addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('active');
            this.classList.remove('active');
        });
    </script>
    @stack('scripts')
    @stack('js')
</body>

</html>