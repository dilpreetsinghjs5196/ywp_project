<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Name</th>
                <th>Slug</th>
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
                            <a href="{{ route('admin.blog-themes.edit', $theme->id) }}" class="btn btn-light border btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.blog-themes.destroy', $theme->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Delete this theme? Careful: it will affect associated blogs!')">
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
                    <td colspan="5" class="text-center py-5 text-muted">No blog themes found.</td>
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