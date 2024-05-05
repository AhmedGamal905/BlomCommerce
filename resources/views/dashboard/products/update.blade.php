@extends('dashboard.layout.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">Update an existing product</h5>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('dashboard.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Basic information</h6>
                </div>
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-title">{{ __('Product title') }}:</label>
                        <input class="form-control" id="product-title" type="text" name="title" value="{{ $product->title }}" placeholder="{{ __('Title') }}" required />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-description">{{ __('Description') }}:</label>
                        <input class="form-control" id="product-description" type="text" name="description" value="{{ $product->description }}" placeholder="{{ __('Description') }}" required />
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-price">{{ __('Price') }}:</label>
                        <input class="form-control" id="product-price" type="text" name="price" value="{{ $product->price }}" placeholder="{{ __('Price') }}" required />
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Product images / Total should not exceed 5 images</h6>
                </div>
                <div class="card-body">
                    @if ($product->getMedia('product_images')->isNotEmpty())
                    <h6 class="mb-2">Images to Remove:</h6>
                    @foreach ($product->getMedia('product_images') as $image)
                    <img src="{{ $image->getUrl() }}" alt="{{ $product->title }}" width="100" height="100">
                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                    @endforeach
                    @else
                    No image available
                    @endif
                </div>

                <div class="card-body">
                    <h6 class="mb-2">Add images:</h6>
                    <input class="form-control" id="formFileMultiple" type="file" name="new_images[]" accept=".jpeg,.png,.jpg" multiple />
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Select category:</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <select class="form-select" id="product-category" name="category_id" required>
                                    <option value="">{{ __('Select a category') }}</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row justify-content-between align-items-center">
                <div class="col-md">
                    <h5 class="mb-2 mb-md-0">You're almost done!</h5>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Update product</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection