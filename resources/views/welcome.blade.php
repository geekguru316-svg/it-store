@extends('layouts.app')

@section('title', 'Welcome to IT Store')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-12 text-center mb-8">
        <h1 class="text-4xl font-bold mb-2">IT Store eCommerce System</h1>
        <p class="text-lg">Built with Laravel • Full Admin • Real Checkout System</p>
    </div>
    <div class="site-content">
        <!-- Sales Slider -->
        <div class="relative overflow-hidden rounded-3xl shadow-2xl mb-12 group">
            <div id="slider" class="flex transition-transform duration-1000 cubic-bezier(0.4, 0, 0.2, 1)">
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=1200"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span
                                class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Limited
                                Offer</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-red-600">PREMIUM TECH SALE
                            </h2>
                            <p class="text-gray-200 text-xl font-medium">Up to 40% OFF on high-end laptops</p>
                        </div>
                    </div>
                </div>
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1200"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span
                                class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">New
                                Arrival</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-blue-600">SERVER SOLUTIONS
                            </h2>
                            <p class="text-gray-200 text-xl font-medium">Advanced enterprise hardware is here</p>
                        </div>
                    </div>
                </div>
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1544244015-0cd4b3ff6f3c?auto=format&fit=crop&w=1200"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span
                                class="bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Accessories</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-emerald-600">GAMING
                                ESSENTIALS</h2>
                            <p class="text-gray-200 text-xl font-medium">Equip your setup for victory</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3">
                <div class="h-1.5 w-8 rounded-full bg-white/40 cursor-pointer transition-all hover:bg-white" id="dot-0">
                </div>
                <div class="h-1.5 w-8 rounded-full bg-white/20 cursor-pointer transition-all hover:bg-white" id="dot-1">
                </div>
                <div class="h-1.5 w-8 rounded-full bg-white/20 cursor-pointer transition-all hover:bg-white" id="dot-2">
                </div>
            </div>
        </div>

        <!-- Flash Sale Section -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-8 border-b-2 border-red-100 pb-4">
                <div class="flex items-center">
                    <span class="text-3xl mr-3 animate-pulse">🔥</span>
                    <h2 class="text-3xl font-black text-gray-900 italic uppercase">Flash Sale</h2>
                </div>
                <div
                    class="flex space-x-2 text-sm font-bold text-red-600 bg-red-50 px-4 py-2 rounded-full border border-red-200">
                    <span id="countdown">Ends in: 02:45:10</span>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($products->take(4) as $product)
                    <div
                        class="group relative bg-white p-5 rounded-2xl border-2 border-transparent hover:border-red-400 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-0"></a>
                        <div
                            class="absolute -top-3 -right-3 z-10 bg-red-600 text-white font-black px-4 py-2 rounded-xl text-sm shadow-lg rotate-12 group-hover:rotate-0 transition-transform pointer-events-none">
                            -20%
                        </div>

                        <div
                            class="h-48 w-full overflow-hidden rounded-xl mb-4 bg-gray-100 flex items-center justify-center relative z-10 pointer-events-none">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}"
                                    class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </div>

                        <div class="relative z-10">
                            <div class="flex text-yellow-400 text-sm mb-1">
                                ★★★★☆
                            </div>
                            <h3
                                class="text-sm font-bold text-gray-800 line-clamp-1 mb-2 group-hover:text-red-600 transition-colors">
                                {{ $product->name }}</h3>
                            <div class="flex justify-between items-baseline">
                                <p class="text-red-600 text-xl font-black italic">₱{{ number_format($product->price * 0.8, 2) }}
                                </p>
                                <p class="text-gray-400 text-xs line-through">₱{{ number_format($product->price, 2) }}</p>
                            </div>

                            <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500" style="width: 75%"></div>
                            </div>
                            <p class="text-[10px] text-gray-500 mt-1 font-bold mb-3">ALMOST SOLD OUT</p>

                            <div class="flex gap-2 relative z-20">
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" title="Add to Cart"
                                        class="w-full bg-white border-2 border-red-600 text-red-600 py-2 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-red-50 transition-colors shadow-sm flex items-center justify-center">
                                        🛒
                                    </button>
                                </form>
                                <a href="{{ route('checkout.index', ['id' => $product->id, 'quantity' => 1]) }}"
                                    class="flex-[2] bg-red-600 text-white py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-colors shadow-md flex items-center justify-center text-center">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            // Slider Logic
            let sliderIndex = 0;
            const slider = document.getElementById('slider');
            const dots = [document.getElementById('dot-0'), document.getElementById('dot-1'), document.getElementById('dot-2')];

            function updateSlider() {
                if (!slider) return;
                slider.style.transform = `translateX(-${sliderIndex * 100}%)`;
                dots.forEach((dot, i) => {
                    if (!dot) return;
                    dot.style.background = i === sliderIndex ? 'rgba(255, 255, 255, 1)' : 'rgba(255, 255, 255, 0.2)';
                });
            }

            setInterval(() => {
                sliderIndex = (sliderIndex + 1) % 3;
                updateSlider();
            }, 5000);

            // Simple Countdown
            let h = 2, m = 45, s = 10;
            setInterval(() => {
                const clock = document.getElementById('countdown');
                if (!clock) return;
                s--;
                if (s < 0) { s = 59; m--; }
                if (m < 0) { m = 59; h--; }
                clock.innerText = `Ends in: ${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            }, 1000);
        </script>

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <h1 class="text-3xl font-black text-gray-900 italic tracking-tighter">EXPLORE ALL PRODUCTS</h1>
        </div>

        <!-- Categories -->
        <div class="flex gap-3 mb-10 overflow-x-auto pb-4 no-scrollbar">
            <a href="{{ route('home') }}"
                class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600' }}">
                All Products
            </a>
            <a href="?category=Phones"
                class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == 'Phones' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600' }}">
                Phones
            </a>
            <a href="?category=Laptops"
                class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == 'Laptops' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600' }}">
                Laptops
            </a>
            <a href="?category=Accessories"
                class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == 'Accessories' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600' }}">
                Accessories
            </a>
        </div>

        <!-- Products Grid -->
        @if($products->count())
            <div class="cards">

                @foreach($products as $product)
                    <div
                        class="card group relative bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-0"></a>
                        <!-- Image & Link Wrapper -->
                        <div
                            class="relative z-10 h-48 bg-gray-50 flex items-center justify-center p-6 overflow-hidden pointer-events-none">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="h-full w-full flex items-center justify-center text-gray-400 font-bold italic tracking-tighter uppercase text-xs">
                                    No Image</div>
                            @endif
                        </div>

                        <!-- Info Section -->
                        <div class="p-6 relative z-10 flex flex-col h-full">
                            <div class="flex text-yellow-400 text-xs mb-2">
                                ★★★★☆
                            </div>
                            <a href="{{ route('products.show', $product->id) }}" class="block">
                                <h2
                                    class="text-sm font-black text-gray-900 group-hover:text-blue-600 transition-colors uppercase italic tracking-tighter leading-tight mb-2 truncate">
                                    {{ $product->name }}</h2>
                            </a>
                            <p class="text-[10px] text-gray-500 mb-4 line-clamp-2 leading-relaxed h-8">
                                {{ Str::limit($product->description, 60) }}</p>

                            <div class="mt-auto">
                                <div class="flex justify-between items-baseline mb-4">
                                    <p class="text-2xl font-black text-gray-900 italic tracking-tighter">
                                        ₱{{ number_format($product->price, 2) }}</p>
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">In Stock</span>
                                </div>

                                <div class="flex gap-2 relative z-20">
                                    <form action="{{ route('cart.add') }}" method="POST" class="flex-[2]">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="w-full bg-blue-600 text-white py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl active:scale-95 flex items-center justify-center">
                                            Add to Cart
                                        </button>
                                    </form>
                                    <a href="{{ route('checkout.index', ['id' => $product->id, 'quantity' => 1]) }}"
                                        class="flex-1 bg-gray-900 text-white py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl active:scale-95 flex items-center justify-center text-center">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="text-center py-20 text-gray-500 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                <p class="text-xl font-bold">No products found in this category.</p>
                <a href="{{ route('home') }}" class="text-blue-600 underline mt-2 inline-block">Back to all products</a>
            </div>
        @endif

    </div>

    <!-- FEATURE SHOWCASE SECTION -->
    <div class="max-w-7xl mx-auto py-16 px-4">
        <h2 class="text-2xl font-bold mb-8 text-center text-gray-900">System Features</h2>

        <div class="grid md:grid-cols-4 gap-6 text-center">

            <div class="bg-white p-6 shadow-md border hover:shadow-lg transition-shadow border-gray-100 rounded-xl">
                <div class="text-4xl mb-3">🛒</div>
                <p class="font-bold text-gray-800">Cart System</p>
            </div>

            <div class="bg-white p-6 shadow-md border hover:shadow-lg transition-shadow border-gray-100 rounded-xl">
                <div class="text-4xl mb-3">📦</div>
                <p class="font-bold text-gray-800">Order Management</p>
            </div>

            <div class="bg-white p-6 shadow-md border hover:shadow-lg transition-shadow border-gray-100 rounded-xl">
                <div class="text-4xl mb-3">📊</div>
                <p class="font-bold text-gray-800">Admin Dashboard</p>
            </div>

            <div class="bg-white p-6 shadow-md border hover:shadow-lg transition-shadow border-gray-100 rounded-xl">
                <div class="text-4xl mb-3">💳</div>
                <p class="font-bold text-gray-800">Checkout System</p>
            </div>

        </div>
    </div>

    <!-- ABOUT THE DEVELOPER SECTION -->
    <div class="bg-blue-50 py-16 text-center border-t border-b border-blue-100 mt-8">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-black italic tracking-tighter text-blue-900 mb-4">About the Developer</h2>

            <p class="mt-4 text-blue-800 text-lg leading-relaxed font-medium">
                Managed and developed by <strong class="bg-blue-600 text-white px-2 py-1 rounded-md mx-1 shadow-sm">Arjun Haincadto</strong>.<br>
                Passionate in building scalable web systems and professional business solutions.
            </p>
        </div>
    </div>
@endsection