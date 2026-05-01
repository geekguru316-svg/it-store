

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

    <?php if(empty($products)): ?>
        <div class="bg-white p-8 rounded-lg shadow-md text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13l-1.1 5M7 13h10m0 0v8a2 2 0 002 2h-8a2 2 0 01-2-2v-3"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-600 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-4">Add some products to get started!</p>
            <a href="<?php echo e(route('products.index')); ?>" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300">Browse Products</a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Cart Items</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($count = $quantities[$product->id] ?? 1); ?>
                        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                            <div class="flex items-center">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-16 h-16 object-cover rounded-md mr-4">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gray-200 rounded-md mr-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900"><?php echo e($product->name); ?></h3>
                                    <p class="text-gray-600"><?php echo e(Str::limit($product->description, 50)); ?></p>
                                    <p class="text-sm text-gray-500">Stock: <?php echo e($product->stock); ?> | Sold: <?php echo e($product->sold_count); ?></p>
                                </div>
                            </div>

                            <div class="flex flex-col items-end">
                                <span class="text-lg font-semibold text-indigo-600">₱<?php echo e(number_format($product->price * $count, 2)); ?></span>

                                <div class="mt-2 inline-flex items-center gap-2">
                                    <form action="<?php echo e(route('cart.update')); ?>" method="POST" class="flex items-center gap-2">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                        <input type="number" name="quantity" min="0" max="<?php echo e($product->stock); ?>" value="<?php echo e($count); ?>" class="w-16 px-2 py-1 border border-gray-300 rounded-md text-sm">
                                        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                                    </form>

                                    <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                        <input type="hidden" name="type" value="all">
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Remove</button>
                                    </form>
                                </div>

                                <p class="text-xs text-gray-500"><?php echo e($count); ?> unit(s)</p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">Total:</span>
                        <span class="text-2xl font-bold text-indigo-600">₱<?php echo e(number_format($total, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-between">
            <a href="<?php echo e(route('products.index')); ?>" class="w-full sm:w-auto bg-gray-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-gray-700 transition-all text-center shadow-lg active:scale-95">Continue Shopping</a>
            <a href="<?php echo e(route('checkout.index')); ?>" class="w-full sm:w-auto bg-green-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-green-700 transition-all text-center shadow-lg active:scale-95">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/cart.blade.php ENDPATH**/ ?>