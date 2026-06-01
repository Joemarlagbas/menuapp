@extends('layouts.guest')
@section('title', 'Register')

@section('content')

<div class="auth-card">

```
<div class="text-center mb-4">
    
    <h3 class="mb-1">Create Account</h3>
    <p class="text-muted">Sign up to start using MenuApp</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>
            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Juan Dela Cruz"
                required
            >
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>
            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="juan@example.com"
                required
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
                id="password"
                name="password"
                class="form-control"
                placeholder="Minimum 8 characters"
                required
            >

            <button type="button" class="btn btn-outline-secondary" onclick="togglePass('password','eye1')">
                <i class="bi bi-eye" id="eye1"></i>
            </button>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Confirm Password</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-lock-fill"></i>
            </span>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                placeholder="Repeat password"
                required
            >

            <button type="button" class="btn btn-outline-secondary" onclick="togglePass('password_confirmation','eye2')">
                <i class="bi bi-eye" id="eye2"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-person-plus me-2"></i>
        Create Account
    </button>

</form>

<hr>

<div class="text-center">
    <small class="text-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="text-decoration-none">
            Sign in
        </a>
    </small>
</div>
```

</div>

<script>
function togglePass(id, eyeId) {
    const input = document.getElementById(id);
    const icon = document.getElementById(eyeId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>

@endsection
