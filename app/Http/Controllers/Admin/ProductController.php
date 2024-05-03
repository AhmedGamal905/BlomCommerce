<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->latest()
            ->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $images = $request->file('images');
        foreach ($images as $image) {
            $product->addMedia($image)->toMediaCollection('product_images');
        }

        return to_route('dashboard.products.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->getMedia('product_images')->each(function (Media $media) {
            $media->delete();
        });

        $product->delete();

        return to_route('dashboard.products.index');
    }
}
