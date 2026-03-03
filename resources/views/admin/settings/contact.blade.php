@extends('admin.layouts.app')

@section('title', 'Footer & Contact Settings')
@section('page_title', 'Contact Information & Footer Content')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4">Support & Contact</h5>
                    <div class="row g-3">
                        @foreach($settings->where('group', 'contact') as $setting)
                            <div class="col-12">
                                <label class="form-label fw-bold">
                                    {{ str_replace('_', ' ', ucfirst($setting->key)) }}
                                    @if($setting->key === 'workplace_email')
                                        (Admin)
                                    @endif
                                </label>
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                    class="form-control">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4">Footer Content</h5>
                    <div class="row g-3">
                        @foreach($settings->where('group', 'footer') as $setting)
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ str_replace('_', ' ', ucfirst($setting->key)) }}</label>
                                @if($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" class="form-control"
                                        rows="4">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                        class="form-control">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary px-5 btn-lg">Update Global Info</button>
            </div>
        </div>
    </form>
@endsection