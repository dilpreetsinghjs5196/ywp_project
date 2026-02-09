@extends('admin.layouts.app')

@section('title', 'Edit Wonder Store Category')
@section('page_title', 'Edit Category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Edit Category</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.wonder-store-categories.update', $wonderStoreCategory->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="category_name" class="form-label fw-bold">Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="category_name" name="category_name"
                                value="{{ old('category_name', $wonderStoreCategory->category_name) }}"
                                placeholder="e.g. Books, Videos, Courses" required>
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $wonderStoreCategory->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">Active Status</label>
                            </div>
                            <small class="text-muted">Toggle to make this category active or inactive.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.wonder-store-categories.index') }}"
                                class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection