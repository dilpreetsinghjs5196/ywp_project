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
    @if(($contents['banner']['maintenance_mode'] ?? '0') == '1')
        <section class="section py-5 mb-5 d-flex align-items-center" style="min-height: 40vh;">
            <div class="b-container text-center py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8" data-aos="fade-up">
                        <div class="maintenance-icon mb-4">
                            <i class="bi bi-tools text-primary-color display-1 opacity-50"></i>
                        </div>
                        <h2 class="font-1 fw-bold mb-3">Store Under Maintenance</h2>
                        <p class="text-muted fs-5 mb-4">
                            We're currently updating our Wonder Store to bring you a better experience. 
                            Please check back shortly.
                        </p>
                        <a href="{{ route('com.home') }}" class="btn btn-primary-solid px-5 rounded-pill">
                            Return Home
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
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
    @endif

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
                    const href = $(this).attr('href');
                    const url = new URL(href, window.location.origin);
                    const category = url.searchParams.get('category') || ''; // Default to empty string for 'All Products'

                    // Update active state
                    categoryLinks.removeClass('bg-primary-color text-white').addClass('text-secondary');
                    $(this).addClass('bg-primary-color text-white').removeClass('text-secondary');

                    // Update browser URL without reload FIRST
                    window.history.pushState({}, '', url);

                    // Fetch products with the explicit category
                    fetchProducts(category);
                });

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    window.history.pushState({}, '', url);
                    fetchProducts(null, url);
                });

                function fetchProducts(category = null, customUrl = null) {
                    const search = searchInput.val();
                    const currentUrl = new URL(customUrl || window.location.href);
                    
                    // If category is null (e.g. from pagination), try to get it from the URL
                    // Otherwise use the explicitly provided category (which could be '')
                    const activeCategory = (category !== null) ? category : (currentUrl.searchParams.get('category') || '');

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

                // Global Add to Cart Handler
                $(document).on('click', '.add-to-cart-btn', function (e) {
                    e.preventDefault();
                    const btn = $(this);
                    const productId = btn.data('id');
                    const originalContent = btn.html();

                    btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Adding...');

                    $.ajax({
                        url: "{{ url('/cart/add') }}/" + productId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.success) {
                                // Update header badge
                                if (window.updateCartBadge) {
                                    window.updateCartBadge();
                                }

                                // Visual feedback
                                btn.removeClass('btn-primary-solid').addClass('btn-success').html('<i class="bi bi-cart-check"></i> In Cart');

                                // Change button to link after a short delay
                                setTimeout(() => {
                                    const cartUrl = "{{ route('com.cart') }}";
                                    btn.parent().html(`<a href="${cartUrl}" class="btn btn-success w-100 rounded-pill shadow"><i class="bi bi-cart-check me-2"></i> In Cart</a>`);
                                }, 1000);
                            }
                        },
                        error: function () {
                            btn.prop('disabled', false).html(originalContent);
                            alert('Something went wrong. Please try again.');
                        }
                    });
                });
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

        .category-section h2 {
            color: #044A80;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            font-size: 2rem;
        }

        .category-section h2 span {
            transition: width 0.3s ease;
        }

        .category-section:hover h2 span {
            width: 80% !important;
        }

        .category-section {
            scroll-margin-top: 120px;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection