<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Xác nhận đơn hàng</title>
</head>
<body style="font-family: sans-serif; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px;">
        <h2 style="color: #2d3748;">Cảm ơn bạn đã đặt hàng!</h2>
        <p>Chào **{{ $order->customer_name }}**,</p>
        <p>Đơn hàng của bạn đã được tiếp nhận thành công. Dưới đây là thông tin chi tiết:</p>
        
        <div style="background: #f7fafc; padding: 15px; border-radius: 5px;">
            <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
            <p><strong>Tổng thanh toán:</strong> {{ number_format($order->total_price) }} VNĐ</p>
            <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i') }}</p>
        </div>

        <p style="margin-top: 20px;">Chúng tôi sẽ sớm liên hệ với bạn để giao hàng.</p>
        <hr style="border: 0; border-top: 1px solid #eee;">
        <p style="font-size: 12px; color: #718096;">Đây là email tự động, vui lòng không phản hồi email này.</p>
    </div>
</body>
</html>