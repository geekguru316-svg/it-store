<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

        <div class="bg-white p-6 rounded-lg shadow">

            <form method="POST" action="<?php echo e(route('admin.products.update', $product)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium">Product Name</label>
                        <input type="text" name="name" value="<?php echo e($product->name); ?>"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium">Price</label>
                        <input type="number" step="0.01" name="price" value="<?php echo e($product->price); ?>"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-sm font-medium">Stock</label>
                        <input type="number" name="stock" value="<?php echo e($product->stock); ?>"
                            class="w-full border px-3 py-2 rounded-md" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium">Category</label>
                        <input type="text" name="category" value="<?php echo e($product->category); ?>"
                            class="w-full border px-3 py-2 rounded-md">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea name="description"
                            class="w-full border px-3 py-2 rounded-md"><?php echo e($product->description); ?></textarea>
                    </div>

                    <!-- Current Image -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Current Image</label>

                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-32 h-32 object-cover rounded border">
                        <?php else: ?>
                            <p class="text-gray-500 text-sm">No image uploaded</p>
                        <?php endif; ?>
                    </div>

                    <!-- Upload New Images -->
                    <div>
                        <label class="block text-sm font-medium">Add Gallery Images</label>
                        <input type="file" name="images[]" class="w-full border px-3 py-2 rounded-md" multiple>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between mt-6">

                        <a href="<?php echo e(route('admin.products.index')); ?>" class="px-4 py-2 bg-gray-300 rounded-md">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\My Project\it-store-main\resources\views/admin-edit-product.blade.php ENDPATH**/ ?>