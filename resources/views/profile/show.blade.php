@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="row g-4">

    {{-- PROFILE CARD --}}
    <div class="col-lg-4">
        <div class="card text-center">
            <div class="card-body p-4">

                {{-- Avatar Display --}}
                @if($user->avatar)
                    <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                        alt="Avatar"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4f46e5&color=fff'"
                        style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:4px solid #e0e7ff;margin-bottom:1rem">
                @else
                    <div style="width:100px;height:100px;border-radius:50%;background:#e0e7ff;display:flex;align-items:center;justify-content:center;color:#4f46e5;font-weight:700;font-size:2.5rem;margin:0 auto 1rem">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-2">{{ $user->email }}</p>

                <span class="badge" style="background:#e0e7ff;color:#4f46e5;font-size:0.75rem">
                    {{ $user->is_admin ? 'Administrator' : 'User' }}
                </span>

                <hr class="my-3">

                <div class="text-start small">
                    <div class="d-flex gap-2 mb-2">
                        <i class="bi bi-telephone text-muted"></i>
                        <span class="text-muted">{{ $user->phone ?: 'Not set' }}</span>
                    </div>

                    <div class="d-flex gap-2 mb-2">
                        <i class="bi bi-geo-alt text-muted"></i>
                        <span class="text-muted">{{ $user->address ?: 'Not set' }}</span>
                    </div>

                    <div class="d-flex gap-2 mb-2">
                        <i class="bi bi-person-badge text-muted"></i>
                        <span class="text-muted">{{ $user->gender ?: 'Not set' }}</span>
                    </div>

                    <div class="d-flex gap-2">
                        <i class="bi bi-calendar text-muted"></i>
                        <span class="text-muted">
                            Joined {{ $user->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <hr class="my-3">

                {{-- AVATAR UPLOAD --}}
                <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                    @csrf

                    <label class="form-label small fw-semibold">Change Profile Picture</label>

                    <input type="file" name="avatar"
                        class="form-control form-control-sm mb-2"
                        accept="image/*">

                    @error('avatar')
                        <div class="text-danger small mb-2">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-upload me-1"></i>Upload Photo
                    </button>
                </form>

            </div>
        </div>
    </div>

    {{-- EDIT PROFILE --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-4" style="color:#1e293b">
                    Edit Profile Information
                </h5>

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any() && !$errors->has('avatar'))
                    <div class="alert alert-danger small rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- PROFILE UPDATE FORM --}}
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-sm-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select...</option>
                                @foreach(['Male','Female','Other'] as $g)
                                    <option value="{{ $g }}"
                                        {{ old('gender', $user->gender) == $g ? 'selected' : '' }}>
                                        {{ $g }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $user->address) }}">
                        </div>

                    </div>

                    <hr class="my-4">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>

                </form>

            </div>
        </div>

        {{-- ACCOUNT INFO --}}
        <div class="card mt-3">
            <div class="card-body p-4">

                <h6 class="fw-bold mb-3" style="color:#1e293b">
                    Account Info
                </h6>

                <div class="row g-2 small text-muted">
                    <div class="col-sm-4">
                        <strong>Account ID:</strong> #{{ $user->id }}
                    </div>

                    <div class="col-sm-4">
                        <strong>Role:</strong>
                        {{ $user->is_admin ? 'Administrator' : 'User' }}
                    </div>

                    <div class="col-sm-4">
                        <strong>Created:</strong>
                        {{ $user->created_at->format('M d, Y') }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection