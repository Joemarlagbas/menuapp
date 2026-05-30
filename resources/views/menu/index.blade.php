@extends('layouts.app')
@section('title', 'Menu Items')
@section('page-title', 'Menu Items')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="mb-0 fw-bold" style="color:#1e293b">My Menu Items</h5>
                <p class="text-muted small mb-0">{{ $items->total() }} items</p>
            </div>
            <a href="{{ route('menu-items.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Add Item
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Added</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td style="font-weight:500">{{ $item->name }}</td>
                        <td>
                            <span class="badge" style="background:#e0e7ff;color:#4f46e5">{{ $item->category }}</span>
                        </td>
                        <td style="font-weight:600;color:#059669">₱{{ number_format($item->price, 2) }}</td>
                        <td>
                            @if($item->available)
                                <span class="badge" style="background:#dcfce7;color:#16a34a">Available</span>
                            @else
                                <span class="badge" style="background:#fef2f2;color:#dc2626">Unavailable</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ Str::limit($item->description, 40) ?: '—' }}</td>
                        <td class="text-muted small">{{ $item->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('menu-items.edit', $item) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('menu-items.destroy', $item) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ addslashes($item->name) }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-journal-richtext fs-2 d-block mb-2"></i>
                            No menu items yet. <a href="{{ route('menu-items.create') }}">Add your first item</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $items->links() }}</div>
    </div>
</div>
@endsection
