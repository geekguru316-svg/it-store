@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)

    <div class="bg-white shadow rounded-lg p-6">

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach(session('cart') as $id => $item)
                @php
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                @endphp

                <tr class="border-b">
                    <td class="py-3">
                        <div class="font-semibold">{{ $item['name'] }}</div>
                    </td>

                    <td>₱{{ number_format($item['price'], 2) }}</td>

                    <td>
                        <form action="{{ route('cart.update', $id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity"
                                   value="{{ $item['quantity'] }}"
                                   min="1"
                                   class="w-16 border rounded px-2 py-1">
                            <button class="text-blue-600 text-sm ml-2">Update</button>
                        </form>
                    </td>

                    <td>₱{{ number_format($total, 2) }}</td>

                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button class="text-red-500 text-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Total -->
        <div class="text-right mt-6">
            <h2 class="text-xl font-bold">
                Total: ₱{{ number_format($grandTotal, 2) }}
            </h2>

            <button class="mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Checkout
            </button>
        </div>

    </div>

    @else
        <div class="text-center text-gray-500 py-10">
            Your cart is empty.
        </div>
    @endif

</div>
@endsection