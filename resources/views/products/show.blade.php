@extends('layouts.app')

@section('title', $product->name . ' - IT Store')
@section('meta-description', Str::limit($product->description, 160))

@section('content')

    @push('head')
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@@type": "ListItem",
                    "position": 2,
                    "name": "Products",
                    "item": "{{ route('products.index') }}"
                }
                @if($product->category)
                ,
                {
                    "@@type": "ListItem",
                    "position": 3,
                    "name": "{{ $product->category }}",
                    "item": "{{ route('products.category', ['category' => $product->category]) }}"
                },
                {
                    "@@type": "ListItem",
                    "position": 4,
                    "name": "{{ $product->name }}",
                    "item": "{{ route('products.show', $product) }}"
                }
                @else
                ,
                {
                    "@@type": "ListItem",
                    "position": 3,
                    "name": "{{ $product->name }}",
                    "item": "{{ route('products.show', $product) }}"
                }
                @endif
            ]
        }
        </script>
    @endpush

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- IMAGE GALLERY -->
            <div>
                <!-- Main Image -->
                <div class="border p-4 rounded-lg bg-white mb-4 shadow-sm">
                    <img id="mainImage"
                        src="{{ asset($product->images->first()->image ?? $product->image) }}"
                        class="w-full h-[450px] object-contain transition-all duration-300">
                </div>

                <!-- Thumbnails -->
                <div class="flex gap-2 overflow-x-auto pb-2">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" 
                             class="w-20 h-20 object-cover border-2 border-blue-500 rounded cursor-pointer hover:border-blue-400"
                             onclick="changeImage(this)">
                    @endif
                    @foreach($product->images as $img)
                        <img src="{{ asset($img->image) }}" 
                             class="w-20 h-20 object-cover border-2 border-transparent rounded cursor-pointer hover:border-blue-400 transition-colors"
                             onclick="changeImage(this)">
                    @endforeach
                </div>
            </div>

            <script>
                function changeImage(el) {
                    document.getElementById('mainImage').src = el.src;
                    // Update borders
                    document.querySelectorAll('.flex.gap-2 img').forEach(img => img.classList.remove('border-blue-500'));
                    document.querySelectorAll('.flex.gap-2 img').forEach(img => img.classList.add('border-transparent'));
                    el.classList.remove('border-transparent');
                    el.classList.add('border-blue-500');
                }
            </script>

            <!-- PRODUCT DETAILS -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">
                        {{ $product->name }}
                    </h1>
                    <p class="text-sm text-gray-500">
                        {{ $product->sold_count }} units sold
                    </p>
                </div>

                <div class="bg-red-50 p-6 rounded-xl border border-red-100">
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-red-600">
                            ₱{{ number_format($product->price, 2) }}
                        </span>
                        <span class="text-sm text-red-400 line-through">₱{{ number_format($product->price * 1.2, 2) }}</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $product->description }}
                    </p>
                    <div class="flex items-center gap-2">
                        @if($product->stock > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ✔ {{ $product->stock }} in stock
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                ✖ Out of Stock
                            </span>
                        @endif
                    </div>
                </div>

                <!-- ADD TO CART / BUY NOW -->
                <div class="pt-6 border-t border-gray-100">
                    <div class="flex items-center gap-6 mb-6">
                        <span class="text-sm font-semibold text-gray-700">Quantity</span>
                        <div class="flex items-center border-2 border-gray-200 rounded-lg overflow-hidden bg-white">
                            <button type="button" onclick="decreaseQty()" class="px-4 py-2 hover:bg-gray-50 transition-colors font-bold text-gray-600">-</button>
                            <input id="qty" type="number" name="quantity" value="1" min="1" class="w-16 text-center border-none focus:ring-0 font-bold text-gray-800" readonly>
                            <button type="button" onclick="increaseQty()" class="px-4 py-2 hover:bg-gray-50 transition-colors font-bold text-gray-600">+</button>
                        </div>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="hiddenQty" value="1">
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" 
                                class="flex-1 px-8 py-4 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition-all active:transform active:scale-95 flex items-center justify-center">
                                Add to Cart
                            </button>
                            <button type="button" onclick="buyNow()"
                                class="flex-1 px-8 py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-blue-600 transition-all shadow-lg shadow-gray-200 active:transform active:scale-95">
                                Buy Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function buyNow() {
                const id = "{{ $product->id }}";
                const qty = document.getElementById('qty').value;
                window.location.href = "{{ route('checkout.index') }}?id=" + id + "&quantity=" + qty;
            }

            function increaseQty() {
                const qtyInput = document.getElementById('qty');
                const hiddenInput = document.getElementById('hiddenQty');
                qtyInput.value = parseInt(qtyInput.value) + 1;
                hiddenInput.value = qtyInput.value;
            }

            function decreaseQty() {
                const qtyInput = document.getElementById('qty');
                const hiddenInput = document.getElementById('hiddenQty');
                if (parseInt(qtyInput.value) > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                    hiddenInput.value = qtyInput.value;
                }
            }
        </script>

        <!-- RELATED PRODUCTS -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20 pt-10 border-t border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">You May Also Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related) }}" class="group">
                            <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="aspect-square rounded-xl overflow-hidden mb-4 bg-gray-50">
                                    <img src="{{ $related->image ? asset($related->image) : asset('images/default.png') }}" 
                                         class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <h3 class="font-bold text-gray-800 text-sm mb-1 line-clamp-1 group-hover:text-red-600 transition-colors">
                                    {{ $related->name }}
                                </h3>
                                <p class="text-red-600 font-extrabold">₱{{ number_format($related->price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- CUSTOMER REVIEWS -->
        <div class="mt-20 pt-10 border-t border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Review Summary/Form -->
                <div class="lg:col-span-1">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 uppercase italic">Customer Reviews</h2>
                    
                    <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 shadow-inner">
                        <h3 class="font-bold text-gray-800 mb-4">Write a Review</h3>
                        <form method="POST" action="{{ route('reviews.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Your Name</label>
                                <input type="text" name="name" placeholder="Glenda Agnes" 
                                       class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-medium" required>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Rating</label>
                                <select name="rating" class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-bold text-yellow-500">
                                    <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                                    <option value="3">⭐⭐⭐ (3 Stars)</option>
                                    <option value="2">⭐⭐ (2 Stars)</option>
                                    <option value="1">⭐ (1 Star)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Comment</label>
                                <textarea name="comment" rows="4" placeholder="What did you think of the product?" 
                                          class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-medium" required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-xl uppercase tracking-widest text-sm hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                                Submit Review
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="lg:col-span-2">
                    <div class="space-y-6">
                        @forelse($product->reviews()->latest()->get() as $review)
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <div class="flex text-yellow-400 text-sm mb-1">
                                            @for($i = 0; $i < 5; $i++)
                                                {{ $i < $review->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <p class="font-black text-gray-900 italic uppercase text-sm">{{ $review->name }}</p>
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 leading-relaxed font-medium">
                                    "{{ $review->comment }}"
                                </p>
                            </div>
                        @empty
                            <div class="h-full flex flex-col items-center justify-center p-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 text-center">
                                <span class="text-4xl mb-3">💬</span>
                                <p class="font-bold text-gray-500">No reviews yet.</p>
                                <p class="text-xs text-gray-400">Be the first to share your thoughts!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
        <!-- STICKY MOBILE BUY BAR (Shopee Style) -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 p-4 flex gap-3 md:hidden z-[9997] shadow-[0_-10px_20px_rgba(0,0,0,0.05)] animate-slide-up">
            <button onclick="document.querySelector('form[action$=\'cart.add\']').submit()" 
                class="flex-1 border-2 border-red-600 text-red-600 font-black py-4 rounded-xl uppercase tracking-widest text-xs active:scale-95 transition-all">
                Add to Cart
            </button>
            <button onclick="buyNow()" 
                class="flex-1 bg-red-600 text-white font-black py-4 rounded-xl shadow-lg shadow-red-200 uppercase tracking-widest text-xs active:scale-95 transition-all">
                Buy Now
            </button>
        </div>

        <style>
            @keyframes slide-up { from { transform: translateY(100%); } to { transform: translateY(0); } }
            .animate-slide-up { animation: slide-up 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
            /* Add padding to body to prevent content being hidden by sticky bar */
            @media (max-width: 767px) {
                body { padding-bottom: 80px; }
            }
        </style>
    </div>
@endsection