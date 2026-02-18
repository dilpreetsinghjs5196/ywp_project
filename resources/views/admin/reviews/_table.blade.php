<div class="table-responsive">
    <table class="table table-hover align-middle mb-0" style="margin-bottom: 100px;">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Reviewer</th>
                <th>Therapist</th>
                <th>Rating</th>
                <th style="min-width: 250px;">Comment</th>
                <th class="text-center">Status</th>
                <th>Date</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $item)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-dark">{{ $item->name }}</span>
                            <small class="text-muted">{{ $item->email }}</small>
                            @if($item->is_anonymous)
                                <span class="badge bg-secondary-subtle text-secondary small mt-1"
                                    style="width: fit-content;">Anonymous</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="fw-semibold text-primary">{{ $item->team->name ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <div class="text-warning small">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="text-muted small"
                            style="white-space: normal; word-break: break-word; line-height: 1.5;">
                            {{ $item->comment }}
                        </div>
                    </td>
                    <td class="text-center">
                        @if($item->status == 'approved')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Approved</span>
                        @elseif($item->status == 'rejected')
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Rejected</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3">Pending</span>
                        @endif
                    </td>
                    <td>
                        <small class="text-muted">{{ $item->created_at->format('M d, Y') }}</small>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end align-items-center gap-2" style="min-width: 180px;">
                            <!-- Approve -->
                            <form action="{{ route('admin.reviews.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center {{ $item->status == 'approved' ? 'btn-success shadow-sm' : 'btn-outline-success' }}"
                                    style="width: 32px; height: 32px;" title="Approve" {{ $item->status == 'approved' ? 'disabled' : '' }}>
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <!-- Pending -->
                            <form action="{{ route('admin.reviews.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="pending">
                                <button type="submit"
                                    class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center {{ $item->status == 'pending' ? 'btn-warning text-white shadow-sm' : 'btn-outline-warning' }}"
                                    style="width: 32px; height: 32px;" title="Set to Pending" {{ $item->status == 'pending' ? 'disabled' : '' }}>
                                    <i class="bi bi-clock"></i>
                                </button>
                            </form>

                            <!-- Reject -->
                            <form action="{{ route('admin.reviews.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit"
                                    class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center {{ $item->status == 'rejected' ? 'btn-danger shadow-sm' : 'btn-outline-danger' }}"
                                    style="width: 32px; height: 32px;" title="Reject" {{ $item->status == 'rejected' ? 'disabled' : '' }}>
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>

                            <div class="vr mx-1 opacity-25" style="height: 20px;"></div>

                            <form action="{{ route('admin.reviews.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm rounded-circle btn-outline-secondary d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px;" title="Delete Permanent">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-chat-left-dots fs-1 text-muted opacity-25 d-block mb-2"></i>
                        <span class="text-muted">No reviews found matching your criteria.</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($reviews->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="pagination-wrapper">
            <div class="text-muted small">
                Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} results
            </div>
            <div class="pagination-links">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endif