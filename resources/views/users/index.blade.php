@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')

<div class="card">

```
<div class="card-body">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">Users</h5>
            <small class="text-muted">{{ $users->total() }} total users</small>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus me-1"></i>
            Add User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date Joined</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="text-muted">{{ $user->id }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2">

                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                     style="width:35px;height:35px;font-weight:600;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <span>{{ $user->name }}</span>

                            </div>
                        </td>

                        <td class="text-muted">{{ $user->email }}</td>

                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>

                        <td class="text-muted">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        <td class="text-end">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            No users found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>

</div>
```

</div>

@endsection
