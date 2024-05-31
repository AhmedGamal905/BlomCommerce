@extends('user.layout.app')

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
                <th class="text-black dark__text-white align-middle">Quantity</th>
                <th class="text-black dark__text-white align-middle">Product Details</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @foreach ($order->products as $product)
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
                <td class="align-middle">{{ $product->pivot->quantity }}</td>
                <td class="align-middle">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info me-1 mb-1">
                        Show
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection