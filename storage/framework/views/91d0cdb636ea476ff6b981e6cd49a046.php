<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <div class="site-content">
        <!-- Sales Slider -->
        <div class="relative overflow-hidden rounded-3xl shadow-2xl mb-12 group">
            <div id="slider" class="flex transition-transform duration-1000 cubic-bezier(0.4, 0, 0.2, 1)">
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=1200" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Limited Offer</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-red-600">PREMIUM TECH SALE</h2>
                            <p class="text-gray-200 text-xl font-medium">Up to 40% OFF on high-end laptops</p>
                        </div>
                    </div>
                </div>
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1200" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">New Arrival</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-blue-600">SERVER SOLUTIONS</h2>
                            <p class="text-gray-200 text-xl font-medium">Advanced enterprise hardware is here</p>
                        </div>
                    </div>
                </div>
                <div class="w-full shrink-0 relative h-[350px]">
                    <img src="https://images.unsplash.com/photo-1544244015-0cd4b3ff6f3c?auto=format&fit=crop&w=1200" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center p-12">
                        <div>
                            <span class="bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Accessories</span>
                            <h2 class="text-4xl font-black text-white mb-2 underline decoration-emerald-600">GAMING ESSENTIALS</h2>
                            <p class="text-gray-200 text-xl font-medium">Equip your setup for victory</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3">
                <div class="h-1.5 w-8 rounded-full bg-white/40 cursor-pointer transition-all hover:bg-white" id="dot-0"></div>
                <div class="h-1.5 w-8 rounded-full bg-white/20 cursor-pointer transition-all hover:bg-white" id="dot-1"></div>
                <div class="h-1.5 w-8 rounded-full bg-white/20 cursor-pointer transition-all hover:bg-white" id="dot-2"></div>
            </div>
        </div>

        <!-- Flash Sale Section -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-8 border-b-2 border-red-100 pb-4">
                <div class="flex items-center">
                    <span class="text-3xl mr-3 animate-pulse">🔥</span>
                    <h2 class="text-3xl font-black text-gray-900 italic uppercase">Flash Sale</h2>
                </div>
                <div class="flex space-x-2 text-sm font-bold text-red-600 bg-red-50 px-4 py-2 rounded-full border border-red-200">
                    <span id="countdown">Ends in: 02:45:10</span>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php $__currentLoopData = $products->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-white p-5 rounded-2xl border-2 border-transparent hover:border-red-400 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <a href="<?php echo e(route('products.show', $product->id)); ?>" class="absolute inset-0 z-0"></a>
                    <div class="absolute -top-3 -right-3 z-10 bg-red-600 text-white font-black px-4 py-2 rounded-xl text-sm shadow-lg rotate-12 group-hover:rotate-0 transition-transform pointer-events-none">
                        -20%
                    </div>
                    
                    <div class="h-48 w-full overflow-hidden rounded-xl mb-4 bg-gray-100 flex items-center justify-center relative z-10 pointer-events-none">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/'.$product->image)); ?>" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                        <?php else: ?>
                            <span class="text-gray-400">No Image</span>
                        <?php endif; ?>
                    </div>

                    <div class="relative z-10">
                        <div class="flex text-yellow-400 text-sm mb-1">
                            ★★★★☆
                        </div>
                        <h3 class="text-sm font-bold text-gray-800 line-clamp-1 mb-2 group-hover:text-red-600 transition-colors"><?php echo e($product->name); ?></h3>
                        <div class="flex justify-between items-baseline">
                            <p class="text-red-600 text-xl font-black italic">₱<?php echo e(number_format($product->price * 0.8, 2)); ?></p>
                            <p class="text-gray-400 text-xs line-through">₱<?php echo e(number_format($product->price, 2)); ?></p>
                        </div>
                        
                        <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-red-500" style="width: 75%"></div>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-1 font-bold mb-3">ALMOST SOLD OUT</p>

                        <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="relative z-20">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button class="w-full bg-red-600 text-white py-2 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-red-700 transition-colors shadow-md">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <script>
            // Slider Logic
            let sliderIndex = 0;
            const slider = document.getElementById('slider');
            const dots = [document.getElementById('dot-0'), document.getElementById('dot-1'), document.getElementById('dot-2')];
            
            function updateSlider() {
                slider.style.transform = `translateX(-${sliderIndex * 100}%)`;
                dots.forEach((dot, i) => {
                    dot.style.background = i === sliderIndex ? 'rgba(255, 255, 255, 1)' : 'rgba(255, 255, 255, 0.2)';
                    dot.style.width = i === sliderIndex ? '32px' : '32px';
                });
            }

            setInterval(() => {
                sliderIndex = (sliderIndex + 1) % 3;
                updateSlider();
            }, 5000);

            // Simple Countdown
            let h = 2, m = 45, s = 10;
            setInterval(() => {
                s--;
                if(s < 0) { s = 59; m--; }
                if(m < 0) { m = 59; h--; }
                document.getElementById('countdown').innerText = `Ends in: ${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            }, 1000);
        </script>

        <!-- Page Header -->
        <div
            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.75rem;">
            <h1 style="margin:0; font-size:2rem; font-weight:700;">Discover Products</h1>

            <!-- Search -->
            <!--<form method="GET" action="<?php echo e(route('products.index')); ?>" style="display:flex; gap:0;">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..."
                        style="border:1px solid #d1d5db; padding:.55rem .75rem; border-right:none; border-radius:.5rem 0 0 .5rem; min-width:220px;">
                    <button class="btn-primary" style="border-radius:0 .5rem .5rem 0; border:1px solid #2563eb;">
                        Search
                    </button>
                </form>-->
        </div>

        <!-- Categories -->
        <div class="flex gap-3 mb-10 overflow-x-auto pb-4 no-scrollbar">
            <a href="<?php echo e(route('products.index')); ?>" 
               class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 <?php echo e(!request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600'); ?>">
                All Products
            </a>
            <a href="?category=Phones" 
               class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 <?php echo e(request('category') == 'Phones' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600'); ?>">
                Phones
            </a>
            <a href="?category=Laptops" 
               class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 <?php echo e(request('category') == 'Laptops' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600'); ?>">
                Laptops
            </a>
            <a href="?category=Accessories" 
               class="px-6 py-2 rounded-full font-bold text-sm transition-all duration-300 <?php echo e(request('category') == 'Accessories' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white border-2 border-gray-100 text-gray-500 hover:border-blue-500 hover:text-blue-600'); ?>">
                Accessories
            </a>
        </div>

        <!-- Products Grid -->
        <?php if($products->count()): ?>
            <div class="cards">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card group relative bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <!-- Image & Link Wrapper -->
                        <div class="relative h-48 bg-gray-50 flex items-center justify-center p-6 overflow-hidden">
                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="block">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="h-full w-full flex items-center justify-center text-gray-400 font-bold italic tracking-tighter uppercase text-xs">No Image</div>
                                <?php endif; ?>
                            </a>
                        </div>
 
                        <!-- Info Section -->
                        <div class="p-6 relative z-10 flex flex-col h-full">
                            <div class="flex text-yellow-400 text-xs mb-2">
                                ★★★★☆
                            </div>
                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="block">
                                <h2 class="text-sm font-black text-gray-900 group-hover:text-blue-600 transition-colors uppercase italic tracking-tighter leading-tight mb-2 truncate"><?php echo e($product->name); ?></h2>
                            </a>
                            <p class="text-[10px] text-gray-500 mb-4 line-clamp-2 leading-relaxed h-8"><?php echo e(Str::limit($product->description, 60)); ?></p>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between items-baseline mb-4">
                                    <p class="text-2xl font-black text-gray-900 italic tracking-tighter">₱<?php echo e(number_format($product->price, 2)); ?></p>
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">In Stock</span>
                                </div>
 
                                <div class="flex gap-2 relative z-20">
                                    <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="flex-[2]">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-blue-600 text-white py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl active:scale-95 flex items-center justify-center">
                                            Add to Cart
                                        </button>
                                    </form>
                                    <a href="<?php echo e(route('checkout.index', ['id' => $product->id, 'quantity' => 1])); ?>" class="flex-1 bg-gray-900 text-white py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl active:scale-95 flex items-center justify-center text-center">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <?php echo e($products->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-10 text-gray-500">
                No products found.
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\My Project\it-store-main\resources\views/products/index.blade.php ENDPATH**/ ?>