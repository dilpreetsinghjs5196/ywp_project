@extends('admin.layouts.app')

@section('title', 'Manage Wonder Store Products')
@section('page_title', 'Wonder Store Products')

@section('content')
    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <h5 class="mb-0 fw-bold">All Products</h5>
                </div>
                <div class="col-md-7">
                    <form action="{{ route('admin.wonder-store-products.index') }}" method="GET" class="row g-2">
                        <div class="col-md-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" 
                                    placeholder="Search details..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group btn-group-sm w-100">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.wonder-store-products.index') }}" class="btn btn-light border">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 text-md-end">
                    <a href="{{ route('admin.wonder-store-products.create') }}" class="btn btn-primary btn-sm w-100 w-md-auto">
                        <i class="bi bi-plus-lg"></i> Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
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
                                <td class="ps-4 text-muted">{{ $products->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $product->product_image) }}" 
                                         alt="Product" class="rounded" 
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
                                <td class="fw-bold text-primary-color">${{ number_format($product->product_price, 2) }}</td>
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
                                    <div class="text-muted">No products found matching your criteria.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($products->hasPages())
            <div class="card-footer bg-white py-3">
                <div class="d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection