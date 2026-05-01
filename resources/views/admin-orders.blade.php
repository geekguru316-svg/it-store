@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Orders</h1>

        <div class="bg-white p-6 rounded-lg shadow">

            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="p-2 text-left">Customer</th>
                        <th class="p-2">Total</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Status</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Shipping</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Payment</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Date</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="p-2">{{ $order->customer_name }}</td>
                            <td class="p-2 text-center">₱{{ number_format($order->total, 2) }}</td>
                            <td class="p-2 text-center">

                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded text-sm
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                        @elseif($order->status == 'completed') bg-green-100 text-green-700
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                        @endif">

                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                                    </select>
                                </form>

                            </td>
                            <td class="p-2 text-center">

                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex flex-col items-center gap-1">
                                    @csrf
                                    @method('PUT')

                                    <select name="shipping_status" onchange="this.form.submit()" class="px-2 py-1 rounded text-sm w-full
                        @if($order->shipping_status == 'processing') bg-yellow-100 text-yellow-700
                        @elseif($order->shipping_status == 'shipped') bg-blue-100 text-blue-700
                        @elseif($order->shipping_status == 'out_for_delivery') bg-indigo-100 text-indigo-700
                        @elseif($order->shipping_status == 'delivered') bg-green-100 text-green-700
                        @endif">

                                        <option value="processing" {{ $order->shipping_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->shipping_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="out_for_delivery" {{ $order->shipping_status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                        <option value="delivered" {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>Delivered</option>

                                    </select>
                                    
                                    <div class="flex w-full min-w-max">
                                        <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="Tracking #" class="px-2 py-1 w-24 text-[10px] font-bold border border-gray-200 rounded-l focus:ring-0 focus:border-blue-500">
                                        <button type="submit" title="Save Tracking" class="px-2 py-1 bg-gray-100 border-y border-r border-gray-200 rounded-r text-[10px] font-black text-gray-500 hover:bg-white hover:text-blue-600 transition-colors">
                                            ✓
                                        </button>
                                    </div>
                                </form>

                            </td>
                            <td class="p-2 text-center">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider {{ $order->payment_method == 'gcash' ? 'bg-blue-100 text-blue-700' : 'bg-indigo-100 text-indigo-700' }}">
                                    {{ $order->payment_method ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="p-2 text-center text-xs font-bold text-gray-500 italic">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="p-2 text-center">
                                <a href="{{ route('invoice', $order->id) }}" class="text-[10px] font-black uppercase text-blue-600 hover:text-gray-900 underline decoration-blue-500 decoration-2 transition-all">
                                    Invoice
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
@endsection