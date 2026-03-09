@extends('admin.layouts.app')

@section('title', 'Manage Blog Videos')
@section('page_title', 'Blog Themes & Related Videos')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">All Blog Videos</h5>
            <a href="{{ route('admin.blog-videos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Video
            </a>
        </div>
        <div class="card-body bg-light border-bottom p-3">
            <form id="filterForm" action="{{ route('admin.blog-videos.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" id="searchInput" class="form-control border-start-0"
                            placeholder="Search by Video Title..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">Filter</button>
                    <a href="{{ route('admin.blog-videos.index') }}" id="clearBtn"
                        class="btn btn-outline-secondary btn-sm {{ !request('search') ? 'd-none' : '' }}">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body p-0" id="tableContainer">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Thumbnail</th>
                            <th>Video Details</th>
                            <th>Theme</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : 'https://img.youtube.com/vi/' . explode('v=', str_replace('?v=', 'v=', $video->video_url))[1] . '/mqdefault.jpg' }}"
                                        alt="{{ $video->title }}" class="rounded shadow-sm"
                                        style="width: 70px; height: 50px; object-fit: cover; background: #f8f9fa;">
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $video->title }}</div>
                                    <div class="small text-muted">
                                        URL: <a href="{{ $video->video_url }}" target="_blank">{{ Str::limit($video->video_url, 40) }}</a><br>
                                        Order: {{ $video->sort_order }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                        {{ $video->theme->name }}
                                    </span>
                                </td>
                                <td>
                                    @if($video->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.blog-videos.edit', $video->id) }}" class="btn btn-light border btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.blog-videos.destroy', $video->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this video?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light border btn-sm text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">No blog videos found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($videos->hasPages())
                <div class="card-footer bg-white py-3">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
