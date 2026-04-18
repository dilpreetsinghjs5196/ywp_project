@extends('admin.layouts.app')

@section('title', 'Add Hero Slide')
@section('page_title', 'Add New Hero Slide')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-hero-slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Slide Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <p class="text-muted small mt-2">Recommended size: <strong>1920x1080px</strong> (Full HD). WebP or JPG recommended. PNG is also supported.</p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Main Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="e.g. Caring for Your Inner Peace">
                            <p class="text-muted small mt-1">Leave empty if you don't want to show a title.</p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Subtitle</label>
                            <textarea name="subtitle" class="form-control" rows="3" placeholder="e.g. Discover clarity, confidence, and emotional wellness...">{{ old('subtitle') }}</textarea>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Button Text</label>
                                <input type="text" name="button_text" value="{{ old('button_text') }}" class="form-control" placeholder="e.g. Start A Checkup Now">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Button Link</label>
                                <input type="text" name="button_link" value="{{ old('button_link') }}" class="form-control" placeholder="e.g. /team">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Display Order</label>
                            <input type="number" name="order" value="{{ old('order', 0) }}" class="form-control">
                            <p class="text-muted small mt-1">Lower numbers show first.</p>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.home-hero-slides.index') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Create Slide</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
