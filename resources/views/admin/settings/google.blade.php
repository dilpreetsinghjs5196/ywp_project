@extends('admin.layouts.app')

@section('title', 'Google Calendar Settings')
@section('page_title', 'Google Calendar API Configuration')

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
                                    $displayKey = str_replace(['google_', '_'], ['', ' '], $setting->key);
                                    $displayKey = strtoupper($displayKey);
                                @endphp
                                <label class="form-label fw-bold">{{ $displayKey }}</label>

                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-control"
                                    placeholder="Enter {{ $displayKey }}">

                                <div class="form-text small text-muted">
                                    Key: <code>{{ $setting->key }}</code>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5">Save Google Configuration</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 bg-light border-0 shadow-sm">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Setup Guide</h6>
                <div class="small text-muted">
                    <p>To get these credentials:</p>
                    <ol class="ps-3 mb-3">
                        <li>Go to <a href="https://console.cloud.google.com/" target="_blank">Google Cloud Console</a>.</li>
                        <li>Create a New Project.</li>
                        <li>Enable <strong>Google Calendar API</strong>.</li>
                        <li>Configure <strong>OAuth Consent Screen</strong> (External).</li>
                        <li>Create <strong>OAuth 2.0 Client ID</strong> (Web Application).</li>
                        <li>Add this Redirect URI: <br><code>{{ url('/therapist/google-calendar/callback') }}</code></li>
                    </ol>
                    <div class="alert alert-warning p-2 small mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i> Do not share these credentials with anyone.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection