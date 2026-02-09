<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Authentication') | {{ $settings['site_name'] ?? 'Mental Health & Therapy' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color:
                {{ $settings['primary_color'] ?? '#044A80' }}
            ;
            --secondary-color:
                {{ $settings['secondary_color'] ?? '#ffbf00' }}
            ;
        }

        body {
            background: linear-gradient(45deg, #8BACEE, #F7D3DA);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>

    <div class="auth-wrapper py-5 w-100">
        <div class="container text-center mb-5">
            @php
                $blackLogo = $settings['site_logo_black'] ?? 'image/black-logo.png';
                $blackLogoUrl = Str::startsWith($blackLogo, 'image/') ? asset($blackLogo) : asset('storage/' . $blackLogo);
            @endphp
            <a href="{{ route('com.home') }}">
                <img src="{{ $blackLogoUrl }}" alt="Logo" style="max-height: 80px;">
            </a>
        </div>

        @yield('content')
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>

    @stack('js')
</body>

</html>