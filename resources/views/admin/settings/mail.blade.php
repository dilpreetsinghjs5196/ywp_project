@extends('admin.layouts.app')

@section('title', 'SMTP Settings')
@section('page_title', 'Mail & SMTP Configuration')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="card p-4 shadow-sm border-0">
                    <div class="row g-4">
                        @foreach($settings as $setting)
                            <div class="col-md-6 mb-3">
                                @php
                                    $displayKey = str_replace(['mail_', '_'], ['', ' '], $setting->key);
                                    $displayKey = strtoupper($displayKey);
                                    $helpText = '';
                                    if ($setting->key === 'mail_mailer') {
                                        $helpText = 'Usually "smtp". avoid putting host here.';
                                    }
                                @endphp
                                <label class="form-label fw-bold">{{ $displayKey }}</label>

                                @if($setting->type === 'password')
                                    <input type="password" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                        class="form-control" placeholder="Enter {{ $displayKey }}">
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-control"
                                        placeholder="Enter {{ $displayKey }}">
                                @endif

                                <div class="form-text small text-muted">
                                    @if($helpText) <span class="text-primary d-block mb-1"><i class="bi bi-info-circle"></i>
                                    {{ $helpText }}</span> @endif
                                    Key: <code>{{ $setting->key }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5">Save SMTP Configuration</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 bg-light border-0 shadow-sm">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Quick Help</h6>
                <div class="small text-muted">
                    <p>These settings configure how the application sends emails. Common values for popular services:</p>

                    <div class="mb-3">
                        <strong>Gmail (App Password):</strong>
                        <ul class="mb-0">
                            <li>Host: <code>smtp.gmail.com</code></li>
                            <li>Port: <code>587</code></li>
                            <li>Encryption: <code>tls</code></li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <strong>Mailtrap (Testing):</strong>
                        <ul class="mb-0">
                            <li>Host: <code>sandbox.smtp.mailtrap.io</code></li>
                            <li>Port: <code>2525</code></li>
                            <li>Encryption: <code>tls</code></li>
                        </ul>
                    </div>

                    <div class="alert alert-info p-2 small mb-0">
                        <i class="bi bi-shield-lock me-1"></i> Changes here will affect all system emails including password
                        resets and notifications.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection