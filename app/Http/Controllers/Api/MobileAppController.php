<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MobileAppController extends Controller
{
    /**
     * Mobile App Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credentials do not match.'
            ], 401);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    /**
     * Fetch products for the Flutter App
     */
    public function products(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(20);

        // Append explicit full URLs for images
        $products->getCollection()->transform(function($product) {
            $product->image_url = $product->image ? asset('storage/' . $product->image) : null;
            return $product;
        });

        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    /**
     * Mobile Checkout (Generates PayMongo GCash link directly)
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:gcash,paymongo'
        ]);

        $product = Product::findOrFail($request->product_id);
        $total = $product->price * $request->quantity;

        // Same robust integration for PayMongo GCash
        if ($request->payment_method === 'gcash') {
            try {
                $response = \Illuminate\Support\Facades\Http::withBasicAuth(env('PAYMONGO_SECRET_KEY', 'sk_test_w3bd'), '')
                    ->post('https://api.paymongo.com/v1/sources', [
                        'data' => [
                            'attributes' => [
                                'amount' => (int)($total * 100),
                                'currency' => 'PHP',
                                'type' => 'gcash',
                                'redirect' => [
                                    'success' => url('/api/payment/success'),
                                    'failed' => url('/api/payment/failed'),
                                ],
                            ]
                        ]
                    ]);
                    
                if ($response->successful()) {
                    $checkoutUrl = $response['data']['attributes']['redirect']['checkout_url'];
                    return response()->json([
                        'status' => 'success',
                        'checkout_url' => $checkoutUrl,
                        'message' => 'Please launch this URL in a WebView to complete GCash payment.'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Payment gateway failed.'], 500);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid payment gateway'], 400);
    }
}
