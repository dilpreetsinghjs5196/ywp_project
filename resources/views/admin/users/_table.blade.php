<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if(\App\Models\Team::where('email', $user->email)->exists())
                            <span class="badge bg-info ms-1" style="font-size: 0.7rem;">Team Member</span>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @forelse($user->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @empty
                            <span class="badge bg-light text-dark text-muted">No Role</span>
                        @endforelse
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Assign
                                Roles</a>
                            @if($user->email !== 'akash@yourewonderfulproject.org')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            @if(isset($unregisteredTeamMembers) && $unregisteredTeamMembers->count() > 0 && $users->currentPage() == 1)
                <tr class="table-light">
                    <td colspan="5" class="text-center py-3">
                        <span class="fw-bold text-muted text-uppercase small">Therapists from Teams (Account
                            Pending)</span>
                    </td>
                </tr>
                @foreach($unregisteredTeamMembers as $tm)
                    <tr class="opacity-75">
                        <td><i class="bi bi-person-plus"></i></td>
                        <td>
                            <strong>{{ $tm->name }}</strong>
                            <span class="badge bg-warning text-dark ms-1" style="font-size: 0.7rem;">Not Registered</span>
                        </td>
                        <td>{{ $tm->email }}</td>
                        <td><span class="text-muted small">No Account Yet</span></td>
                        <td>
                            <form action="{{ route('admin.users.create-from-team', $tm->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-person-plus-fill me-1"></i> Create Account
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@if($users->hasPages())
    <div class="card-footer bg-white border-top">
        <div class="pagination-wrapper">
            <div class="text-muted small">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>
            <div class="pagination-links">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endif