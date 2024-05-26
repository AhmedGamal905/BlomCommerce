<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::query()
            ->latest()
            ->paginate();

        return view('dashboard.orders.index', compact('orders'));
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
        return view('dashboard.orders.details', compact('products'));
    }

    public function update(Request $request, string $id)
    {
    }
}
