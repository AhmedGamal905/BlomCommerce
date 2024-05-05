@extends('dashboard.layout.app')

@section('content')

<div class="card mb-3">
    <div class="card-header bg-body-tertiary">
        <h6 class="mb-0">Add a category</h6>
    </div>
    <form method="POST" action="{{ route('dashboard.categories.store') }}">
        @csrf
        <div class="card-body">
            <div class="col-12 mb-3">
                <label class="form-label" for="product-title">{{ __('Category title') }}:</label>
                <input class="form-control" id="product-title" type="text" name="title" value="{{ old('title') }}" placeholder="{{ __('Title') }}" required />
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>


<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="white-space-nowrap"></th>
                <th class="text-black dark__text-white align-middle">ID</th>
                <th class="text-black dark__text-white align-middle">Name</th>
                <th class="text-black dark__text-white align-middle">Created at</th>
                <th class="text-black dark__text-white align-middle">Update</th>
                <th class="text-black dark__text-white align-middle">Delete</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($categories as $category)
            <tr>
                <td class="white-space-nowrap"></td>
                <td class="align-middle">{{ $category->id }}</td>
                <td class="align-middle">{{ $category->title }}</td>
                <td class="align-middle">{{ $category->created_at->format('j M Y, g:i a') }}</td>
                <td class="align-middle">
                    <form method="GET" action="{{ route('dashboard.categories.edit', $category) }}">
                        <button class="btn btn-outline-warning me-1 mb-1" type="submit">Update</button>
                    </form>
                </td>
                <td class="align-middle white-space-nowrap text-end pe-3">
                    <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger me-1 mb-1" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($categories->hasPages())
{{ $categories->links() }}
@endif
@endsection