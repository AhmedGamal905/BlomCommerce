<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'media'])
            ->latest()
            ->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'price' => ['required', 'numeric', 'max:999999.99'],
            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['image', 'max:2048'],
        ]);

        unset($data['images']);

        $product = Product::create($data);

        foreach ($request->file('images') as $image) {
            $product->addMedia($image)->toMediaCollection('product_images');
        }

        return to_route('dashboard.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.update', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'max:255'],
            'description' => 'required',
            'price' => ['required', 'numeric', 'max:999999.99'],
            'images.*' => ['image', 'max:2048'],
        ]);

        $afterUpdateCount = $product->getMedia('product_images')->count() -
            count($request->input('delete_images', [])) +
            ($request->hasFile('new_images') ? count($request->file('new_images')) : 0);

        if ($afterUpdateCount > 5) {
            return back()->withErrors(['images' => 'The total number of images after update must not exceed 5.']);
        }

        if (isset($request->delete_images)) {
            $product->getMedia('product_images')->whereIn('id', $request->delete_images)->map->delete();
        }

        $images = $request->file('new_images', []);

        if (count($images) > 0) {
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('product_images');
            }
        }

        unset($data['images']);

        $product->update($data);

        return to_route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('dashboard.products.index');
    }
}
