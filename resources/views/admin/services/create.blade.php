@extends('admin.layouts.app')

@section('title', 'Add New Service')
@section('page_title', 'Create Service')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Service Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required placeholder="e.g. Individual Therapy">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Icon Class (Bootstrap)</label>
                                <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                    value="{{ old('icon', 'bi-person') }}" placeholder="bi-person">
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">OR Icon Image</label>
                                <input type="file" name="icon_image"
                                    class="form-control @error('icon_image') is-invalid @enderror">
                                @error('icon_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3" required
                                placeholder="Short summary of the service...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Goals (Include: Goal 1, Goal 2...)</label>
                            <textarea name="goals" class="form-control @error('goals') is-invalid @enderror"
                                rows="4">{{ old('goals') }}</textarea>
                            <div class="form-text">These goals will only appear on the Services page cards.</div>
                            @error('goals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Assign Therapists</label>
                            <div class="row g-2 p-3 border rounded bg-light" style="max-height: 200px; overflow-y: auto;">
                                @foreach($therapists as $therapist)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="therapists[]"
                                                value="{{ $therapist->id }}" id="therapist_{{ $therapist->id }}">
                                            <label class="form-check-label small" for="therapist_{{ $therapist->id }}">
                                                {{ $therapist->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <small class="text-muted">Select all therapists who provide this specific service.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Service Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text">Recommended size: 600x400px. PNG/JPG/WebP supported.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Save Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection