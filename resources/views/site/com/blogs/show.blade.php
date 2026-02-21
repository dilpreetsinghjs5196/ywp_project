@extends('site.com.layouts.app')

@section('title', $blog->title)

@section('content')
    <!-- Banner Section -->
    @php
        $bannerBg = $settings['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bannerBgUrl = Str::startsWith($bannerBg, 'image/') ? asset($bannerBg) : asset('storage/' . $bannerBg);
    @endphp
    <section class="section position-relative"
        style="background: url('{{ $bannerBgUrl }}'); background-size: cover; background-position: center; height: 50vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative text-white" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center">
                <h1 class="display-3 mb-3 fw-bold">{{ $blog->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-center align-items-center"
                        style="font-weight: 700; font-size: 1.1rem;">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-white opacity-75"
                                href="{{ route('com.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none text-white opacity-75"
                                href="{{ route('com.blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">Blog Detail</li>
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

    <!-- Blog Content Section -->
    <section class="section py-5 bg-white">
        <div class="b-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5" data-aos="fade-up">
                        <div class="d-flex justify-content-center align-items-center gap-3 text-muted mb-3 fs-6">
                            <span><i class="bi bi-calendar3 me-1 text-primary-color"></i>
                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Nov 11, 2022' }}</span>
                            <span>|</span>
                            <span
                                class="badge bg-secondary-color text-dark px-3 py-2 rounded-pill">{{ $blog->theme->name }}</span>
                        </div>
                    </div>

                    <div class="rounded-5 overflow-hidden shadow-lg mb-5" data-aos="zoom-in"
                        style="background-color: #f8f9fa;">
                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('image/Place-Holder-1920x1280.jpg') }}"
                            alt="{{ $blog->title }}" class="w-100 object-fit-cover shadow-inner"
                            style="height: 500px; object-position: center;">
                    </div>

                    <div class="blog-content fs-5 lh-lg mb-5 text-dark" data-aos="fade-up">
                        {!! $blog->content !!}
                    </div>


                    <!-- Related Stories -->
                    @if($relatedBlogs->count() > 0)
                        <div class="related-blogs p-4 p-md-5 bg-gradient-secondary rounded-5 mt-5 shadow-sm" data-aos="fade-up">
                            <h3 class="fw-bold fs-2 mb-4 text-primary-color">Related Stories</h3>
                            <div class="row g-4">
                                @foreach($relatedBlogs as $related)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-hover-card">
                                            <a href="{{ route('com.blogs.show', $related->slug) }}">
                                                <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('image/Place-Holder-1920x1280.jpg') }}"
                                                    class="card-img-top object-fit-cover" style="height: 180px;"
                                                    alt="{{ $related->title }}">
                                            </a>
                                            <div class="card-body p-4">
                                                <h6 class="fw-bold mb-0 font-1">
                                                    <a href="{{ route('com.blogs.show', $related->slug) }}"
                                                        class="text-decoration-none text-dark hover-primary-link">
                                                        {{ $related->title }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        .blog-content p {
            margin-bottom: 1.8rem;
        }

        .blog-content h2,
        .blog-content h3 {
            font-weight: 800;
            color: var(--primary-color);
            margin-top: 2.5rem;
            margin-bottom: 1.2rem;
            font-family: 'Inter', sans-serif;
        }

        .blog-content ul {
            margin-bottom: 1.8rem;
            padding-left: 1.5rem;
            list-style-type: disc;
        }

        .blog-content ol {
            margin-bottom: 1.8rem;
            padding-left: 1.5rem;
            list-style-type: decimal;
        }

        .blog-content li {
            margin-bottom: 0.8rem;
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1.5rem;
            margin: 1rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: block;
        }

        .blog-content figure {
            margin: 2.5rem 0;
            text-align: center;
        }

        .blog-content figcaption {
            margin-top: 0.8rem;
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
        }

        .bg-overlay-secondary {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: rgba(4, 74, 128, 0.7); */
        }


        .blog-hover-card {
            transition: all 0.3s ease;
        }

        .blog-hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .blog-hover-card .font-1 {
            line-height: 1.2 !important;
            letter-spacing: -0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.4em;
        }

        .hover-primary-link:hover {
            color: var(--primary-color) !important;
        }
    </style>
@endsection