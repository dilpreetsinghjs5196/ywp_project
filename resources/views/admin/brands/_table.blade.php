<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="ps-4">Logo</th>
                <th>Brand Name</th>
                <th>Order</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td class="ps-4">
                        <img src="{{ $brand->image ? (Str::startsWith($brand->image, 'image/') ? asset($brand->image) : asset('storage/' . $brand->image)) : asset('image/default-brand.jpg') }}"
                            alt="{{ $brand->name }}" class="rounded shadow-sm"
                            style="width: 80px; height: 50px; object-fit: contain; background: #f8f9fa;">
                    </td>
                    <td>
                        <div class="fw-bold">{{ $brand->name ?? 'Unnamed Brand' }}</div>
                    </td>
                    <td>{{ $brand->sort_order }}</td>
                    <td>
                        @if($brand->is_active)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-light border btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this brand?')">
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
                    <td colspan="5" class="text-center py-5 text-muted">No brands found. Start by adding one!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($brands->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $brands->links() }}
    </div>
@endif