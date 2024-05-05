<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController
{
    public function index()
    {
        $products = Product::query()
            ->latest()
            ->paginate();
        return view('dashboard.products.index', compact('products'));
    }


    public function create()
    {
        return view('dashboard.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'price' => ['required', 'numeric', 'max:999999.99'],
            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $product = Product::create($data);

        foreach ($request->file('images') as $image) {
            $product->addMedia($image)->toMediaCollection('product_images');
        }

        return to_route('dashboard.products.index');
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.update', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'price' => ['required', 'numeric', 'max:999999.99'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $afterUpdateCount = $product->getMedia('product_images')->count() -
            count($request->input('delete_images', [])) +
            ($request->hasFile('new_images') ? count($request->file('new_images')) : 0);

        if ($afterUpdateCount > 5) {
            return back()->withErrors(['images' => 'The total number of images after update must not exceed 5.']);
        }

        if (isset($request->delete_images)) {
            $product->getMedia('product_images')->whereIn('id', $request->delete_images)->each(function ($media) {
                $media->delete();
            });
        }

        if ($request->hasFile('new_images')) {
            $images = $request->file('new_images');
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('product_images');
            }
        }

        $product->update($data);

        return to_route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        $product->getMedia('product_images')->each(function (Media $media) {
            $media->delete();
        });

        $product->delete();

        return to_route('dashboard.products.index');
    }
}
