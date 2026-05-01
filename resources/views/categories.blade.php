@extends('layouts.app')

@section('title', 'Categories - IT Store')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-4">Shop by Category</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Browse our complete collection of premium tech, organized carefully to help you find exactly what you need.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($categories as $category)
            <a href="{{ route('products.category', $category->name) }}" class="group block bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2 capitalize">{{ $category->name }}</h2>
                        <p class="text-sm font-black text-blue-600 uppercase tracking-widest">{{ $category->count }} Products</p>
                    </div>
                    <div class="h-12 w-12 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
