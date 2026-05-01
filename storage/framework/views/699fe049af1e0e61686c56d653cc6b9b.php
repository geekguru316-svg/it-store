

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">Orders</h1>

        <div class="bg-white p-6 rounded-lg shadow">

            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="p-2 text-left">Customer</th>
                        <th class="p-2">Total</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Status</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Shipping</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Payment</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Date</th>
                        <th class="p-2 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b">
                            <td class="p-2"><?php echo e($order->customer_name); ?></td>
                            <td class="p-2 text-center">₱<?php echo e(number_format($order->total, 2)); ?></td>
                            <td class="p-2 text-center">

                                <form method="POST" action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded text-sm
                        <?php if($order->status == 'pending'): ?> bg-yellow-100 text-yellow-700
                        <?php elseif($order->status == 'completed'): ?> bg-green-100 text-green-700
                        <?php elseif($order->status == 'cancelled'): ?> bg-red-100 text-red-700
                        <?php endif; ?>">

                                        <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Completed</option>
                                        <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>

                                    </select>
                                </form>

                            </td>
                            <td class="p-2 text-center">

                                <form method="POST" action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" class="flex flex-col items-center gap-1">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <select name="shipping_status" onchange="this.form.submit()" class="px-2 py-1 rounded text-sm w-full
                        <?php if($order->shipping_status == 'processing'): ?> bg-yellow-100 text-yellow-700
                        <?php elseif($order->shipping_status == 'shipped'): ?> bg-blue-100 text-blue-700
                        <?php elseif($order->shipping_status == 'out_for_delivery'): ?> bg-indigo-100 text-indigo-700
                        <?php elseif($order->shipping_status == 'delivered'): ?> bg-green-100 text-green-700
                        <?php endif; ?>">

                                        <option value="processing" <?php echo e($order->shipping_status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                                        <option value="shipped" <?php echo e($order->shipping_status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                                        <option value="out_for_delivery" <?php echo e($order->shipping_status == 'out_for_delivery' ? 'selected' : ''); ?>>Out for Delivery</option>
                                        <option value="delivered" <?php echo e($order->shipping_status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>

                                    </select>
                                    
                                    <div class="flex w-full min-w-max">
                                        <input type="text" name="tracking_number" value="<?php echo e($order->tracking_number); ?>" placeholder="Tracking #" class="px-2 py-1 w-24 text-[10px] font-bold border border-gray-200 rounded-l focus:ring-0 focus:border-blue-500">
                                        <button type="submit" title="Save Tracking" class="px-2 py-1 bg-gray-100 border-y border-r border-gray-200 rounded-r text-[10px] font-black text-gray-500 hover:bg-white hover:text-blue-600 transition-colors">
                                            ✓
                                        </button>
                                    </div>
                                </form>

                            </td>
                            <td class="p-2 text-center">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider <?php echo e($order->payment_method == 'gcash' ? 'bg-blue-100 text-blue-700' : 'bg-indigo-100 text-indigo-700'); ?>">
                                    <?php echo e($order->payment_method ?? 'N/A'); ?>

                                </span>
                            </td>
                            <td class="p-2 text-center text-xs font-bold text-gray-500 italic"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                            <td class="p-2 text-center">
                                <a href="<?php echo e(route('invoice', $order->id)); ?>" class="text-[10px] font-black uppercase text-blue-600 hover:text-gray-900 underline decoration-blue-500 decoration-2 transition-all">
                                    Invoice
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="mt-4">
                <?php echo e($orders->links()); ?>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/admin-orders.blade.php ENDPATH**/ ?>