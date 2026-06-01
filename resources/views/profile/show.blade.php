I
@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="row">

    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-body text-center">

                @if($user->avatar)
                    <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                         alt="Avatar"
                         class="rounded-circle mb-3"
                         width="100" height="100">
                @else
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:100px;height:100px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <h5>{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>

                <span class="badge bg-primary">
                    {{ $user->is_admin ? 'Administrator' : 'User' }}
                </span>

                <hr>

                <p><strong>Phone:</strong> {{ $user->phone ?? 'Not set' }}</p>
                <p><strong>Address:</strong> {{ $user->address ?? 'Not set' }}</p>
                <p><strong>Gender:</strong> {{ $user->gender ?? 'Not set' }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>

                <hr>

                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="avatar" class="form-control mb-2">

                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <button class="btn btn-primary w-100">
                        Upload Photo
                    </button>
                </form>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <h5 class="mb-3">Edit Profile</h5>

                @if($errors->any() && !$errors->has('avatar'))
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', $user->address) }}">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">
                        Save Changes
                    </button>

                </form>

            </div>
        </div>
    </div>

</div>
@endsection
```


