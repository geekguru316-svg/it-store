<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->category) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(12);

        $categories = Product::select('category')
            ->distinct()
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|in:' . implode(',', Product::categories()),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function category(Request $request, string $category)
    {
        if (!in_array($category, Product::categories())) {
            abort(404);
        }

        $request->merge(['category' => $category]);
        return $this->index($request);
    }

    public function categories()
    {
        $categories = Product::select('category as name', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->get();
            
        return view('categories', compact('categories'));
    }

    public function sitemapIndex()
    {
        return response()->view('sitemap-index', [], 200)
            ->header('Content-Type', 'application/xml');
    }

    public function sitemap()
    {
        $products = Product::all();
        $categories = Product::categories();

        return response()->view('sitemap', compact('products', 'categories'), 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function home(Request $request)
    {
        $query = Product::query();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->get();
        
        $categories = Product::select('category')
            ->distinct()
            ->get();

        return view('welcome', compact('products', 'categories'));
    }
}
