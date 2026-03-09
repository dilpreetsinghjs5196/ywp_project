@extends('site.com.layouts.app')

@section('title', 'Wellness Awareness Hub')

@section('content')
    <!-- Banner Section -->
    @php
        $bannerBg = $settings['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bannerBgUrl = Str::startsWith($bannerBg, 'image/') ? asset($bannerBg) : asset('storage/' . $bannerBg);
        $bannerTitle = 'Blogs';
    @endphp
    <section class="section position-relative"
        style="background: url('{{ $bannerBgUrl }}'); background-size: cover; background-position: center; height: 50vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative text-white" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center">
                <h1 class="display-1 mb-3" style="font-weight: 900; letter-spacing: -1px;">{{ $bannerTitle }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-center align-items-center"
                        style="font-weight: 700; font-size: 1.1rem;">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-white opacity-75"
                                href="{{ route('com.home') }}">Home</a></li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">{{ $bannerTitle }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: "/" !important;
            color: rgba(255, 255, 255, 0.7) !important;
            padding-inline: 10px;
        }
    </style>

    <!-- Themes & Blogs Section -->
    <!-- Themes & Blogs Section (Blogs only) -->
    @foreach($themes as $theme)
        @if($theme->blogs->count() > 0)
            <section class="section py-5 {{ $loop->even ? 'bg-gradient-secondary' : 'bg-white' }}">
                <div class="b-container">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <div>
                            <h2 class="display-5 fw-bold text-primary-color mb-0">{{ $theme->name }}</h2>
                            <div class="bg-secondary-color mt-3" style="height: 4px; width: 80px; border-radius: 2px;"></div>
                        </div>
                        <div class="d-flex gap-3 mb-2">
                            <div class="blog-prev-{{ $theme->id }} cursor-pointer text-primary-color border border-primary-color rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-chevron-left fs-5"></i>
                            </div>
                            <div class="blog-next-{{ $theme->id }} cursor-pointer text-primary-color border border-primary-color rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-chevron-right fs-5"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper blog-slider-{{ $theme->id }} mt-4">
                        <div class="swiper-wrapper">
                            @foreach($theme->blogs as $blog)
                                <div class="swiper-slide h-auto mb-4 px-1">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-entry-card">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('com.blogs.show', $blog->slug) }}">
                                                <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('image/Place-Holder-1920x1280.jpg') }}"
                                                    class="card-img-top blog-card-img" alt="{{ $blog->title }}">
                                            </a>
                                            <div class="blog-date-badge">
                                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Nov 11, 2022' }}
                                            </div>
                                        </div>
                                        <div class="card-body p-4 d-flex flex-column">
                                            <h4 class="card-title fw-bold mb-1 font-1">
                                                <a href="{{ route('com.blogs.show', $blog->slug) }}"
                                                    class="text-decoration-none text-dark hover-primary transition-all">
                                                    {{ $blog->title }}
                                                </a>
                                            </h4>
                                            <p class="card-text text-muted mb-3 fs-6">
                                                {{ $blog->summary ?: Str::limit(strip_tags($blog->content), 100) }}
                                            </p>
                                            <div class="mt-auto pt-3 border-top">
                                                <a href="{{ route('com.blogs.show', $blog->slug) }}"
                                                    class="fw-bold text-primary-color text-decoration-none d-flex align-items-center">
                                                    Read Full Story <i class="bi bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination mt-5 position-relative"></div>
                    </div>
                </div>
            </section>

            @push('js')
                <script>
                    $(document).ready(function () {
                        new Swiper('.blog-slider-{{ $theme->id }}', {
                            slidesPerView: 1,
                            spaceBetween: 30,
                            loop: false,
                            pagination: {
                                el: '.blog-slider-{{ $theme->id }} .swiper-pagination',
                                clickable: true,
                            },
                            navigation: {
                                nextEl: '.blog-next-{{ $theme->id }}',
                                prevEl: '.blog-prev-{{ $theme->id }}',
                            },
                            breakpoints: {
                                768: { slidesPerView: 2 },
                                1200: { slidesPerView: 3 }
                            }
                        });
                    });
                </script>
            @endpush
        @endif
    @endforeach

    <!-- Video Themes & Resources Section -->
    @foreach($videoThemes as $vTheme)
        @if($vTheme->videos->count() > 0)
            <section class="section py-5 {{ $loop->odd ? 'bg-gradient-secondary' : 'bg-white' }}">
                <div class="b-container">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <div>
                            <h2 class="display-5 fw-bold text-primary-color mb-0">{{ $vTheme->name }}</h2>
                            @if($vTheme->description)
                                <p class="text-muted mt-2 mb-0 fs-5"><em>{{ $vTheme->description }}</em></p>
                            @endif
                            <div class="bg-secondary-color mt-3" style="height: 4px; width: 80px; border-radius: 2px;"></div>
                        </div>
                        <div class="d-flex gap-3 mb-2">
                            <div class="video-prev-{{ $vTheme->id }} cursor-pointer text-primary-color border border-primary-color rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-chevron-left fs-5"></i>
                            </div>
                            <div class="video-next-{{ $vTheme->id }} cursor-pointer text-primary-color border border-primary-color rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-chevron-right fs-5"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper video-slider-{{ $vTheme->id }} mt-4 pb-4">
                        <div class="swiper-wrapper">
                            @foreach($vTheme->videos as $video)
                                @php
                                    // Simple youtube ID extractor
                                    $videoId = '';
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->video_url, $match)) {
                                        $videoId = $match[1];
                                    }
                                    $thumbnailUrl = $video->thumbnail ? asset('storage/' . $video->thumbnail) : ($videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : asset('image/Place-Holder-1920x1280.jpg'));
                                @endphp
                                <div class="swiper-slide h-auto mb-4 px-1">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-entry-card">
                                        <div class="position-relative overflow-hidden video-thumbnail-container">
                                            <a href="{{ $video->video_url }}" target="_blank">
                                                <img src="{{ $thumbnailUrl }}" class="card-img-top blog-card-img"
                                                    alt="{{ $video->title }}">
                                                <div class="video-play-overlay">
                                                    <i class="bi bi-play-circle-fill"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body p-4 d-flex flex-column">
                                            <h4 class="card-title fw-bold mb-1 font-1">
                                                <a href="{{ $video->video_url }}" target="_blank"
                                                    class="text-decoration-none text-dark hover-primary transition-all">
                                                    {{ $video->title }}
                                                </a>
                                            </h4>
                                            @if($video->description)
                                                <p class="card-text text-muted mb-0 fs-6">
                                                    {{ Str::limit($video->description, 100) }}
                                                </p>
                                            @endif
                                            <div class="mt-auto pt-3 border-top">
                                                <a href="{{ $video->video_url }}" target="_blank"
                                                    class="fw-bold text-primary-color text-decoration-none d-flex align-items-center">
                                                    Watch Video <i class="bi bi-youtube ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination mt-4 position-relative"></div>
                    </div>
                </div>
            </section>

            @push('js')
                <script>
                    $(document).ready(function () {
                        new Swiper('.video-slider-{{ $vTheme->id }}', {
                            slidesPerView: 1,
                            spaceBetween: 30,
                            loop: false,
                            pagination: {
                                el: '.video-slider-{{ $vTheme->id }} .swiper-pagination',
                                clickable: true,
                            },
                            navigation: {
                                nextEl: '.video-next-{{ $vTheme->id }}',
                                prevEl: '.video-prev-{{ $vTheme->id }}',
                            },
                            breakpoints: {
                                768: { slidesPerView: 2 },
                                1200: { slidesPerView: 3 }
                            }
                        });
                    });
                </script>
            @endpush
        @endif
    @endforeach

    <style>
        .blog-entry-card {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .blog-entry-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .15) !important;
        }

        .blog-card-img {
            aspect-ratio: 16/10;
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
            background-color: #f8f9fa;
        }

        .blog-entry-card:hover .blog-card-img {
            transform: scale(1.08);
        }

        .blog-date-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary-color);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 5;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .hover-primary:hover {
            color: var(--primary-color) !important;
        }

        .blog-entry-card .card-title {
            line-height: 1.2 !important;
            letter-spacing: -0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.4em;
            /* Adjusted min-height for tighter line-height */
        }

        .blog-entry-card .card-text {
            line-height: 1.6;
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 4.8em;
            /* Ensure consistent height for summaries */
        }

        .video-thumbnail-container {
            cursor: pointer;
        }

        .video-play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
            color: white;
            opacity: 0.8;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .video-thumbnail-container:hover .video-play-overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-play-overlay i {
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .bg-overlay-secondary {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: rgba(4, 74, 128, 0.7); */
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection