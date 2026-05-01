<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $qty = $request->quantity ?? 1;

        if ($id) {
            $product = Product::findOrFail($id);
            $products = collect([$product]);
            $quantities = [$product->id => $qty];
            $total = $product->price * $qty;
        } else {
            $cart = session('cart', []);
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Cart is empty');
            }

            $quantities = array_count_values($cart);
            $products = Product::whereIn('id', array_keys($quantities))->get();
            
            $total = 0;
            foreach ($products as $product) {
                $total += $product->price * ($quantities[$product->id] ?? 0);
            }
        }

        return view('checkout', compact('total', 'products', 'quantities', 'id', 'qty'));
    }

    public function store(Request $request)
    {
        $total = 0;
        $orderItems = [];

        // Handle "Buy Now" or direct checkout from form
        if ($request->has('id')) {
            $product = Product::findOrFail($request->id);
            $qty = $request->quantity ?? 1;
            
            if ($product->stock < $qty) {
                return back()->with('error', 'Insufficient stock for ' . $product->name);
            }

            $orderItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qty
            ];
            $total = $product->price * $qty;
            
            // Decrement stock
            $product->decrement('stock', $qty);
            $product->increment('sold_count', $qty);
        } else {
            // Standard Cart Checkout
            $cart = session('cart', []);
            if (empty($cart)) {
                return redirect()->route('products.index')->with('error', 'Nothing to checkout');
            }

            $quantities = array_count_values($cart);
            $products = Product::whereIn('id', array_keys($quantities))->get();

            foreach ($products as $product) {
                $qty = $quantities[$product->id];
                if ($product->stock < $qty) {
                    return back()->with('err', 'Stock low for ' . $product->name);
                }
                
                $orderItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty
                ];
                $total += $product->price * $qty;
                
                $product->decrement('stock', $qty);
                $product->increment('sold_count', $qty);
            }
            
            session()->forget('cart');
        }

        $order = Order::create([
            'customer_name' => $request->name ?? 'Guest',
            'customer_email' => $request->email,
            'items' => json_encode($orderItems),
            'total' => $total,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'reference' => $request->reference
        ]);

        try {
            Mail::to($request->email)->send(new OrderPlaced($order));
        } catch (\Exception $e) {
            // Silently fail if mail is not configured
        }

        // --- PAYMONGO PAYMENT LINK/SOURCE INTEGRATION ---
        if ($request->payment_method === 'paymongo' || $request->payment_method === 'gcash_online') {
            try {
                if ($request->payment_method === 'gcash_online') {
                    // DIRECT GCASH VIA PAYMONGO SOURCES API
                    $response = Http::withBasicAuth(env('PAYMONGO_SECRET_KEY', 'sk_test_w3bd'), '')
                        ->post('https://api.paymongo.com/v1/sources', [
                            'data' => [
                                'attributes' => [
                                    'amount' => (int)($total * 100),
                                    'currency' => 'PHP',
                                    'type' => 'gcash',
                                    'redirect' => [
                                        'success' => route('products.index', ['payment' => 'success']),
                                        'failed' => route('products.index', ['payment' => 'failed']),
                                    ],
                                ]
                            ]
                        ]);
                        
                    if ($response->successful()) {
                        $link = $response['data']['attributes']['redirect']['checkout_url'];
                        return redirect($link);
                    }
                } else {
                    // STANDARD PAYMONGO LINKS API (Credit Card / E-Wallet)
                    $response = Http::withBasicAuth(env('PAYMONGO_SECRET_KEY', 'sk_test_w3bd'), '')
                        ->post('https://api.paymongo.com/v1/links', [
                            'data' => [
                                'attributes' => [
                                    'amount' => (int)($total * 100),
                                    'description' => 'Order #' . $order->id . ' Payment for ' . $order->customer_name,
                                    'remarks' => 'Order ID: ' . $order->id
                                ]
                            ]
                        ]);

                    if ($response->successful()) {
                        $link = $response['data']['attributes']['checkout_url'];
                        return redirect($link);
                    }
                }
            } catch (\Exception $e) {
                // FALLBACK: If API fails, continue but notify user
                return redirect()->route('products.index')->with('success', 'Order created, but payment gateway is temporarily unavailable. Please contact support.');
            }
        }

        return redirect()->route('products.index')->with('success', 'Thank you! Order placed successfully.');
    }
}
