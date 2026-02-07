@extends('admin.layouts.app')

@section('title', 'Manage Team')
@section('page_title', 'Our Experts & Team')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Team Members</h5>
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Member
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Name & Designation</th>
                            <th>Social Links</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $member)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $member->image ? (Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image)) : asset('image/default-user.jpg') }}" 
                                         alt="{{ $member->name }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $member->name }}</div>
                                    <small class="text-muted">{{ $member->designation }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if($member->facebook)<i class="bi bi-facebook text-primary"></i>@endif
                                        @if($member->twitter)<i class="bi bi-twitter text-info"></i>@endif
                                        @if($member->instagram)<i class="bi bi-instagram text-danger"></i>@endif
                                        @if($member->linkedin)<i class="bi bi-linkedin text-primary"></i>@endif
                                    </div>
                                </td>
                                <td>{{ $member->sort_order }}</td>
                                <td>
                                    @if($member->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.teams.edit', $member->id) }}" class="btn btn-light border btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.teams.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team member?')">
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
                                <td colspan="6" class="text-center py-5 text-muted">No team members found. Start by adding one!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
