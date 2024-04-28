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
<div class="row g-0">
    <div class="col-lg-8 pe-lg-2">
        <div class="card mb-3">
            <div class="card-header bg-body-tertiary">
                <h6 class="mb-0">Basic information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.admin.products.store') }}">
                    @csrf
                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-title">{{ __('Product title') }}:</label>
                        <input class="form-control" id="product-title" type="text" name="title" :value="{{ old('title') }}" placeholder="{{ __('Title') }}" required />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-description">{{ __('Description') }}:</label>
                        <input class="form-control" id="product-description" type="text" name="description" :value="{{ old('description') }}" placeholder="{{ __('Description') }}" required />
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label" for="product-price">{{ __('Price') }}:</label>
                        <input class="form-control" id="product-price" type="text" name="price" :value="{{ old('price') }}" placeholder="{{ __('Price') }}" required />
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit" role="button">Add product</button>
                </form>
            </div>

        </div>
        <div class="card mb-3">
            <div class="card-header bg-body-tertiary">
                <h6 class="mb-0">Add images</h6>
            </div>
            <div class="card-body">
                <form class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload" data-dropzone="data-dropzone" action="#!" data-options='{"acceptedFiles":"image/*"}'>
                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple" />
                    </div>
                    <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2" src="{{ asset('dashboard/public/assets/img/icons/cloud-upload.svg') }}" width="25" alt="" /><span class="d-none d-lg-inline">Drag your image here<br />or, </span><span class="btn btn-link p-0 fs-10">Browse</span></div>
                    <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                        <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger"><img class="dz-image" src="../../../assets/img/icons/cloud-upload.svg" alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                            <div class="flex-1 d-flex flex-between-center">
                                <div>
                                    <h6 data-dz-name="data-dz-name"></h6>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fs-10 text-400 lh-1" data-dz-size="data-dz-size"></p>
                                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                    </div>
                                </div>
                                <div class="dropdown font-sans-serif">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end border py-2"><a class="dropdown-item" href="#!" data-dz-remove="data-dz-remove">Remove File</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-lg-4 ps-lg-2">
        <div class="sticky-sidebar">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Type</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="product-category">Select category:</label>
                            <select class="form-select" id="product-category" name="product-category">
                                <option value="computerAccessories">Computer & Accessories</option>
                                <option>Class, Training, or Workshop</option>
                                <option>Concert or Performance</option>
                                <option>Conference</option>
                                <option>Convention</option>
                                <option>Dinner or Gala</option>
                                <option>Festival or Fair</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="product-subcategory">Select sub-category:</label>
                            <select class="form-select" id="product-subcategory" name="product-subcategory">
                                <option value="laptop">Laptop</option>
                                <option>Class, Training, or Workshop</option>
                                <option>Concert or Performance</option>
                                <option>Conference</option>
                                <option>Convention</option>
                                <option>Dinner or Gala</option>
                                <option>Festival or Fair</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Tags</h6>
                </div>
                <div class="card-body">
                    <label class="form-label" for="product-tags">Add a keyword:</label>
                    <input class="form-control js-choice" id="product-tags" type="text" name="tags" required="required" size="1" data-options='{"removeItemButton":true,"placeholder":false}' />
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
                <button class="btn btn-link text-secondary p-0 me-3 fw-medium" role="button">Discard</button>
                <button class="btn btn-primary" type="submit" role="button">Add product</button>
            </div>
        </div>
    </div>
</div>
@endsection