@extends('layouts.app')

@section('page_title', 'Change Password')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h3 class="card-title mb-0">Change Password</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('settings.password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input id="current_password" type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" placeholder="Confirm new password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Cancel</a>
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
