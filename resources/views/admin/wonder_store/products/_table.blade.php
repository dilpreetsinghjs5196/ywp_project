<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">#</th>
                <th>Image</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="ps-4 text-muted">
                        {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product" class="rounded"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ $product->category->category_name }}</span>
                    </td>
                    <td>
                        <small class="text-muted d-inline-block text-truncate" style="max-width: 200px;">
                            {{ $product->product_description ?? 'No description' }}
                        </small>
                    </td>
                    <td class="fw-bold text-primary-color">
                        Rs.{{ number_format($product->product_price, 2) }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success-subtle text-success px-3">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-3">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.wonder-store-products.edit', $product->id) }}"
                                class="btn btn-sm btn-light border">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.wonder-store-products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="text-muted">No products found.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($products->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $products->links() }}
    </div>
@endif