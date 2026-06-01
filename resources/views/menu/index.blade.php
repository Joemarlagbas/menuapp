@extends('layouts.app')

@section('title', 'Menu Items')
@section('page-title', 'Menu Items')

@section('content')

<div class="card">

```
<div class="card-body">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">Menu Items</h5>
            <small class="text-muted">{{ $items->total() }} total items</small>
        </div>

        <a href="{{ route('menu-items.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>
            Add Item
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
                    <th>Date Added</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $item)
                    <tr>

                        <td class="fw-semibold">
                            {{ $item->name }}
                        </td>

                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $item->category }}
                            </span>
                        </td>

                        <td class="fw-semibold text-success">
                            ₱{{ number_format($item->price, 2) }}
                        </td>

                        <td>
                            @if($item->available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>

                        <td class="text-muted small">
                            {{ Str::limit($item->description, 40) ?? '—' }}
                        </td>

                        <td class="text-muted small">
                            {{ $item->created_at->format('M d, Y') }}
                        </td>

                        <td class="text-end">

                            <div class="d-flex justify-content-end gap-1">

                                <a href="{{ route('menu-items.edit', $item) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('menu-items.destroy', $item) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete {{ $item->name }}?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            No menu items yet.
                            <a href="{{ route('menu-items.create') }}">Add your first item</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>

</div>
```

</div>

@endsection
