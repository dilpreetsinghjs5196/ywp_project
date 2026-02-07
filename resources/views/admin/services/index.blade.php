@extends('admin.layouts.app')

@section('title', 'Manage Services')
@section('page_title', 'Services List')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">All Services</h5>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add New Service
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td class="ps-4">
                                    @if($service->image)
                                        <img src="{{ Str::startsWith($service->image, 'image/') ? asset($service->image) : asset('storage/' . $service->image) }}"
                                            alt="{{ $service->title }}" class="rounded"
                                            style="width: 50px; hieght: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $service->title }}</div>
                                    <small class="text-muted">{{ $service->slug }}</small>
                                </td>
                                <td>
                                    @if($service->icon_image)
                                        <img src="{{ Str::startsWith($service->icon_image, 'image/') ? asset($service->icon_image) : asset('storage/' . $service->icon_image) }}"
                                            width="30" class="rounded bg-primary-color p-1">
                                    @else
                                        <i class="bi {{ $service->icon }} text-primary-color fs-5"></i>
                                    @endif
                                </td>
                                <td>{{ $service->sort_order }}</td>
                                <td>
                                    @if($service->is_active)
                                        <span class="badge bg-success-subtle text-success px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.services.edit', $service->id) }}"
                                            class="btn btn-sm btn-light border">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this service?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">No services found. Click "Add New Service" to get started.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection