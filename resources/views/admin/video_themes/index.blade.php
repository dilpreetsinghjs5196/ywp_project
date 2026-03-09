@extends('admin.layouts.app')

@section('title', 'Manage Video Themes')
@section('page_title', 'Video Content Categorization')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Video Themes</h5>
            <a href="{{ route('admin.video-themes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Theme
            </a>
        </div>
        <div class="card-body bg-light border-bottom p-3">
            <form action="{{ route('admin.video-themes.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Search by Theme Name..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">Filter</button>
                    <a href="{{ route('admin.video-themes.index') }}" 
                        class="btn btn-outline-secondary btn-sm {{ !request('search') ? 'd-none' : '' }}">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Name</th>
                            <th>Slug</th>
                            <th>Videos</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($themes as $theme)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $theme->name }}</div>
                                </td>
                                <td><code>{{ $theme->slug }}</code></td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">{{ $theme->videos()->count() }} Videos</span>
                                </td>
                                <td>{{ $theme->sort_order }}</td>
                                <td>
                                    @if($theme->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.video-themes.edit', $theme->id) }}" class="btn btn-light border btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.video-themes.destroy', $theme->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete this theme?')">
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
                                <td colspan="6" class="text-center py-5 text-muted">No video themes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($themes->hasPages())
                <div class="card-footer bg-white py-3">
                    {{ $themes->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
