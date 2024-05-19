<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'media'])
            ->latest()
            ->paginate();

        return view('user.welcome', compact('products'));
    }
    public function categoryProducts($category)
    {
        $products = Category::findOrFail($category)
            ->products()
            ->with('media')
            ->latest()
            ->paginate();

        return view('user.categoryProducts', compact('products'));
    }
    public function details(Product $product)
    {
        return view('user.productDetails', compact('product'));
    }
}
