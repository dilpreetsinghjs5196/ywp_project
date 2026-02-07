@extends('admin.layouts.app')

@section('title', 'Branding Settings')
@section('page_title', 'Visual Identity & Branding')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card p-4">
                    <div class="row g-4">
                        @foreach($settings as $setting)
                            <div class="col-12 {{ $setting->type === 'image' ? 'col-md-12' : 'col-md-6' }}">
                                @php
                                    $displayKey = str_replace('_', ' ', ucfirst($setting->key));
                                    $roleLabel = '';
                                    if ($setting->key === 'site_logo') {
                                        $roleLabel = 'Header logo';
                                    } elseif ($setting->key === 'site_logo_black') {
                                        $roleLabel = 'Footer logo';
                                    }
                                @endphp
                                <label class="form-label fw-bold">{{ $displayKey }} @if($roleLabel) <small class="text-muted">({{ $roleLabel }})</small> @endif</label>

                                @if($setting->type === 'color')
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="color" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                            class="form-control form-control-color" style="width: 120px;">
                                        <span class="text-muted fw-mono">{{ $setting->value }}</span>
                                    </div>
                                @elseif($setting->type === 'image')
                                    <div class="d-flex align-items-center gap-4">
                                        @if($setting->value)
                                            <div class="bg-dark p-2 rounded">
                                                <img src="{{ Str::startsWith($setting->value, 'image/') ? asset($setting->value) : asset('storage/' . $setting->value) }}"
                                                    alt="Logo" class="img-fluid" style="max-height: 50px;">
                                            </div>
                                        @endif
                                        <input type="file" name="{{ $setting->key }}" class="form-control">
                                    </div>
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                        class="form-control">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5">Apply Branding Changes</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 bg-light border-0">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Branding Tips</h6>
                <p class="small text-muted">
                    Following the <strong>Final Branding Guidelines</strong>:
                </p>
                <ul class="small text-muted ps-3">
                    <li>Use deep blue for primary branding.</li>
                    <li>Limit colors to 2-3 on main sections.</li>
                    <li>Logo variations (black/white) should be high resolution.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection