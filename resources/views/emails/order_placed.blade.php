<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order, {{ $order->user->name }}!</h2>

    <p>Your order #{{ $order->id }} has been placed successfully.</p>

    <h3>Order Summary:</h3>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->product_name }} - ₹{{ number_format($item->product_price, 2) }} x {{ $item->quantity }}</li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>

    <p>Shipping Address: {{ $order->address }}</p>

    <p>We will notify you once your order is shipped.</p>

    <p>Best regards, <br> Your E-commerce Store</p>
</body>
</html>
