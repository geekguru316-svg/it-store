<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\ProductImage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin-orders', compact('orders'));
    }

    public function analytics()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        // Advanced Analytics Aggregation
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $recentOrders = Order::latest()->take(5)->get();

        // Data for charts (Last 7 days revenue)
        $revenueData = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('M d');
            $revenueData[] = Order::where('status', '!=', 'cancelled')
                                  ->whereDate('created_at', $date)
                                  ->sum('total');
        }

        return view('admin-analytics', compact(
            'totalRevenue', 'totalOrders', 'totalProducts', 'recentOrders', 'labels', 'revenueData'
        ));
    }

    public function index()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        // Optimize: Use pagination and latest ordering
        $products = Product::latest()->paginate(10);
        return view('admin', compact('products'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'nullable|string|in:' . implode(',', Product::categories()),
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Optimize: Use faster storage method
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description ?? '',
            'category' => $request->category,
            'stock' => $request->stock,
            'sold_count' => 0,
            'image' => $imagePath,
        ]);

        // Handle additional gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        // Clear dashboard cache to update stats
        Cache::forget('dashboard_stats');

        return redirect()->route('admin.index')->with('success', 'Product added successfully');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $product = Product::findOrFail($id);

        // Delete the image file if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        // Clear dashboard cache to update stats
        Cache::forget('dashboard_stats');

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
    public function products(Request $request)
    {
        $query = \App\Models\Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('admin-products', compact('products'));
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin-edit-product', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        // Remove image from data if not uploaded, to avoid nulling existing image
        unset($data['image']);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::delete('public/' . $product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Handle additional gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);

        $order->update($request->only(['status', 'shipping_status', 'tracking_number']));

        return back()->with('success', 'Order status updated!');
    }

    public function invoice($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        $pdf = Pdf::loadView('invoice', compact('order'));

        return $pdf->download('invoice-'.$order->id.'.pdf');
    }
}
