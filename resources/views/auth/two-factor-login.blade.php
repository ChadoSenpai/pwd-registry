<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Factor Verification | PWD Registry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body data-bs-theme="light" class="bg-body-tertiary d-flex align-items-center" style="min-height:100vh">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="text-decoration-none text-dark fw-semibold fs-4">PWD
                        Registry</a>
                    <p class="text-muted mt-3 mb-0">Enter your authenticator code to finish signing in.</p>
                </div>
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login.2fa.verify') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="otp" class="form-label">Authentication code</label>
                                <input id="otp" type="text" name="otp" value="{{ old('otp') }}"
                                    class="form-control @error('otp') is-invalid @enderror" required autofocus>
                                @error('otp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100">Verify and sign in</button>
                        </form>
                    </div>
                </div>
                <p class="text-center small text-muted mt-3">If you did not request this, contact support.</p>
            </div>
        </div>
    </main>
</body>

</html>
