<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Traits\CartItems;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function history()
    {
        $orders = Order::query()
            ->where('user_id', Auth()->user()->id)
            ->latest()
            ->paginate();

        return view('user.orderHistory', compact('orders'));
    }

    public function store(CreateOrder $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['email'] = auth()->user()->email;
        $data['total'] = $this->getCartItems()->sum('total_price');

        $order = Order::create($data);

        foreach ($this->getCartItems() as $cartItem) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartItem['product']['id'],
                'quantity' => $cartItem['quantity'],
            ]);
        }

        session()->flash('success', 'Order placed successfully!');

        $request->session()->forget('cart');

        return to_route('order.history');
    }


    public function show(Order $order)
    {
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        $products = [];

        foreach ($orderProducts as $orderProduct) {
            $product = Product::find($orderProduct->product_id);
            $products[] = [
                'product' => $product,
                'quantity' => $orderProduct->quantity,
            ];
        }
        return view('user.orderDetails', compact('products'));
    }
}
