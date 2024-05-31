<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate();

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['products' => ['media']]);

        return view('user.orders.show', compact('order'));
    }
}
