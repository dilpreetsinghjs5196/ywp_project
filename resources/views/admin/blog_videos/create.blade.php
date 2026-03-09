@extends('admin.layouts.app')

@section('title', 'Add Blog Video')
@section('page_title', 'Insights, Stories & Resources')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Add New Video</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.blog-videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="video_theme_id" class="form-label">Video Theme <span class="text-danger">*</span></label>
                        <select name="video_theme_id" id="video_theme_id" class="form-select @error('video_theme_id') is-invalid @enderror" required>
                            <option value="">Select Video Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}" {{ old('video_theme_id') == $theme->id ? 'selected' : '' }}>
                                    {{ $theme->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('video_theme_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Video Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="video_url" class="form-label">YouTube URL <span class="text-danger">*</span></label>
                        <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror" 
                               placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}" required>
                        <div class="form-text text-muted">Paste the full YouTube video URL.</div>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Custom Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                        <div class="form-text text-muted">If left blank, the YouTube default thumbnail will be used.</div>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                <label class="form-check-label ms-2" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.blog-videos.index') }}" class="btn btn-light px-4 border">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Add Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
