@extends('dashboard.layout.app')

@section('content')
<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="white-space-nowrap"></th>
                <th class="text-black dark__text-white align-middle">ID</th>
                <th class="text-black dark__text-white align-middle">Image</th>
                <th class="text-black dark__text-white align-middle">Title</th>
                <th class="text-black dark__text-white align-middle">Price</th>
                <th class="text-black dark__text-white align-middle">Created At</th>
                <th class="text-black dark__text-white align-middle">Update</th>
                <th class="text-black dark__text-white align-middle">Delete</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($products as $product)
            <tr>
                <td class="white-space-nowrap"></td>
                <td class="align-middle">{{ $product->id }}</td>
                <td class="align-middle">
                    @if ($product->getFirstMedia('product_images'))
                    <img src="{{ $product->getFirstMedia('product_images')->getUrl() }}" alt="{{ $product->title }}" width="75">
                    @else
                    No image available
                    @endif
                </td>
                <td class="align-middle">{{ $product->title }}</td>
                <td class="align-middle">${{ $product->price }}</td>
                <td class="align-middle">{{ $product->created_at->format('j M Y, g:i a') }}</td>

                <td class="align-middle">
                    <form method="GET" action="{{ route('dashboard.products.edit', $product->id) }}">
                        <button class="btn btn-outline-warning me-1 mb-1" type="submit">Update</button>
                    </form>
                </td>

                <td class="align-middle white-space-nowrap text-end pe-3">
                    <form method="POST" action="{{ route('dashboard.products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger me-1 mb-1" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($products->hasPages())
{{ $products->links() }}
@endif
@endsection