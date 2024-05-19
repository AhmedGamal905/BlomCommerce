<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = collect(session('cart', []))->map(function ($quantity, $productId) {
            return [
                'product' => Product::findOrFail($productId),
                'quantity' => $quantity
            ];
        });

        return view('user.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        $quantity = $request->integer('quantity', 1);

        $cart[$product->id] = isset($cart[$product->id])
            ? $quantity + $cart[$product->id]
            : $quantity;

        session()->put('cart', $cart);

        session()->flash('success', 'Product added to cart successfully!');

        return back();
    }

    public function deleteFromCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            session()->flash('success', 'Product removed from cart successfully!');
        } else {
            session()->flash('error', 'Product not found in cart!');
        }

        return back();
    }
}
