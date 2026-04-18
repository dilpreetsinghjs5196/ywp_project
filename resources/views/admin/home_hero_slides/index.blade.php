@extends('admin.layouts.app')

@section('title', 'Manage Hero Slides')
@section('page_title', 'Manage Hero Slides')

@section('content')
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.home-hero-slides.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Add New Slide
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Order</th>
                            <th style="width: 150px;">Image</th>
                            <th>Title</th>
                            <th>Links</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($slides as $slide)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $slide->order }}</span></td>
                                <td>
                                    <img src="{{ Str::startsWith($slide->image, 'image/') ? asset($slide->image) : asset('storage/' . $slide->image) }}" 
                                         alt="Slide" class="img-thumbnail" style="max-height: 60px;">
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $slide->title ?? 'No Title' }}</div>
                                    <small class="text-muted">{{ Str::limit($slide->subtitle, 50) }}</small>
                                </td>
                                <td>
                                    @if($slide->button_text)
                                        <span class="badge bg-info text-dark">{{ $slide->button_text }}</span>
                                        <div class="small text-muted text-break">{{ $slide->button_link }}</div>
                                    @else
                                        <span class="text-muted small">No Button</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.home-hero-slides.edit', $slide->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.home-hero-slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-images fs-1 d-block mb-3"></i>
                                        No hero slides found. Click "Add New Slide" to create one.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
