@extends('admin.layouts.app')

@section('title', 'Edit Brand')
@section('page_title', 'Edit Brand Logo')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Brand Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Brand Name (Optional)</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $brand->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Current Logo</label>
                            <div class="mb-2">
                                <img src="{{ $brand->image ? (Str::startsWith($brand->image, 'image/') ? asset($brand->image) : asset('storage/' . $brand->image)) : asset('image/default-brand.jpg') }}"
                                    alt="Current Logo" class="rounded border p-2 bg-light"
                                    style="max-height: 100px; max-width: 200px; object-fit: contain;">
                            </div>
                            <label for="image" class="form-label">Update Logo (Leave blank to keep current)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image">
                            <div class="form-text">Recommended size: 200x80px. Supported: PNG, JPG, JPEG, WebP.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">Display Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    id="sort_order" name="sort_order" value="{{ old('sort_order', $brand->sort_order) }}">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ $brand->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection