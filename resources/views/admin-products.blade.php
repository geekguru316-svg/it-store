@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Product Management</h1>

            <!-- Search -->
            <form method="GET" action="{{ route('admin.products.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="border px-3 py-2 rounded-md text-sm">
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <table class="w-full">
                <thead>
                    <tr class="border-b text-left">
                        <th class="p-2">Image</th>
                        <th class="p-2">Name</th>
                        <th class="p-2 text-center">Price</th>
                        <th class="p-2 text-center">Stock</th>
                        <th class="p-2 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b">

                            <!-- Image -->
                            <td class="p-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 flex items-center justify-center text-xs">
                                        No Img
                                    </div>
                                @endif
                            </td>

                            <td class="p-2">{{ $product->name }}</td>
                            <td class="p-2 text-center">₱{{ number_format($product->price, 2) }}</td>
                            <td class="p-2 text-center">{{ $product->stock }}</td>

                            <!-- Actions -->
                            <td class="p-2 text-center space-x-2">

                                <!-- Edit -->
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-blue-600 hover:underline text-sm">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Delete this product?')"
                                        class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>
@endsection