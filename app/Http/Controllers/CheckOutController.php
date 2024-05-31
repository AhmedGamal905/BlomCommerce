<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder;
use App\Models\Order;
use App\Traits\CartItems;

class CheckOutController
{
    use CartItems;

    public function index()
    {
        $totalPrice = $this->getCartItems()->sum('total_price');

        if ($totalPrice <= 0) {
            session()->flash('error', 'Add a product to the cart!');

            return to_route('cart.show');
        }

        return view('user.checkOut', compact('totalPrice'));
    }

    public function store(CreateOrder $request)
    {
        $user = auth()->user();

        $cart = $this->getCartItems();

        $order = Order::create($request->validated() + [
            'user_id' => $user->id,
            'email' => $user->email,
            'total' => $cart->sum('total_price'),
        ]);

        $products = $cart->mapWithKeys(function ($cartItem) {
            return [
                $cartItem['product']['id'] => [
                    'quantity' => $cartItem['quantity'],
                ],
            ];
        })->toArray();

        $order->products()->attach($products);

        session()->forget('cart');

        session()->flash('success', 'Order placed successfully!');

        return to_route('orders.index');
    }
}
