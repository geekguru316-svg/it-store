<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #<?php echo e($order->id); ?></title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; background: #fff; margin: 0; padding: 0; color: #333; line-height: 1.6; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; }
        
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #111; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 32px; font-weight: 900; color: #1d4ed8; text-transform: uppercase; font-style: italic; }
        .invoice-title { font-size: 24px; font-weight: 700; color: #999; text-transform: uppercase; text-align: right; }
        
        .info-grid { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .info-grid td { vertical-align: top; width: 50%; }
        .label { font-size: 10px; font-weight: 800; color: #999; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .val { font-size: 16px; font-weight: 700; color: #111; }
        .subval { font-size: 12px; color: #666; font-style: italic; }

        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .items-table th { background: #f9fafb; color: #9ca3af; font-size: 10px; font-weight: 800; text-transform: uppercase; text-align: left; padding: 15px 10px; border-bottom: 1px solid #eee; border-top: 1px solid #eee; }
        .items-table td { padding: 15px 10px; border-bottom: 1px solid #f9fafb; font-size: 13px; }
        .items-table .item-name { font-weight: 700; color: #111; text-transform: uppercase; }
        .items-table .item-qty { text-align: center; font-weight: 800; color: #666; background: #f1f5f9; padding: 4px 8px; border-radius: 4px; }
        .items-table .item-price { text-align: right; font-weight: 800; color: #111; }

        .totals-section { width: 100%; }
        .totals-section td { text-align: right; }
        .total-row { border-top: 3px solid #111; padding-top: 10px; margin-top: 10px; }
        .total-lbl { font-size: 12px; font-weight: 800; color: #111; text-transform: uppercase; }
        .total-val { font-size: 28px; font-weight: 900; color: #1d4ed8; font-style: italic; }

        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #999; font-style: italic; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <table style="width: 100%; margin-bottom: 30px;">
            <tr>
                <td class="logo">IT STORE</td>
                <td class="invoice-title">
                    Invoice<br>
                    <span style="font-size: 14px; color: #1d4ed8; font-weight: normal; font-family: monospace;">#<?php echo e($order->id); ?></span>
                </td>
            </tr>
        </table>

        <!-- Billing & Order Info -->
        <table class="info-grid">
            <tr>
                <td>
                    <div class="label">Bill To:</div>
                    <div class="val"><?php echo e($order->customer_name); ?></div>
                    <div class="subval"><?php echo e($order->customer_email); ?></div>
                </td>
                <td style="text-align: right;">
                    <div class="label">Date Issued:</div>
                    <div class="val" style="font-size: 14px;"><?php echo e($order->created_at->format('M d, Y')); ?></div>
                    <div class="label" style="margin-top: 10px;">Status:</div>
                    <div class="val" style="color: #1d4ed8; font-style: italic; text-transform: uppercase; font-size: 14px;"><?php echo e($order->status); ?></div>
                </td>
            </tr>
        </table>

        <!-- Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = json_decode($order->items, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="item-name"><?php echo e($item['name']); ?></div>
                        <div style="font-size: 10px; color: #9ca3af; font-weight: normal;">SKU-<?php echo e(substr(md5($item['name']), 0, 8)); ?></div>
                    </td>
                    <td style="text-align: center;">
                        <span class="item-qty">x<?php echo e($item['quantity']); ?></span>
                    </td>
                    <td class="item-price">
                        ₱<?php echo e(number_format($item['price'] * $item['quantity'], 2)); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Totals -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: right;">
                    <span style="font-size: 10px; font-weight: 800; color: #9ca3af; text-transform: uppercase;">Subtotal:</span>
                    <span style="font-weight: 700; color: #111; margin-left: 10px;">₱<?php echo e(number_format($order->total, 2)); ?></span>
                    <br>
                    <span style="font-size: 10px; font-weight: 800; color: #1d4ed8; text-transform: uppercase; font-style: italic;">Shipping:</span>
                    <span style="font-weight: 700; color: #1d4ed8; margin-left: 10px; font-style: italic;">FREE</span>
                    
                    <div class="total-row">
                        <span class="total-lbl">Grand Total:</span><br>
                        <span class="total-val">₱<?php echo e(number_format($order->total, 2)); ?></span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer">
            Thank you for shopping at IT Store PH. This document is a system-generated official invoice.
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Glenda Agnes\product-site\resources\views/invoice.blade.php ENDPATH**/ ?>