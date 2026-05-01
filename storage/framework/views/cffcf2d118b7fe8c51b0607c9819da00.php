

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Product Management</h1>

            <!-- Search -->
            <form method="GET" action="<?php echo e(route('admin.products.index')); ?>">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search product..."
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
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b">

                            <!-- Image -->
                            <td class="p-2">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-12 h-12 object-cover rounded">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 flex items-center justify-center text-xs">
                                        No Img
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td class="p-2"><?php echo e($product->name); ?></td>
                            <td class="p-2 text-center">₱<?php echo e(number_format($product->price, 2)); ?></td>
                            <td class="p-2 text-center"><?php echo e($product->stock); ?></td>

                            <!-- Actions -->
                            <td class="p-2 text-center space-x-2">

                                <!-- Edit -->
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>"
                                    class="text-blue-600 hover:underline text-sm">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit" onclick="return confirm('Delete this product?')"
                                        class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($products->links()); ?>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/admin-products.blade.php ENDPATH**/ ?>