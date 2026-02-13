@extends('admin.layouts.app')

@section('title', 'Assign Roles')
@section('page_title', 'Assign Roles to: ' . $user->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h6 class="mb-4 text-muted">User: <span class="text-dark fw-bold">{{ $user->email }}</span></h6>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label d-block fw-bold mb-3">Select Roles</label>
                    <div class="row g-3">
                        @foreach($roles as $role)
                        <div class="col-6">
                            <div class="form-check card p-2 bg-light border-0 shadow-sm transition-hover">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                    id="role-{{ $role->id }}"
                                    @if($user->roles->contains($role->id)) checked @endif
                                    @if($user->email === 'akash@yourewonderfulproject.org' && $role->slug === 'admin') disabled @endif
                                >
                                <label class="form-check-label w-100 ms-1 cursor-pointer" for="role-{{ $role->id }}">
                                    <div class="fw-bold">{{ $role->name }}</div>
                                    <small class="text-muted d-block">{{ $role->description }}</small>
                                </label>
                                @if($user->email === 'akash@yourewonderfulproject.org' && $role->slug === 'admin')
                                    <input type="hidden" name="roles[]" value="{{ $role->id }}">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5">Sync Roles</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .transition-hover:hover {
        background-color: #f0f4ff !important;
        transform: translateY(-2px);
    }
    .form-check-input:checked + .form-check-label .fw-bold {
        color: var(--bs-primary);
    }
</style>
@endsection
