@extends('dashboard.layout.app')

@section('content')
<div class="row g-0">
    <div class="col-lg-8 pe-lg-2">
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
    </div>
    <div class="col-lg-4 ps-lg-2">
        <div class="sticky-sidebar">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Select order status:</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2">
                        <form method="POST" action="{{ route('dashboard.orders.update', $order) }}">
                            @csrf
                            @method('PATCH')
                            <div class="col-12 mb-3">
                                <select class="form-select" id="order-status" name="status" required>
                                    <option value="">{{ __('Select an order status') }}</option>
                                    @foreach($statuses as $status)
                                    <option value="{{ $status->value }}" {{ $order->status == $status->value ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-outline-success me-1 mb-1" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection