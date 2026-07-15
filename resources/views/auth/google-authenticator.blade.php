@extends('layouts.app')

@section('page_title', 'Google Authenticator')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <h3 class="card-title mb-0">Google Authenticator</h3>
                    <span class="badge bg-{{ $user->google2fa_enabled ? 'success' : 'secondary' }}">
                        {{ $user->google2fa_enabled ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="alert alert-info d-flex align-items-center gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <div>Two-factor authentication can be enabled here for added account security.</div>
                    </div>
                    <p class="text-muted mb-4">
                        Scan the QR code with your Google Authenticator app to secure your account.
                    </p>
                    <div class="border rounded p-4 text-center bg-light position-relative overflow-hidden">
                        <div class="position-absolute top-0 left-0 w-100 h-100 bg-primary bg-opacity-5"></div>
                        <img src="{{ $qrUrl }}" alt="Google Authenticator QR code"
                            class="img-fluid mx-auto d-block mb-3 position-relative" style="width: 200px; height: 200px;" />
                        <p class="mb-0 fw-semibold position-relative">Scan this QR code with your authenticator app.</p>
                    </div>
                    <div class="mt-4 small text-start">
                        <p class="mb-1"><strong>Manual setup code:</strong></p>
                        <p class="badge rounded-pill bg-secondary text-white">{{ $secret }}</p>
                    </div>

                    <form method="POST"
                        action="{{ $user->google2fa_enabled ? route('settings.google-authenticator.disable') : route('settings.google-authenticator.enable') }}"
                        class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">Authentication code</label>
                            <input id="otp" name="otp" type="text"
                                class="form-control @error('otp') is-invalid @enderror" placeholder="Enter 6-digit code"
                                required>
                            @error('otp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-{{ $user->google2fa_enabled ? 'danger' : 'primary' }} w-100 d-flex align-items-center justify-content-center gap-2">
                            @if($user->google2fa_enabled)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M711V7a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v4"/></svg>
                            @else
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v4"/></svg>
                            @endif
                            {{ $user->google2fa_enabled ? 'Disable Authenticator' : 'Enable Authenticator' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
