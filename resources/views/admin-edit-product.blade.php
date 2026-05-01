@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

        <div class="bg-white p-6 rounded-lg shadow">

            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-sm font-medium">Stock</label>
                        <input type="number" name="stock" value="{{ $product->stock }}"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium">Category</label>
                        <input type="text" name="category" value="{{ $product->category }}"
                            class="w-full border px-3 py-2 rounded-md">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea name="description"
                            class="w-full border px-3 py-2 rounded-md">{{ $product->description }}</textarea>
                    </div>

                    <!-- Current Image -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Current Image</label>

                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded border">
                        @else
                            <p class="text-gray-500 text-sm">No image uploaded</p>
                        @endif
                    </div>

                    <!-- Upload New Images -->
                    <div>
                        <label class="block text-sm font-medium">Add Gallery Images</label>
                        <input type="file" name="images[]" class="w-full border px-3 py-2 rounded-md" multiple>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between mt-6">

                        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 rounded-md">
                            Cancel
                        </a>

                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Update Product
                        </button>

                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection