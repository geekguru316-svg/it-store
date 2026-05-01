<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'IT Store - Professional IT Products'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta-description', 'Discover premium IT products including laptops, routers, servers and more at our professional e-commerce platform.'); ?>">
    <meta name="robots" content="<?php echo $__env->yieldContent('meta-robots', 'index,follow'); ?>" />
    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>" />
    <link rel="alternate" href="<?php echo e(url()->current()); ?>" hreflang="en" />
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'IT Store - Professional IT Products'); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta-description', 'Discover premium IT products including laptops, routers, servers and more at our professional e-commerce platform.'); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php echo e(asset('images/og-default.jpg')); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', 'IT Store - Professional IT Products'); ?>" />
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta-description', 'Discover premium IT products including laptops, routers, servers and more at our professional e-commerce platform.'); ?>" />
    <meta name="twitter:image" content="<?php echo e(asset('images/og-default.jpg')); ?>" />

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "IT Store",
      "url": "<?php echo e(url('/')); ?>",
      "logo": "<?php echo e(asset('images/logo.png')); ?>",
      "sameAs": [
        "https://www.facebook.com/yourpage",
        "https://www.twitter.com/yourpage"
      ]
    }
    </script>

    <?php echo $__env->yieldPushContent('head'); ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        [x-cloak] { display: none !important; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', 'Segoe UI', Roboto, sans-serif; background: #f5f7fb; color: #1f2937; }
        a { color: #1d4ed8; text-decoration: none; }
        a:hover { text-decoration: underline; }
        header { background: #ffffff; border-bottom: 1px solid #e5e7eb; }
        .site-nav { max-width: 1120px; margin: 0 auto; padding: 1.25rem 1rem; display: flex; align-items: center; }
        .site-brand { font-size: 1.5rem; font-weight: 700; color: #1d4ed8; }
        .site-nav-links { display: flex; gap: 1.5rem; align-items: center; margin-left: 2rem; }
        .site-nav-links a { font-weight: 600; color: #4b5563; text-decoration: none !important; padding: 0.5rem 0; position: relative; transition: color 0.2s; }
        .site-nav-links a:hover { color: #2563eb; text-decoration: none !important; }
        .site-nav-links a.active { color: #2563eb; }
        .site-nav-links a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0%; height: 2px; background: #2563eb; transition: width 0.3s ease; }
        .site-nav-links a.active::after, .site-nav-links a:hover::after { width: 100%; }
        .toolbar { margin-left: auto; display: flex; align-items: center; gap: .75rem; }
        .toolbar a, .toolbar button { min-width: auto; }
        .toolbar .btn-primary { padding: .5rem .8rem; }
        .btn-primary { display: inline-block; background: #2563eb; color: #fff; padding: .55rem 1rem; border-radius: .5rem; font-weight: 600; border: 1px solid transparent; }
        .btn-primary:hover { background: #1d4ed8; }
        .site-content { max-width: 1120px; margin: 1.5rem auto; padding: 0 1rem; }
        .cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        @media (min-width: 768px) { .cards { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1024px) { .cards { grid-template-columns: repeat(4, 1fr); } }
        .card { background: #ffffff; border: 1px solid #e5e7eb; border-radius: .75rem; overflow: hidden; box-shadow: 0 8px 20px rgba(15,23,42,.08); display: flex; flex-direction: column; transition: transform .22s ease, box-shadow .22s ease; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 12px 26px rgba(15,23,42,.14); }
        .card img { width: 100%; height: 160px; object-fit: cover; display: block; }
        .card-body { padding: 1rem; display: flex; flex-direction: column; flex: 1; }
        .card-title { margin: 0 0 .35rem; font-size: 1.1rem; font-weight: 700; color: #111827; }
        .card-text { margin: 0 0 .9rem; color: #6b7280; font-size: .9rem; line-height: 1.4; }
        .card-price { color: #1d4ed8; font-size: 1.15rem; font-weight: 700; margin-top: auto;
        }
        .footer { padding: 2rem 1rem; background: #111827; color: #d1d5db; text-align: center; }
        .bg-blue-600 { background-color: #2563eb !important; }
        .bg-blue-50 { background-color: #eff6ff !important; }
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important; }
        .from-blue-600 { --tw-gradient-from: #2563eb !important; --tw-gradient-to: rgb(37 99 235 / 0) !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important; }
        .to-indigo-700 { --tw-gradient-to: #4338ca !important; }
    </style>
</head>
<body class="antialiased">
    <?php if(request()->routeIs('admin.*')): ?>
    <div class="flex h-screen bg-gray-100">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col">

            <!-- Logo -->
            <div class="p-6 text-2xl font-bold border-b border-gray-700">
                IT Admin
            </div>

            <!-- Menu -->
            <nav class="flex-1 mt-4 space-y-1">

                <a href="<?php echo e(route('admin.index')); ?>"
                class="flex items-center px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.index') ? 'bg-gray-800' : ''); ?>">
                    📊 <span class="ml-3">Dashboard</span>
                </a>

                <a href="<?php echo e(route('admin.products.index')); ?>"
                class="flex items-center px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.products.*') ? 'bg-gray-800' : ''); ?>">
                    📦 <span class="ml-3">Products</span>
                </a>

                <a href="<?php echo e(route('admin.orders.index')); ?>"
class="flex items-center px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-gray-800' : ''); ?>">
    🛒 <span class="ml-3">Orders</span>
</a>

                <a href="<?php echo e(route('admin.analytics')); ?>"
                class="flex items-center px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.analytics') ? 'bg-gray-800' : ''); ?>">
                    📊 <span class="ml-3">Analytics</span>
                </a>

                <a href="#"
                class="flex items-center px-6 py-3 hover:bg-gray-800">
                    👥 <span class="ml-3">Users</span>
                </a>

            </nav>

        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <!-- Topbar -->
            <div class="bg-white shadow px-6 py-4 flex justify-between items-center">

                <h1 class="text-lg font-semibold text-gray-800">
                    Admin Dashboard
                </h1>

            <div class="flex items-center space-x-4">

                <span class="text-gray-600 text-sm">
                    <?php echo e(Auth::user()->username); ?>

                </span>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600">
                        Logout
                    </button>
                </form>

            </div>
        </div>

            <main class="p-6 bg-gray-100 flex-1 overflow-y-auto">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

        </div>
    </div>
<?php else: ?>
    <header class="site-header">
        <div class="site-nav">
            <div>
                <a href="<?php echo e(route('products.index')); ?>" class="site-brand">IT Store</a>
            </div>
            <nav class="site-nav-links">
                <a href="<?php echo e(route('products.index')); ?>" class="<?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">Products</a>
                <a href="<?php echo e(route('categories.index')); ?>" class="<?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>">Categories</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </nav>
                <div class="toolbar" x-data>
                    <div class="hidden md:block">
                        <form action="<?php echo e(route('products.index')); ?>" method="GET" class="flex">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..." class="w-64 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition-colors">Search</button>
                        </form>
                    </div>
                    <button @click="$store.cart.toggle()" class="text-gray-700 hover:text-blue-600 relative focus:outline-none bg-transparent border-none p-0 cursor-pointer flex items-center justify-center">
                        <span class="text-2xl pointer-events-none">🛒</span>
                        <?php if(session('cart')): ?>
                            <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-white shadow-sm pointer-events-none"><?php echo e(count(session('cart', []))); ?></span>
                        <?php endif; ?>
                    </button>
                    <?php if(auth()->guard()->check()): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium"><?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?></div>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                                    <div class="font-medium"><?php echo e(Auth::user()->username); ?></div>
                                    <div class="text-gray-500"><?php echo e(Auth::user()->email ?? 'No email'); ?></div>
                                </div>
                                <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <?php if(Auth::user()->role == 'admin'): ?>
                                    <a href="<?php echo e(route('admin.index')); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Admin Panel</a>
                                <?php endif; ?>
                                <div class="border-t border-gray-200"></div>
                                <form action="<?php echo e(route('logout')); ?>" method="POST" class="block">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Login</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">Sign Up</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="md:hidden border-t border-gray-200" x-data="{ open: false }" x-show="open" x-transition>
                <nav class="px-2 pt-2 pb-3 space-y-1">
                    <a href="<?php echo e(route('products.index')); ?>" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Products</a>
                    <a href="<?php echo e(route('categories.index')); ?>" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Categories</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">About</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Contact</a>
                    <form action="<?php echo e(route('products.index')); ?>" method="GET" class="px-3 py-2">
                        <div class="flex">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..." class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Search</button>
                        </div>
                    </form>
                </nav>
            </div>
    </header>

    <main class="flex-1">
        <?php if(session('success')): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-xl shadow-lg border border-green-400 flex items-center justify-between transform transition-all duration-500 ease-out translate-y-0 opacity-100" id="success-alert">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-2 rounded-lg mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Order Received!</p>
                            <p class="text-green-50"><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('success-alert').remove()" class="text-white/80 hover:text-white hover:bg-white/10 p-2 rounded-lg transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.classList.add('opacity-0', '-translate-y-4');
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 5000);
            </script>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-red-500 text-white p-4 rounded-xl shadow-lg border border-red-400 flex items-center justify-between" id="error-alert">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-2 rounded-lg mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Oops!</p>
                            <p class="text-red-50"><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('error-alert').remove()" class="text-white/80 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-gray-900 text-gray-300 pt-10 pb-6 mt-10">

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- BRAND -->
        <div>
            <h2 class="text-white text-xl font-bold mb-3">IT Store</h2>
            <p class="text-sm">
                Your one-stop shop for gadgets, electronics, and accessories.
                Affordable. Reliable. Fast delivery.
            </p>
        </div>

        <!-- LINKS -->
        <div>
            <h3 class="text-white font-semibold mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="<?php echo e(route('home')); ?>" class="hover:text-white">Home</a></li>
                <li><a href="<?php echo e(route('products.index')); ?>" class="hover:text-white">Products</a></li>
                <li><a href="<?php echo e(route('categories.index')); ?>" class="hover:text-white">Categories</a></li>
                <li><a href="#" class="hover:text-white">Contact</a></li>
            </ul>
        </div>

        <!-- SUPPORT -->
        <div>
            <h3 class="text-white font-semibold mb-3">Support</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-white">FAQ</a></li>
                <li><a href="#" class="hover:text-white">Shipping</a></li>
                <li><a href="#" class="hover:text-white">Returns</a></li>
                <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- CONTACT -->
        <div>
            <h3 class="text-white font-semibold mb-3">Contact Us</h3>
            <p class="text-sm">📧 support@itstore.com</p>
            <p class="text-sm">📱 +63 912 345 6789</p>

            <!-- SOCIAL -->
            <div class="flex gap-3 mt-3 text-lg">
                <span>🌐</span>
                <span>📘</span>
                <span>📸</span>
                <span>🐦</span>
            </div>
        </div>

    </div>

    <!-- BOTTOM -->
    <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-400">
        © 2026 IT Store. All rights reserved.
        <br>
        <br>
        <!--<span class="text-gray-500">Managed by Arjun</span>-->
    </div>

</footer>
    <!-- Cart Drawer Infrastructure (Alpine.js Powered) -->
    <div x-data>
        <!-- Backdrop -->
        <div x-show="$store.cart.open" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="$store.cart.toggle()"
             class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9998]" x-cloak></div>

        <!-- Drawer -->
        <div x-show="$store.cart.open" 
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition-transform ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white shadow-2xl z-[9999] flex flex-col" x-cloak>
            
            <!-- Drawer Header -->
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center">
                    <span class="text-2xl mr-3 group-hover:scale-110 transition-transform">🛒</span>
                    <h2 class="text-2xl font-black text-gray-900 uppercase italic tracking-tighter">Your Bag</h2>
                </div>
                <button @click="$store.cart.toggle()" class="h-10 w-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors text-gray-400 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Items List -->
            <div class="flex-1 overflow-y-auto px-6 py-8 space-y-6">
                <?php
                    $cartIds = session('cart', []);
                    $cartDrawerProducts = !empty($cartIds) ? \App\Models\Product::whereIn('id', $cartIds)->get() : collect();
                    $cartDrawerCounts = array_count_values($cartIds);
                    $cartDrawerTotal = 0;
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $cartDrawerProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $qty = $cartDrawerCounts[$item->id] ?? 0;
                        $cartDrawerTotal += $item->price * $qty;
                    ?>
                    <div class="flex items-center gap-5 p-4 rounded-3xl border-2 border-gray-50 hover:border-blue-100 hover:bg-blue-50/20 transition-all group">
                        <div class="h-20 w-20 bg-white rounded-2xl border-2 border-gray-100 flex items-center justify-center shrink-0 shadow-sm">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/'.$item->image)); ?>" class="h-16 w-16 object-contain group-hover:scale-110 transition-transform">
                            <?php else: ?>
                                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">No Image</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 text-sm leading-tight mb-1"><?php echo e($item->name); ?></p>
                            <div class="flex justify-between items-end mt-2">
                                <span class="px-3 py-1 bg-gray-100 rounded-full text-[10px] font-black text-gray-500 uppercase tracking-widest"><?php echo e($qty); ?> Unit</span>
                                <span class="font-black text-blue-600">₱<?php echo e(number_format($item->price, 2)); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="h-full flex flex-col items-center justify-center opacity-30 text-center grayscale">
                        <span class="text-8xl mb-6">📦</span>
                        <p class="text-xl font-black uppercase italic tracking-tighter">Your bag is empty</p>
                        <p class="text-sm font-medium">Equip yourself with premium tech today.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Footer -->
            <?php if($cartDrawerProducts->count() > 0): ?>
                <div class="p-8 border-t bg-gray-50/50 space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Estimated Total</span>
                        <span class="text-3xl font-black text-blue-600 italic tracking-tighter">₱<?php echo e(number_format($cartDrawerTotal, 2)); ?></span>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <a href="<?php echo e(route('cart.index')); ?>" class="w-full bg-white border-2 border-gray-200 text-gray-900 font-bold py-4 rounded-2xl hover:bg-gray-50 transition-all text-center text-sm uppercase tracking-widest">
                            View Bag
                        </a>
                        <a href="<?php echo e(route('checkout.index')); ?>" class="w-full bg-gray-900 text-white font-black py-4 rounded-2xl shadow-xl shadow-gray-200 transition-all text-center uppercase tracking-widest text-sm hover:bg-blue-600">
                            Secure Checkout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Use custom event to pass server data to JS if needed
        window.openCartDrawer = <?php echo e(session('open_cart') ? 'true' : 'false'); ?>;
    </script>
<?php endif; ?>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/layouts/app.blade.php ENDPATH**/ ?>