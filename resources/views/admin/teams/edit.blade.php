@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page_title', 'Edit Team Member')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Member: {{ $team->name }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $team->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $team->email) }}" placeholder="e.g. sarah@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Designation</label>
                                <input type="text" name="designation"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    value="{{ old('designation', $team->designation) }}" required>
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Session Fees (₹)</label>
                                <input type="number" name="fees" class="form-control @error('fees') is-invalid @enderror"
                                    value="{{ old('fees', $team->fees) }}" required placeholder="e.g. 1800">
                                @error('fees')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Enter therapist description">{{ old('description', $team->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <label class="form-label fw-bold d-block text-start">Current Image</label>
                                @if($team->image)
                                    <img src="{{ Str::startsWith($team->image, 'image/') ? asset($team->image) : asset('storage/' . $team->image) }}"
                                        alt="Current" class="rounded shadow-sm mb-2" style="max-height: 150px;">
                                @else
                                    <p class="text-muted small">No image uploaded.</p>
                                @endif
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', $team->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                <div class="mt-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $team->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-calendar3 me-2"></i> Therapist Availability Calendar</h6>
                        <p class="small text-muted mb-3">Enter time slots separated by commas (e.g., 10:00 AM, 11:30 AM, 02:00 PM).</p>

                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 180px;">Date</th>
                                        <th>Available Time Slots</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nextFortnight = [];
                                        for ($i = 0; $i < 14; $i++) {
                                            $nextFortnight[] = \Carbon\Carbon::today()->addDays($i);
                                        }
                                        $availability = $team->availability ?? [];
                                    @endphp

                                    @foreach($nextFortnight as $date)
                                        @php
                                            $dateStr = $date->format('Y-m-d');
                                            $existingTimes = isset($availability[$dateStr]) ? implode(', ', $availability[$dateStr]) : '';
                                        @endphp
                                        <tr>
                                            <td class="bg-light">
                                                <div class="fw-bold small">{{ $date->format('D, d M Y') }}</div>
                                            </td>
                                            <td>
                                                <input type="text" name="availability[{{ $dateStr }}]" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="e.g. 10:00 AM, 12:00 PM"
                                                       value="{{ $existingTimes }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-primary">Social Media Links (Optional)</h6>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" name="facebook" class="form-control"
                                    value="{{ old('facebook', $team->facebook) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" name="twitter" class="form-control"
                                    value="{{ old('twitter', $team->twitter) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="instagram" class="form-control"
                                    value="{{ old('instagram', $team->instagram) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" name="linkedin" class="form-control"
                                    value="{{ old('linkedin', $team->linkedin) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.teams.index') }}" class="btn btn-light border px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">Update Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection