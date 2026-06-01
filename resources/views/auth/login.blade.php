@extends('layouts.guest')
@section('title', 'Login')

@section('content')

<div class="auth-card">

```
<div class="text-center mb-4">
    <i class="bi bi-person-circle fs-1 text-primary"></i>
    <h3 class="mt-2 mb-1">Welcome Back</h3>
    <p class="text-muted">Login to continue</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="POST" action="{{ route('login.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>

            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email"
                value="{{ old('email') }}"
                required
                autofocus
            >
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>

            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                placeholder="Enter your password"
                required
            >

            <button type="button" class="btn btn-outline-secondary" onclick="togglePass()">
                <i class="bi bi-eye" id="eyeIcon"></i>
            </button>
        </div>
    </div>

    <div class="form-check mb-4">
        <input
            class="form-check-input"
            type="checkbox"
            name="remember"
            id="remember"
        >

        <label class="form-check-label" for="remember">
            Remember Me
        </label>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        Login
    </button>

</form>

<hr>

<div class="text-center">
    <small class="text-muted">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-decoration-none">
            Register Here
        </a>
    </small>
</div>
```

</div>

<script>
function togglePass() {
    let password = document.getElementById('password');
    let eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.className = 'bi bi-eye-slash';
    } else {
        password.type = 'password';
        eyeIcon.className = 'bi bi-eye';
    }
}
</script>

@endsection
