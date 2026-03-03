@extends('admin.layouts.app')

@section('title', 'Payment Gateway Settings')
@section('page_title', 'Razorpay Configuration')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="card p-4 shadow-sm border-0">
                    <div class="row g-4">
                        @foreach($settings as $setting)
                            <div class="col-md-12 mb-3">
                                @php
                                    $displayKey = str_replace(['razorpay_', '_'], ['', ' '], $setting->key);
                                    $displayKey = strtoupper($displayKey);
                                @endphp
                                <label class="form-label fw-bold">{{ $displayKey }}</label>

                                @if($setting->type == 'password')
                                    <input type="password" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                        class="form-control" placeholder="Enter {{ $displayKey }}">
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-control"
                                        placeholder="Enter {{ $displayKey }}">
                                @endif

                                <div class="form-text small text-muted">
                                    Key: <code>{{ $setting->key }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5">Save Razorpay Configuration</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 bg-light border-0 shadow-sm">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Razorpay Info</h6>
                <div class="small text-muted">
                    <p>These credentials are used to initialize payments and handle split payments (Razorpay Route).</p>
                    <ol class="ps-3 mb-3">
                        <li>Login to your <a href="https://dashboard.razorpay.com/" target="_blank">Razorpay Dashboard</a>.
                        </li>
                        <li>Navigate to <strong>Settings -> API Keys</strong>.</li>
                        <li>Copy your <strong>Key ID</strong> and <strong>Key Secret</strong>.</li>
                        <li>Ensure <strong>Route</strong> is activated in your account.</li>
                    </ol>
                    <div class="alert alert-info p-2 small mb-0">
                        <i class="bi bi-shield-check me-1"></i> Credentials are stored securely.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection