<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Panel - @yield('title', 'YWP')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #044A80;
            --sidebar-bg: #044A80;
            --sidebar-gradient: linear-gradient(180deg, #044A80 0%, #03365d 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            min-width: 260px;
            max-width: 260px;
            background: var(--sidebar-bg);
            background-image: var(--sidebar-gradient);
            min-height: 100vh;
            color: white;
            transition: all 0.3s;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1001;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.6);
            border-radius: 8px;
            margin: 4px 18px;
            padding: 12px 18px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            background: var(--primary-color) !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(92, 103, 242, 0.3);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            min-width: 0;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 12px;
        }
    </style>
    @stack('css')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column" id="sidebar">
            <div class="p-4 text-center">
                <h4 class="fw-bold">YWP Therapist</h4>
                <p class="small text-muted mb-0">Professional Portal</p>
            </div>
            <hr class="mx-3 opacity-25">
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.dashboard') ? 'active' : '' }}"
                        href="{{ route('therapist.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.bookings') ? 'active' : '' }}"
                        href="{{ route('therapist.bookings') }}">
                        <i class="bi bi-calendar-check"></i> My Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.clients') ? 'active' : '' }}"
                        href="{{ route('therapist.clients') }}">
                        <i class="bi bi-people"></i> My Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.availability') ? 'active' : '' }}"
                        href="{{ route('therapist.availability') }}">
                        <i class="bi bi-calendar3"></i> Availability
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.profile') ? 'active' : '' }}"
                        href="{{ route('therapist.profile') }}">
                        <i class="bi bi-person-circle"></i> Profile & Rates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('therapist.reviews') ? 'active' : '' }}"
                        href="{{ route('therapist.reviews') }}">
                        <i class="bi bi-star"></i> Reviews
                    </a>
                </li>
            </ul>
            <div class="p-4 border-top border-secondary">
                <a href="#" class="nav-link p-0 text-white opacity-75"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <nav class="navbar navbar-expand-lg px-4 py-3">
                <div class="container-fluid">
                    <span class="navbar-text fw-bold text-dark fs-5">
                        @yield('page_title', 'Dashboard')
                    </span>
                    <div class="ms-auto d-flex align-items-center">
                        <a href="{{ route('com.home') }}" target="_blank" class="btn btn-sm btn-outline-primary me-3">
                            <i class="bi bi-eye"></i> View Site
                        </a>
                        <div class="dropdown">
                            <a class="text-dark text-decoration-none dropdown-toggle d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown">
                                <div class="me-2 text-end d-none d-sm-block">
                                    <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">Therapist</div>
                                </div>
                                <i class="bi bi-person-circle fs-4"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="{{ route('therapist.profile') }}">My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>

</html>