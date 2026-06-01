@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">

```
    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <h5 class="mb-0">
                    Edit User: {{ $user->name }}
                </h5>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        New Password
                        <small class="text-muted">(leave blank if no change)</small>
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        minlength="8"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                    >
                </div>

                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_admin"
                        id="is_admin"
                        value="1"
                        {{ $user->is_admin ? 'checked' : '' }}
                    >

                    <label class="form-check-label" for="is_admin">
                        Make this user an admin
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-save me-1"></i>
                        Save Changes
                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
```

</div>

@endsection
