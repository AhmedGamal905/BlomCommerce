@extends('user.layout.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-md-auto">
            <h5 class="mb-3 mb-md-0">Shopping Cart</h5>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row gx-x1 mx-0 bg-200 text-900 fs-10 fw-semi-bold">
            <div class="col-9 col-md-8 py-2 px-x1">Name</div>
            <div class="col-3 col-md-4 px-x1">
                <div class="row">
                    <div class="col-md-8 py-2 d-none d-md-block text-center">Quantity</div>
                    <div class="col-12 col-md-4 text-end py-2">Price</div>
                </div>
            </div>
        </div>

        @forelse ($cartItems as $item)

        <div class="row gx-x1 mx-0 align-items-center border-bottom border-200">
            <div class="col-8 py-3 px-x1">
                @if ($item['product']->getFirstMedia('product_images'))
                <div class="d-flex align-items-center"><a href="{{ route('product.details', $item['product']) }}"><img class="img-fluid rounded-1 me-3 d-none d-md-block" src="{{ $item['product']->getFirstMedia('product_images')->getUrl() }}" alt="{{ $item['product']->title }}" width="60" /></a>
                    <div class="flex-1">
                        <h5 class="fs-9"><a class="text-900" href="{{ route('product.details', $item['product']) }}">{{ $item['product']->title }}</a></h5>
                        <form action="{{ route('cart.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$item['product']->id}}">
                            <button class="btn btn-outline-danger me-1 mb-1" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
                @else
                <p class="text-center my-auto">No image available</p>
                @endif
            </div>
            <div class="col-4 py-3 px-x1">
                <div class="row align-items-center">
                    <div class="col-md-8 d-flex justify-content-end justify-content-md-center order-1 order-md-0">
                        <div>{{ $item['quantity'] }}</div>
                    </div>
                    <div class="col-md-4 text-end ps-0 order-0 order-md-1 mb-2 mb-md-0 text-600">${{ $item['total_price'] }}</div>
                </div>
            </div>
        </div>
        @empty
        <p>No products found in cart.</p>
        @endforelse
        <div class="row fw-bold gx-x1 mx-0">
            <div class="col-9 col-md-8 py-2 px-x1 text-900">Total</div>
            <div class="col px-0">
                <div class="row gx-x1 mx-50">
                    <div class="col-md-8 py-2 px-x1 d-none d-md-block text-center">{{ $cartItems->count() }} (items)</div>
                    <div class="col-12 col-md-4  py-2 px-x1">${{$cartItems->sum('total_price')}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-body-tertiary d-flex justify-content-end">
        <a class="btn btn-sm btn-primary" href="{{ route('checkout.index') }}">Checkout</a>
    </div>
</div>
@endsection