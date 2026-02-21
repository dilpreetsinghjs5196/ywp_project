@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Edit Post: {{ $blog->title }}</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Post Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="titleInput"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $blog->title) }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Theme <span class="text-danger">*</span></label>
                        <select name="blog_theme_id" class="form-select @error('blog_theme_id') is-invalid @enderror">
                            <option value="">Select Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}" {{ old('blog_theme_id', $blog->blog_theme_id) == $theme->id ? 'selected' : '' }}>{{ $theme->name }}</option>
                            @endforeach
                        </select>
                        @error('blog_theme_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slugInput"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug) }}">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Published At</label>
                        <input type="date" name="published_at" class="form-control"
                            value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d') : date('Y-m-d')) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Summary / Excerpt</label>
                        <textarea name="summary" class="form-control"
                            rows="2">{{ old('summary', $blog->summary) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Full Content</label>
                        <textarea name="content" id="editor" class="form-control"
                            rows="10">{{ old('content', $blog->content) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Feature Image</label>
                        @if($blog->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Preview" class="rounded"
                                    style="width: 150px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        <div class="form-text">Leave blank to keep current. Recommended: 800x600px</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                            value="{{ old('sort_order', $blog->sort_order) }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $blog->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="isActive">Is Active?</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-5">Update Post</button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-light border px-4 ms-2">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        }).catch(error => { console.error(error); });

        $('#titleInput').on('keyup', function () {
            let text = $(this).val().toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#slugInput').val(text);
        });
    </script>
@endpush
@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endpush