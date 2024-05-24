@extends('user.layout.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @forelse ($products as $product)
            <div class="mb-4 col-md-6 col-lg-4">
                <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
                    <div class="overflow-hidden">
                        <div class="position-relative rounded-top overflow-hidden">
                            @if ($product->getFirstMedia('product_images'))
                            <a class="d-block" href="{{ route('product.details', $product) }}">
                                <img class="img-fluid rounded-top" style="width: 100%; height: auto; object-fit: cover;" src="{{ $product->getFirstMedia('product_images')->getUrl() }}" alt="{{ $product->title }}" />
                            </a>
                            @else
                            <p class="text-center my-auto">No image available</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-3">
                        <h5 class="fs-9"><a class="text-1100" href="{{ route('product.details', $product) }}">{{ $product->title }}</a></h5>
                        <h5 class="fs-md-7 text-warning mb-0 d-flex align-items-center mb-3"> ${{ $product->price }}
                        </h5>
                        <p class="fs-10 mb-1">Shipping Cost: <strong>Free</strong></p>
                        <p class="fs-10 mb-1">Stock: <strong class="text-success">Available</strong></p>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="quantity" value="1">

                        <div class="d-flex flex-between-center px-3">
                            <div>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-300"></span>
                                <span class="ms-1">(8)</span>
                            </div>
                            <button type="submit" class="btn btn-sm btn-falcon-default" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart">
                                <span class="fas fa-cart-plus"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <p>No products found in this category.</p>
            @endforelse
        </div>
    </div>
</div>

@if ($products->hasPages())
{{ $products->links() }}
@endif

@endsection