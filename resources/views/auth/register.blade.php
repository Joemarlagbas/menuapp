@extends('layouts.guest')
@section('title', 'Register')

@section('content')
<div class="auth-card">
    <div class="text-center mb-4">
        <div style="font-size:2.5rem;margin-bottom:0.5rem">🍽️</div>
        <h4 style="font-weight:700;color:#1e293b">Create Account</h4>
        <p style="color:#64748b;font-size:0.875rem">Join MenuApp and start managing your menu</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 small py-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                <input type="text" name="name" class="form-control border-start-0 @error('name') is-invalid @enderror"
                    placeholder="Juan Dela Cruz" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                    placeholder="juan@example.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                <input type="password" name="password" id="password"
                    class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                    placeholder="Min. 8 characters" required>
                <button type="button" class="input-group-text bg-light" onclick="togglePass('password','eye1')">
                    <i class="bi bi-eye text-muted" id="eye1"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control border-start-0 border-end-0"
                    placeholder="Repeat your password" required>
                <button type="button" class="input-group-text bg-light" onclick="togglePass('password_confirmation','eye2')">
                    <i class="bi bi-eye text-muted" id="eye2"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-person-plus me-2"></i>Create Account
        </button>
    </form>

    <hr class="my-4">
    <div class="text-center small" style="color:#64748b">
        Already have an account?
        <a href="{{ route('login') }}" style="color:#4f46e5;font-weight:600;text-decoration:none">Sign in</a>
    </div>
</div>

<script>
function togglePass(id, eyeId) {
    const el = document.getElementById(id);
    const eye = document.getElementById(eyeId);
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
