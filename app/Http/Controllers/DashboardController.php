<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Optimize: Use caching for stats to reduce database queries
        $stats = Cache::remember('dashboard_stats', 60, function () {
            return [
                'total_products' => Product::count(),
                'total_orders' => Order::count(),
                'cart_items' => count(session('cart', [])),
            ];
        });

        $orders = auth()->user()->orders()->latest()->get();

        return view('dashboard', compact('stats', 'orders'));
    }
}
