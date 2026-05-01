<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="font-size: 30px; font-weight: 800; color: #1d4ed8; text-transform: uppercase; font-style: italic;">IT STORE</div>
            <div style="margin-top: 10px; font-size: 18px; color: #10b981; font-weight: 700;">Order Received!</div>
        </div>

        <div style="border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px;">
            <p style="margin: 0; color: #6b7280; font-size: 14px;">Hi <strong>{{ $order->customer_name }}</strong>,</p>
            <p style="margin: 10px 0 0; color: #1f2937; line-height: 1.5;">Thank you for your order! We've received your payment details and are currently processing your request. Your Order ID is: <strong style="color: #1d4ed8;">#{{ $order->id }}</strong></p>
        </div>

        <div style="background-color: #f9fafb; padding: 20px; border-radius: 15px; margin-bottom: 20px;">
            <div style="font-size: 12px; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">Order Summary</div>
            <table style="width: 100%; border-collapse: collapse;">
                @foreach(json_decode($order->items, true) as $item)
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                        <div style="font-weight: 700; color: #374151;">{{ $item['name'] }}</div>
                        <div style="font-size: 12px; color: #9ca3af;">Qty: {{ $item['quantity'] }}</div>
                    </td>
                    <td style="text-align: right; font-weight: 800; color: #111827; padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                        ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="padding: 20px 0 0; font-size: 16px; font-weight: 800; color: #374151;">TOTAL PAID</td>
                    <td style="padding: 20px 0 0; font-size: 24px; font-weight: 900; color: #1d4ed8; text-align: right;">₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <p style="color: #9ca3af; font-size: 12px; margin-bottom: 20px;">You can track your order status using your Order ID on our website.</p>
            <a href="{{ route('track-order', ['order_id' => $order->id]) }}" style="background-color: #1d4ed8; color: #ffffff; padding: 15px 30px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; text-transform: uppercase;">Track Your Order</a>
        </div>

        <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px; text-align: center; color: #9ca3af; font-size: 11px;">
            © {{ date('Y') }} IT Store. Thank you for shopping with us!
        </div>
    </div>
</body>
</html>