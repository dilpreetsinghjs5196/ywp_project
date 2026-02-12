@extends('admin.layouts.app')

@section('title', 'Manage Team')
@section('page_title', 'Our Experts & Team')

@section('content')
    <!-- Global Booking Settings -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-gear-fill me-2 text-primary"></i>Global Booking Settings</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">In-Person Booking Address</label>
                        <textarea name="booking_address" class="form-control" rows="2" required>{{ $bookingSettings['booking_address'] ?? '' }}</textarea>
                        <small class="text-muted">This address will only be shown when "In-person" mode is selected.</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Session Duration</label>
                        <input type="text" name="session_duration" class="form-control" value="{{ $bookingSettings['session_duration'] ?? '' }}" required placeholder="e.g. 50 mins">
                        <small class="text-muted">Global duration shown for all sessions.</small>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary px-4">Save Booking Settings</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                            <th>Email</th>
                            <th>Session Fees</th>
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
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="text-decoration-none">{{ $member->email }}</a>
                                    @else
                                        <span class="text-muted small">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-primary-color fw-bold">₹{{ number_format($member->fees ?? 0) }}</span>
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
                                <td colspan="7" class="text-center py-5 text-muted">No team members found. Start by adding one!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
