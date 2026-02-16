<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Client</th>
                <th>Feedback</th>
                <th>Rating</th>
                <th>Order</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $item)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <img src="{{ $item->client_image ? (Str::startsWith($item->client_image, 'image/') ? asset($item->client_image) : asset('storage/' . $item->client_image)) : asset('image/default-user.jpg') }}"
                                alt="{{ $item->client_name }}" class="rounded-circle shadow-sm me-2"
                                style="width: 45px; height: 45px; object-fit: cover;">
                            <div>
                                <div class="fw-bold">{{ $item->client_name }}</div>
                                <small class="text-muted">{{ $item->designation }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 300px;">{{ $item->feedback }}</div>
                    </td>
                    <td>
                        <div class="text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                            @endfor
                        </div>
                    </td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        @if($item->is_active)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn btn-light border btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Delete this testimonial?')">
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
                    <td colspan="6" class="text-center py-5 text-muted">No testimonials found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($testimonials->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="pagination-wrapper">
            <div class="text-muted small">
                Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }}
                results
            </div>
            <div class="pagination-links">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
@endif