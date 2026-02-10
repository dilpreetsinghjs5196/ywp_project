@extends('admin.layouts.app')

@section('title', 'Edit ' . ucfirst($slug) . ' Page')
@section('page_title', 'Edit ' . ucfirst($slug) . ' Page Content')

@section('content')
    <form action="{{ route('admin.pages.update', $slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($contents as $section => $items)
            <div class="card mb-5">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 text-primary fw-bold text-uppercase small">{{ str_replace('_', ' ', $section) }} SECTION
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        @foreach($items as $item)
                            <div class="col-12 {{ in_array($item->type, ['textarea', 'image']) ? 'col-md-12' : 'col-md-6' }}">
                                <label class="form-label fw-bold">{{ str_replace('_', ' ', ucfirst($item->key)) }}</label>

                                @if($item->type === 'text')
                                    <input type="text" name="{{ $item->id }}" value="{{ $item->value }}" class="form-control">
                                @elseif($item->type === 'textarea')
                                    <textarea name="{{ $item->id }}" class="form-control" rows="4">{{ $item->value }}</textarea>
                                @elseif($item->type === 'color')
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="color" name="{{ $item->id }}" value="{{ $item->value }}"
                                            class="form-control form-control-color" style="width: 100px;">
                                        <span class="text-muted small">{{ $item->value }}</span>
                                    </div>
                                @elseif($item->type === 'image')
                                    <div class="d-flex flex-column flex-sm-row align-items-start gap-3 gap-sm-4">
                                        @if($item->value)
                                            <img src="{{ Str::startsWith($item->value, 'image/') ? asset($item->value) : asset('storage/' . $item->value) }}"
                                                alt="Current" class="img-thumbnail" style="max-height: 100px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center border rounded"
                                                style="width: 100px; height: 100px;">
                                                <i class="bi bi-image text-muted fs-3"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1 w-100">
                                            <input type="file" name="{{ $item->id }}" class="form-control">
                                            <p class="text-muted small mt-2 mb-0">Recommended size depends on section. PNG/JPG/WebP
                                                supported.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="position-sticky bottom-0 bg-white p-3 p-md-4 border-top text-end"
            style="z-index: 100; margin: 0 -1.5rem -1.5rem -1.5rem;">
            <button type="submit" class="btn btn-primary px-4 px-md-5 btn-lg w-100 w-md-auto">
                <i class="bi bi-save me-2"></i> Save Changes
            </button>
        </div>
    </form>
@endsection