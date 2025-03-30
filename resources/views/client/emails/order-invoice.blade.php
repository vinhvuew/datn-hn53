<!DOCTYPE html>
<html>
<head>
    <title>Hóa Đơn Đặt Hàng</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .order-info {
            margin-bottom: 30px;
        }
        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .order-details th,
        .order-details td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .order-details th {
            background-color: #f8f9fa;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Xác Nhận Đơn Hàng</h1>
            <p>Cảm ơn bạn đã mua hàng tại Legend Shoes!</p>
        </div>

        <div class="order-info">
            <h2>Thông Tin Đơn Hàng #{{ $order->id }}</h2>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->order_date }}</p>
            <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
            <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment_status }}</p>
        </div>

        <div class="shipping-info">
            <h2>Thông Tin Giao Hàng</h2>
            <p><strong>Tên người nhận:</strong> {{ $order->address->full_name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->address->phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address->address }}, {{ $order->address->ward }}, {{ $order->address->district }}, {{ $order->address->province }}</p>
        </div>

        <h2>Chi Tiết Đơn Hàng</h2>
        <table class="order-details">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $item)
                    <tr>
                        <td>
                            @if($item->variant)
                                {{ $item->variant->product->name }} ({{ $item->variant->name }})
                            @else
                                {{ $item->product->name }}
                            @endif
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($order->total_price / $item->quantity, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            @if($order->voucher)
                <p>Tạm tính: {{ number_format($order->total_price + $order->voucher->discount, 0, ',', '.') }} VNĐ</p>
                <p>Giảm giá: -{{ number_format($order->voucher->discount, 0, ',', '.') }} VNĐ</p>
            @endif
            <p>Tổng cộng: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
        </div>
    </div>
</body>
</html>