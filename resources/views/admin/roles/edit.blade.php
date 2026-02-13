@extends('admin.layouts.app')

@section('title', 'Edit Role')
@section('page_title', 'Edit Role: ' . $role->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role Slug (Unique)</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $role->slug) }}" required @if($role->slug === 'admin') readonly @endif>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control"
                            rows="3">{{ old('description', $role->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection