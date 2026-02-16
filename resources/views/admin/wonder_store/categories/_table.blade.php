<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">#</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="ps-4 text-muted">
                        {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                    </td>
                    <td class="fw-bold">{{ $category->category_name }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge bg-success-subtle text-success px-3">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-3">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at->format('Y-m-d H:i') }}</td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.wonder-store-categories.edit', $category->id) }}"
                                class="btn btn-sm btn-light border">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.wonder-store-categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                    <td colspan="4" class="text-center py-5">
                        <div class="text-muted">No categories found.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($categories->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $categories->links() }}
    </div>
@endif