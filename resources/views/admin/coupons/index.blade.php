@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Coupon Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Coupons</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Coupon Requests
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Date Requested</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->user_name }}</td>
                                <td>{{ $coupon->user_email }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $coupon->code }}</span></td>
                                <td>₹{{ number_format($coupon->discount_amount, 2) }}</td>
                                <td>
                                    @if($coupon->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($coupon->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($coupon->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-info">Used</span>
                                    @endif
                                </td>
                                <td>{{ $coupon->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-nowrap">
                                    <div class="d-flex gap-2">
                                        @if($coupon->status == 'pending')
                                            <form action="{{ route('admin.coupons.approve', $coupon->id) }}" method="POST" class="d-inline mb-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.coupons.reject', $coupon->id) }}" method="POST" class="d-inline mb-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-coupon-btn" 
                                                data-id="{{ $coupon->id }}"
                                                data-code="{{ $coupon->code }}"
                                                data-discount="{{ $coupon->discount_amount }}"
                                                data-status="{{ $coupon->status }}"
                                                data-user-name="{{ $coupon->user_name }}"
                                                data-user-email="{{ $coupon->user_email }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No coupon requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Coupon Modal -->
<div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="editCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-primary text-white p-4" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title fw-bold" id="editCouponModalLabel"><i class="fas fa-edit me-2"></i>Edit Coupon</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCouponForm" method="POST" action="">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">User Name</label>
                        <input type="text" id="edit_user_name" name="user_name" class="form-control rounded-3" required placeholder="Full Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Email Address</label>
                        <input type="email" id="edit_user_email" name="user_email" class="form-control rounded-3" required placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Coupon Code</label>
                        <input type="text" id="edit_code" name="code" class="form-control rounded-3 text-uppercase fw-bold text-primary" required placeholder="CODE">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Discount Amount (₹)</label>
                        <input type="number" step="0.01" id="edit_discount_amount" name="discount_amount" class="form-control rounded-3" required placeholder="500.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Status</label>
                        <select id="edit_status" name="status" class="form-select rounded-3" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="used">Used</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.edit-coupon-btn').on('click', function () {
            const id = $(this).data('id');
            const code = $(this).data('code');
            const discount = $(this).data('discount');
            const status = $(this).data('status');
            const userName = $(this).data('user-name');
            const userEmail = $(this).data('user-email');

            // Set Form action dynamically
            let actionUrl = "{{ route('admin.coupons.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $('#editCouponForm').attr('action', actionUrl);

            // Populate inputs
            $('#edit_user_name').val(userName);
            $('#edit_user_email').val(userEmail);
            $('#edit_code').val(code);
            $('#edit_discount_amount').val(discount);
            $('#edit_status').val(status);

            // Open modal
            const editModal = new bootstrap.Modal(document.getElementById('editCouponModal'));
            editModal.show();
        });
    });
</script>
@endpush
@endsection
