<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $order->load(['products' => ['media']]);

        $statuses = OrderStatus::cases();

        return view('dashboard.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(OrderStatus::class)],
        ]);

        $order->update($data);

        session()->flash('success', 'Order status updated successfully!');

        return to_route('dashboard.orders.show', $order);
    }
}
