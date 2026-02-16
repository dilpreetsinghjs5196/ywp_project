<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}</td>
                    <td><strong>{{ $role->name }}</strong></td>
                    <td><span class="badge bg-secondary">{{ $role->slug }}</span></td>
                    <td>{{ $role->description }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-light border"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($role->slug !== 'admin')
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">No roles found.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($roles->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="pagination-wrapper">
            <div class="text-muted small">
                Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} results
            </div>
            <div class="pagination-links">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endif