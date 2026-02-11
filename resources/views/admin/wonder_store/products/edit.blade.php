@extends('admin.layouts.app')

@section('title', 'Edit Wonder Store Product')
@section('page_title', 'Edit Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Edit Product</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.wonder-store-products.update', $wonderStoreProduct->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-bold">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                    name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $wonderStoreProduct->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="product_price" class="form-label fw-bold">Price (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('product_price') is-invalid @enderror" id="product_price"
                                    name="product_price"
                                    value="{{ old('product_price', $wonderStoreProduct->product_price) }}" required>
                                @error('product_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="product_image" class="form-label fw-bold">Product Image</label>
                            <input type="file" class="form-control @error('product_image') is-invalid @enderror"
                                id="product_image" name="product_image">
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Current Image:</small>
                                <img src="{{ asset('storage/' . $wonderStoreProduct->product_image) }}" alt="Current"
                                    class="rounded border" style="width: 100px;">
                            </div>
                            @error('product_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="product_description" class="form-label fw-bold">Description (Optional)</label>
                            <textarea class="form-control @error('product_description') is-invalid @enderror"
                                id="product_description" name="product_description"
                                rows="4">{{ old('product_description', $wonderStoreProduct->product_description) }}</textarea>
                            @error('product_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $wonderStoreProduct->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">Active Status</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.wonder-store-products.index') }}"
                                class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection