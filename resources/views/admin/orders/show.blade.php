@extends('admin.layouts.master')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">Chi tiết sản phẩm</h1>
    <a href="{{ route('orders') }}" class="btn btn-warning">Back</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center mt-2">
            <thead class="table-primary">
                <tr>
                    <th>User</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Voucher</th>
                    <th>Total Money</th>
                    <th>Pay</th>
                    <th>Status Pay</th>
                    <th>Status Order</th>
                    <th>Created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_detail->products as $product)
                    <tr>
                        <td>{{ $order_detail->users?->name ?? 'Không có tên người dùng' }}</td>
                        <td>{{ $order_detail->shipping_address }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="Product Image" width="80"></td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->price }}VNĐ</td>
                        <td>{{ $order_detail->vouchers->name ?? 'Không có' }}</td>
                        <td>{{ $order_detail->total_price }}VNĐ</td>
                        <td>{{ $order_detail->pay }}</td>
                        <td>{{ $order_detail->status_pay ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                        <td>{{ $order_detail->status_order->status_name }}</td>
                        <td>{{ $order_detail->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
