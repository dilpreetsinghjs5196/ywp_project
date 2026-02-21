@extends('admin.layouts.app')

@section('title', 'Add New Blog Theme')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Create Theme</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.blog-themes.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Theme Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="nameInput" class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name') }}" placeholder="e.g. Autism Spectrum & Neurodiversity">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slugInput" class="form-control @error('slug') is-invalid @enderror" 
                                    value="{{ old('slug') }}" placeholder="autism-spectrum-neurodiversity">
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                    <label class="form-check-label fw-bold" for="isActive">Is Active?</label>
                                </div>
                            </div>

                            <div class="col-12 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary px-5">Save Theme</button>
                                <a href="{{ route('admin.blog-themes.index') }}" class="btn btn-light border px-4 ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('#nameInput').on('keyup', function() {
        let text = $(this).val().toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        $('#slugInput').val(text);
    });
</script>
@endpush
