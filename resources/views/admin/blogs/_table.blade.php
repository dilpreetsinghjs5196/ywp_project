<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Image</th>
                <th>Blog Details</th>
                <th>Theme</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td class="ps-4">
                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('image/default-blog.jpg') }}"
                            alt="{{ $blog->title }}" class="rounded shadow-sm"
                            style="width: 70px; height: 50px; object-fit: cover; background: #f8f9fa;">
                    </td>
                    <td>
                        <div class="fw-bold">{{ $blog->title }}</div>
                        <div class="small text-muted">Order: {{ $blog->sort_order }} | Published:
                            {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Draft' }}</div>
                    </td>
                    <td>
                        <span
                            class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">{{ $blog->theme->name }}</span>
                    </td>
                    <td>
                        @if($blog->is_active)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-light border btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this blog post?')">
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
                    <td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($blogs->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $blogs->links() }}
    </div>
@endif