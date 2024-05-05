@extends('dashboard.layout.app')

@section('content')
<div class="card mb-3">
    <div class="card-header bg-body-tertiary">
        <h6 class="mb-0">Add a category</h6>
    </div>
    <form method="POST" action="{{ route('dashboard.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="col-12 mb-3">
                <label class="form-label" for="product-title">{{ __('Category title') }}:</label>
                <input class="form-control" id="product-title" type="text" name="title" value="{{ $category->title }}" placeholder="{{ __('Title') }}" required />
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
@endsection