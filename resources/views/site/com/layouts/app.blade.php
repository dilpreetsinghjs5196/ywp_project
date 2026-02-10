<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Mental Health & Therapy')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('css/vendor/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/swiper-bundle.min.css') }}">
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
    </style>
</head>

<body>

    {{-- Header --}}
    @include('site.com.partials.header')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('site.com.partials.footer')

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/aos.js') }}"></script>
    <script src="{{ asset('js/vendor/swiper-bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/video-player.js') }}"></script>
    <script src="{{ asset('js/script-counter.js') }}"></script>
    <script src="{{ asset('js/script-swiper.js') }}"></script>

    <script>
        AOS.init();
    </script>

    @stack('js')
</body>

</html>