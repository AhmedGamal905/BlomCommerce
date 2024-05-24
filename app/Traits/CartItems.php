<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Collection;


trait CartItems
{
    protected function getCartItems(): Collection
    {
        $cart = collect(session('cart', []));

        $products = Product::whereIn('id', $cart->keys()->toArray())->with('media')->get();

        return $cart->map(function ($quantity, $productId) use ($products) {
            $product = $products->where('id', $productId)->first();
            return [
                'product' => $product,
                'quantity' => $quantity,
                'total_price' => $quantity * $product->price,
            ];
        });
    }
}
