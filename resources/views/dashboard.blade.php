@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Welcome to IT Store Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Products</h3>
            <p class="text-2xl">{{ $stats['total_products'] }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Your Cart Items</h3>
            <p class="text-2xl">{{ $stats['cart_items'] }}</p>
        </div>
        <div class="bg-purple-500 text-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Orders</h3>
            <p class="text-2xl">{{ $stats['total_orders'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300">Browse Products</a>
            <a href="{{ route('cart.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-300">View Cart</a>
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.index') }}" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition duration-300">Admin Panel</a>
            @endif
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Your Orders</h2>
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Order ID</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b">
                                <td class="px-4 py-2">#{{ $order->id }}</td>
                                <td class="px-4 py-2">${{ number_format($order->total, 2) }}</td>
                                <td class="px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">You haven't placed any orders yet.</p>
        @endif
    </div>
</div>
@endsection