@extends('layouts.app')

@section('title', 'Edit Menu Item')
@section('page-title', 'Edit Menu Item')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">

```
    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('menu-items.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <h5 class="mb-0">
                    Edit Menu Item: {{ $menuItem->name }}
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

            <form method="POST" action="{{ route('menu-items.update', $menuItem) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Item Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $menuItem->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        @foreach(['Appetizer','Main Course','Dessert','Beverage','Soup','Salad','Side Dish','Snack'] as $cat)
                            <option value="{{ $cat }}"
                                {{ old('category', $menuItem->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price', $menuItem->price) }}"
                            min="0"
                            step="0.01"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Description
                        <small class="text-muted">(optional)</small>
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"
                    >{{ old('description', $menuItem->description) }}</textarea>
                </div>

                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="available"
                        id="available"
                        value="1"
                        {{ old('available', $menuItem->available) ? 'checked' : '' }}
                    >

                    <label class="form-check-label" for="available">
                        Available for order
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-save me-1"></i>
                        Update Item
                    </button>

                    <a href="{{ route('menu-items.index') }}" class="btn btn-outline-secondary">
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
