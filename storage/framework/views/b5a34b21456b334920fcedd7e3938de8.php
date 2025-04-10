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
            <h2>Thông Tin Đơn Hàng #<?php echo e($order->id); ?></h2>
            <p><strong>Ngày đặt hàng:</strong> <?php echo e($order->order_date); ?></p>
            <p><strong>Trạng thái:</strong> <?php echo e($order->status); ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo e($order->payment_method); ?></p>
            <p><strong>Trạng thái thanh toán:</strong> <?php echo e($order->payment_status); ?></p>
        </div>

        <div class="shipping-info">
            <h2>Thông Tin Giao Hàng</h2>
            <p><strong>Tên người nhận:</strong> <?php echo e($order->address->full_name); ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo e($order->address->phone); ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo e($order->address->address); ?>, <?php echo e($order->address->ward); ?>, <?php echo e($order->address->district); ?>, <?php echo e($order->address->province); ?></p>
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
                <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($item->variant): ?>
                                <?php echo e($item->variant->product->name); ?> (<?php echo e($item->variant->name); ?>)
                            <?php else: ?>
                                <?php echo e($item->product->name); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td><?php echo e(number_format($order->total_price / $item->quantity, 0, ',', '.')); ?> VNĐ</td>
                        <td><?php echo e(number_format($order->total_price, 0, ',', '.')); ?> VNĐ</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="total">
            <?php if($order->voucher): ?>
                <p>Tạm tính: <?php echo e(number_format($order->total_price + $order->voucher->discount, 0, ',', '.')); ?> VNĐ</p>
                <p>Giảm giá: -<?php echo e(number_format($order->voucher->discount, 0, ',', '.')); ?> VNĐ</p>
            <?php endif; ?>
            <p>Tổng cộng: <?php echo e(number_format($order->total_price, 0, ',', '.')); ?> VNĐ</p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/emails/order-invoice.blade.php ENDPATH**/ ?>