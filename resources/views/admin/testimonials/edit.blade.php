@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page_title', 'Edit Testimonial')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Testimonial: {{ $testimonial->client_name }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Client Name</label>
                                <input type="text" name="client_name"
                                    class="form-control @error('client_name') is-invalid @enderror"
                                    value="{{ old('client_name', $testimonial->client_name) }}" required>
                                @error('client_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Designation / Company</label>
                                <input type="text" name="designation"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    value="{{ old('designation', $testimonial->designation) }}">
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Feedback / Message</label>
                            <textarea name="feedback" class="form-control @error('feedback') is-invalid @enderror" rows="4"
                                required>{{ old('feedback', $testimonial->feedback) }}</textarea>
                            @error('feedback')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                <label class="form-label fw-bold d-block text-start">Current Image</label>
                                @if($testimonial->client_image)
                                    <img src="{{ Str::startsWith($testimonial->client_image, 'image/') ? asset($testimonial->client_image) : asset('storage/' . $testimonial->client_image) }}"
                                        alt="Current" class="rounded shadow-sm mb-2" style="max-height: 100px;">
                                @else
                                    <p class="text-muted small">No image uploaded.</p>
                                @endif
                                <input type="file" name="client_image"
                                    class="form-control @error('client_image') is-invalid @enderror">
                                @error('client_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Rating</label>
                                <select name="rating" class="form-select @error('rating') is-invalid @enderror">
                                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars
                                    </option>
                                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars
                                    </option>
                                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars
                                    </option>
                                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars
                                    </option>
                                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star
                                    </option>
                                </select>
                                @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                <div class="mt-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $testimonial->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Update Testimonial</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection