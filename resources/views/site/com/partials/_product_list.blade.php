<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Showing
        {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
        results
    </p>
    <div class="dropdown">
        <button class="btn btn-light border rounded-pill dropdown-toggle px-4" type="button" data-bs-toggle="dropdown">
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
                        <span class="badge bg-white text-primary-color rounded-pill px-3 py-2 shadow-sm fw-bold">
                            {{ $product->category->category_name }}
                        </span>
                    </div>
                    <div class="product-overlay position-absolute bottom-0 start-0 w-100 p-3 opacity-0 transition-all">
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