<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Advanced Analytics</h1>
    <p class="text-gray-600">Track your store's performance metrics and revenue.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Revenue</p>
            <p class="text-3xl font-black text-gray-900">₱<?php echo e(number_format($totalRevenue, 2)); ?></p>
        </div>
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Orders</p>
            <p class="text-3xl font-black text-gray-900"><?php echo e($totalOrders); ?></p>
        </div>
        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Products</p>
            <p class="text-3xl font-black text-gray-900"><?php echo e($totalProducts); ?></p>
        </div>
        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-900 mb-6">Revenue Overview (Last 7 Days)</h2>
        <div class="relative h-80">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-900 mb-6">Recent Transactions</h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <p class="font-bold text-gray-900 text-sm"><?php echo e($order->customer_name); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e($order->created_at->diffForHumans()); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-blue-600">₱<?php echo e(number_format($order->total, 2)); ?></p>
                        <span class="text-[10px] uppercase font-bold <?php echo e($order->status === 'completed' ? 'text-green-600' : 'text-yellow-600'); ?>"><?php echo e($order->status); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Gradient for chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');   
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Daily Revenue (₱)',
                    data: <?php echo json_encode($revenueData); ?>,
                    borderColor: '#2563eb', // blue-600
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        titleFont: { size: 13, family: 'Inter' },
                        bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '₱ ' + context.parsed.y.toLocaleString(undefined, {minimumFractionDigits: 2});
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        border: { display: false },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#6b7280',
                            callback: function(value) {
                                return '₱ ' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { family: 'Inter', size: 11 }, color: '#6b7280' }
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/admin-analytics.blade.php ENDPATH**/ ?>