@extends('dashboard.layout.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">Add a product</h5>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Basic information</h6>
                </div>
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-title">{{ __('Product title') }}:</label>
                        <input class="form-control" id="product-title" type="text" name="title" value="{{ old('title') }}" placeholder="{{ __('Title') }}" required />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-description">{{ __('Description') }}:</label>
                        <input class="form-control" id="product-description" type="text" name="description" value="{{ old('description') }}" placeholder="{{ __('Description') }}" required />
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-price">{{ __('Price') }}:</label>
                        <input class="form-control" id="product-price" type="text" name="price" value="{{ old('price') }}" placeholder="{{ __('Price') }}" required />
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Add images</h6>
                </div>
                <div class="card-body">
                    <input class="form-control" id="formFileMultiple" type="file" name="images[]" accept=".jpeg,.png,.jpg" multiple required />
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
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                    <button class="btn btn-primary" type="submit">Add product</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection