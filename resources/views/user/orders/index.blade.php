@extends('user.layout.app')

@section('content')
<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="white-space-nowrap"></th>
                <th class="text-black dark__text-white align-middle">Order ID</th>
                <th class="text-black dark__text-white align-middle">Created at</th>
                <th class="text-black dark__text-white align-middle">Total Price</th>
                <th class="text-black dark__text-white align-middle">Status</th>
                <th class="text-black dark__text-white align-middle">Details</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($orders as $order)
            <tr>
                <td class="white-space-nowrap"></td>
                <td class="align-middle">{{ $order->id }}</td>
                <td class="align-middle">{{ $order->created_at->format('j M Y, g:i a') }}</td>
                <td class="align-middle">${{ $order->total }}</td>
                <td class="align-middle">{{ $order->status }}</td>
                <td class="align-middle">
                    <form method="GET" action="{{Route('orders.show', $order)}}">
                        <button class="btn btn-outline-info me-1 mb-1" type="submit">Details</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($orders->hasPages())
{{ $orders->links() }}
@endif
@endsection