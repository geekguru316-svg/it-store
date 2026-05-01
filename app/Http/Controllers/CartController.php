<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


use App\Models\Order;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        
        // Handle "Buy Now" - if a product ID is submitted directly, use it
        if ($request->has('id')) {
            $buyNowId = (int) $request->id;
            $qty = (int) ($request->quantity ?? 1);
            $product = Product::findOrFail($buyNowId);
            
            $orderItems = [[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qty
            ]];
            $total = $product->price * $qty;
        } else {
            // Standard cart checkout
            if (empty($cart)) {
                return back()->with('error', 'Cart is empty');
            }

            $quantities = array_count_values($cart);
            $products = Product::whereIn('id', array_keys($quantities))->get();
            
            $total = 0;
            $orderItems = [];
            
            foreach ($products as $product) {
                $qty = $quantities[$product->id];
                $total += $product->price * $qty;
                $orderItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty
                ];
            }
        }

        Order::create([
            'customer_name' => $request->name ?? 'Guest',
            'customer_email' => $request->email,
            'items' => json_encode($orderItems),
            'total' => $total,
            'status' => 'pending'
        ]);

        if (!$request->has('id')) {
            session()->forget('cart');
        }

        return redirect()->route('products.index')->with('success', 'Order placed!');
    }

    public function index()
    {
        $cart = session('cart', []);

        $quantities = [];
        foreach ($cart as $id) {
            $quantities[$id] = ($quantities[$id] ?? 0) + 1;
        }

        $products = Product::whereIn('id', array_keys($quantities))->get();

        $total = 0;
        foreach ($products as $product) {
            $qty = $quantities[$product->id] ?? 0;
            $total += $product->price * $qty;
        }

        return view('cart', compact('products', 'total', 'quantities'));
    }

    public function remove(Request $request)
    {
        $id = (int) $request->id;
        $type = $request->input('type', 'all');

        $cart = session('cart', []);

        if ($type === 'one') {
            $removed = false;
            foreach ($cart as $key => $item) {
                if (!$removed && $item === $id) {
                    unset($cart[$key]);
                    $removed = true;
                }
            }
        } else {
            $cart = array_filter($cart, fn($item) => $item !== $id);
        }

        session(['cart' => array_values($cart)]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function update(Request $request)
    {
        $id = (int) $request->id;
        $quantity = max(0, (int) $request->quantity);

        $cart = session('cart', []);

        $cart = array_filter($cart, fn($item) => $item !== $id);

        for ($i = 0; $i < $quantity; $i++) {
            $cart[] = $id;
        }

        session(['cart' => array_values($cart)]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function add(Request $request)
    {
        $id = (int) $request->id;
        $product = Product::find($id);

        if (!$product || $product->stock <= 0) {
            return redirect()->back()->with('error', 'Product not available');
        }

        $cart = session('cart', []);
        $cart[] = $id ;
        session(['cart' => $cart]);

        // Signal the frontend to auto-open the drawer after page reload
        return redirect()->back()->with('success', 'Added to Bag!')->with('open_cart', true);
    }
}
