@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="text-center mb-4">
        <div style="font-size:2.5rem;margin-bottom:0.5rem">🍽️</div>
        <h4 style="font-weight:700;color:#1e293b">Welcome Back</h4>
        <p style="color:#64748b;font-size:0.875rem">Sign in to your MenuApp account</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 small py-2">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                    placeholder="your@email.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                <input type="password" name="password" id="password"
                    class="form-control border-start-0 border-end-0"
                    placeholder="Your password" required>
                <button type="button" class="input-group-text bg-light" onclick="togglePass()">
                    <i class="bi bi-eye text-muted" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember" style="color:#64748b">Remember me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
        </button>
    </form>

    <hr class="my-4">
    <div class="text-center small" style="color:#64748b">
        Don't have an account?
        <a href="{{ route('register') }}" style="color:#4f46e5;font-weight:600;text-decoration:none">Register now</a>
    </div>
</div>

<script>
function togglePass() {
    const el = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');
    if (el.type === 'password') {
        el.type = 'text';
        eye.className = 'bi bi-eye-slash text-muted';
    } else {
        el.type = 'password';
        eye.className = 'bi bi-eye text-muted';
    }
}
</script>
@endsection
