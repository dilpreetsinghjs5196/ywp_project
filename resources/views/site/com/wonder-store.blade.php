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
                <h1 class="display-2 mb-0" style="font-weight: 900;">Wonder Store</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Wonder Store
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
                                class="list-group-item list-group-item-action border-0 rounded-3 mb-2 px-3 {{ !request('category') ? 'bg-primary-color text-white' : 'text-secondary' }}">
                                <i class="bi bi-grid-fill me-2"></i> All Products
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('com.store', ['category' => $cat->category_name]) }}"
                                    class="list-group-item list-group-item-action border-0 rounded-3 mb-2 px-3 {{ request('category') == $cat->category_name ? 'bg-primary-color text-white' : 'text-secondary' }}">
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
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="text-muted mb-0">Showing
                            {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
                            results
                        </p>
                        <div class="dropdown">
                            <button class="btn btn-light border rounded-pill dropdown-toggle px-4" type="button"
                                data-bs-toggle="dropdown">
                                Sort By: Latest
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Latest</a></li>
                                <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                        @forelse($products as $product)
                            <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card scale-hover">
                                    <div class="position-relative overflow-hidden" style="height: 250px;">
                                        <img src="{{ asset('storage/' . $product->product_image) }}"
                                            class="w-100 h-100 object-fit-cover transition-all" alt="Product">
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span
                                                class="badge bg-white text-primary-color rounded-pill px-3 py-2 shadow-sm fw-bold">
                                                {{ $product->category->category_name }}
                                            </span>
                                        </div>
                                        <div
                                            class="product-overlay position-absolute bottom-0 start-0 w-100 p-3 opacity-0 transition-all">
                                            <button class="btn btn-primary-solid w-100 rounded-pill shadow">
                                                <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-center">
                                        <h5 class="font-1 fw-bold mb-2">{{ $product->category->category_name }} Item</h5>
                                        <p class="text-muted small mb-3 text-truncate-2">
                                            {{ $product->product_description ?? 'High-quality wellness product designed to support your journey.' }}
                                        </p>
                                        <div class="fs-4 fw-bold text-primary-color font-1">
                                            ${{ number_format($product->product_price, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 py-5 text-center">
                                <div class="display-1 text-muted opacity-25 mb-4">
                                    <i class="bi bi-shop"></i>
                                </div>
                                <h3 class="font-1 fw-bold">No products found</h3>
                                <p class="text-muted">We couldn't find any products matching your current filters.</p>
                                <a href="{{ route('com.store') }}" class="btn btn-primary-solid rounded-pill px-5 mt-3">View All
                                    Products</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

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

        .list-group-item-action:hover {
            background-color: rgba(4, 74, 128, 0.05) !important;
            color: var(--primary-color) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection