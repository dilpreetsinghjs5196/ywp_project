@extends('admin.layouts.app')

@section('title', 'Manage Roles')
@section('page_title', 'Role Management')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Existing Roles</h5>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create New Role</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $role->name }}</strong></td>
                            <td><span class="badge bg-secondary">{{ $role->slug }}</span></td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                        class="btn btn-sm btn-info text-white">Edit</a>
                                    @if($role->slug !== 'admin')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection