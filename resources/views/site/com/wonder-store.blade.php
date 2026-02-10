@extends('site.com.layouts.app')

@section('title', 'Wonder Store')

@section('content')
    @php
        $bgImagePath = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);
    @endphp
    <!-- Hero Section -->
    <section class="section position-relative"
        style="background: url('{{ $bgFullUrl }}'); background-size: cover; background-position: center; height: 40vh;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
            <div
                class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
                <h1 class="display-2 mb-0" style="font-weight: 900;">
                    {{ $contents['banner']['banner_title'] ?? 'Wonder Store' }}
                </h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            {{ $contents['banner']['banner_title'] ?? 'Wonder Store' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Store Content -->
    <section class="section py-5 mb-5">
        <div class="b-container">
            <div class="row g-4">
                <!-- Sidebar / Categories -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                        <h5 class="font-1 fw-bold mb-4">Categories</h5>
                        <div class="list-group list-group-flush shadow-none">
                            <a href="{{ route('com.store') }}"
                                class="list-group-item list-group-item-action border-0 rounded-3 mb-2 px-3 category-link {{ !request('category') ? 'bg-primary-color text-white' : 'text-secondary' }}">
                                <i class="bi bi-grid-fill me-2"></i> All Products
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('com.store', ['category' => $cat->category_name]) }}"
                                    class="list-group-item list-group-item-action border-0 rounded-3 mb-2 px-3 category-link {{ request('category') == $cat->category_name ? 'bg-primary-color text-white' : 'text-secondary' }}">
                                    <i class="bi bi-tag-fill me-2"></i> {{ $cat->category_name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <h5 class="font-1 fw-bold mb-3">Search</h5>
                            <form action="{{ route('com.store') }}" method="GET">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded-start-pill border-end-0"
                                        placeholder="Search products..." value="{{ request('search') }}">
                                    <button class="btn btn-primary-solid rounded-end-pill px-3" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="mt-5 p-4 bg-primary-color rounded-4 text-white text-center">
                                                            <h6 class="mb-2">Special Offer</h6>
                                                            <h4 class="font-1 fw-bold mb-3">20% Off</h4>
                                                            <p class="small mb-0 opacity-75">On all wellness journals this month!</p>
                                                        </div> -->
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9" id="product-list-container">
                    @include('site.com.partials._product_list')
                </div>
            </div>
        </div>
    </section>

    @push('js')
        <script>
            $(document).ready(function () {
                const productContainer = $('#product-list-container');
                const searchInput = $('input[name="search"]');
                const categoryLinks = $('.category-link');

                let searchTimer;

                // Search with debounce
                searchInput.on('keyup', function () {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(() => {
                        fetchProducts();
                    }, 500);
                });

                // Prevent form submit
                searchInput.closest('form').on('submit', function (e) {
                    e.preventDefault();
                    fetchProducts();
                });

                // Category filter
                $(document).on('click', '.category-link', function (e) {
                    e.preventDefault();
                    const url = new URL($(this).attr('href'));
                    const category = url.searchParams.get('category');

                    // Update active state
                    categoryLinks.removeClass('bg-primary-color text-white').addClass('text-secondary');
                    $(this).addClass('bg-primary-color text-white').removeClass('text-secondary');

                    // Update hidden input if exists or use URL
                    fetchProducts(category);

                    // Update browser URL without reload
                    window.history.pushState({}, '', url);
                });

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    fetchProducts(null, url);
                    window.history.pushState({}, '', url);
                });

                function fetchProducts(category = null, customUrl = null) {
                    const search = searchInput.val();
                    const currentUrl = new URL(window.location.href);
                    const activeCategory = category || currentUrl.searchParams.get('category') || '';

                    const url = customUrl || "{{ route('com.store') }}";

                    productContainer.css('opacity', '0.5');

                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            search: search,
                            category: activeCategory
                        },
                        success: function (data) {
                            productContainer.html(data);
                            productContainer.css('opacity', '1');

                            // Re-initialize AOS if used
                            if (typeof AOS !== 'undefined') {
                                AOS.refresh();
                            }
                        },
                        error: function () {
                            productContainer.css('opacity', '1');
                            console.error('Failed to fetch products');
                        }
                    });
                }
            });
        </script>
    @endpush

    <style>
        .product-card:hover .object-fit-cover {
            transform: scale(1.1);
        }

        .product-card:hover .product-overlay {
            opacity: 1 !important;
            transform: translateY(0);
        }

        .product-overlay {
            transform: translateY(20px);
            background: linear-gradient(to top, rgba(255, 255, 255, 0.9), transparent);
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Sidebar Styling */
        .category-link {
            transition: all 0.25s ease;
            font-weight: 500;
            border: 1px solid transparent !important;
            margin-bottom: 5px !important;
        }

        /* Inactive State */
        .category-link.text-secondary {
            color: #555 !important;
            background-color: transparent !important;
        }

        /* Active State */
        .category-link.bg-primary-color {
            background-color: #044A80 !important;
            /* Explicit primary color */
            color: #ffffff !important;
            box-shadow: 0 4px 8px rgba(4, 74, 128, 0.15);
        }

        /* Hover State for Inactive Items */
        .category-link:hover:not(.bg-primary-color) {
            background-color: #eef4f9 !important;
            /* Solid light blue, won't mix with white */
            color: #044A80 !important;
            border-color: #d1e3f0 !important;
        }

        /* Active Item Hover - Keep it Solid */
        .category-link.bg-primary-color:hover {
            background-color: #033a66 !important;
            color: #ffffff !important;
            opacity: 1 !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection