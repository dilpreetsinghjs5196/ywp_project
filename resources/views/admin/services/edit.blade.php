@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Details: {{ $service->title }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $service->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Icon Class</label>
                                <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $service->icon) }}">
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Icon Image</label>
                                @if($service->icon_image)
                                    <div class="mb-2">
                                        <img src="{{ Str::startsWith($service->icon_image, 'image/') ? asset($service->icon_image) : asset('storage/' . $service->icon_image) }}" width="40" class="rounded bg-primary-color p-1">
                                    </div>
                                @endif
                                <input type="file" name="icon_image" class="form-control @error('icon_image') is-invalid @enderror">
                                @error('icon_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $service->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3" required>{{ old('description', $service->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold d-block">Current Service Image</label>
                            @if($service->image)
                                <img src="{{ Str::startsWith($service->image, 'image/') ? asset($service->image) : asset('storage/' . $service->image) }}"
                                    alt="Current Image" class="rounded mb-2" style="max-height: 150px;">
                            @else
                                <p class="text-muted small">No image uploaded.</p>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text">Leave blank to keep current image.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $service->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Update Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection