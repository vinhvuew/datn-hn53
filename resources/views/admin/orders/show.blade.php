@extends('admin.layouts.master')

@section('content')
    <div class="container my-4">
        <h1 class="text-center mb-4">Chi tiết sản phẩm</h1>
        <div class="table-responsive">
            <a href="{{ route('orders') }}" class="btn btn-warning">Back</a>
            <table class="table table-bordered table-striped table-hover align-middle text-center mt-2">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Address</th>
                        <th scope="col">Products</th>
                        <th scope="col">Image</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Voucher</th>
                        <th scope="col">Total Money</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Status Pay</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order_detail->users?->name ?? 'Không có tên người dùng' }}</td>
                        <td>{{ $order_detail->shipping_address }}</td>
                        <td>
                            @forelse ($order_detail->products as $product)
                                {{ $product->pivot->name_product }}<br>
                            @empty
                                Không có sản phẩm
                            @endforelse
                        </td>
                        <td>
                            @foreach ($order_detail->products as $product)
                                <img src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="Product Image" width="80"><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($order_detail->products as $product)
                                {{ $product->pivot->quantity }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($order_detail->products as $product)
                                {{$product->pivot->price}}VNĐ<br>
                            @endforeach
                        </td>                        
                        <td>{{ $order_detail->vouchers->name ?? 'Không có' }}</td>
                        <td>{{ $order_detail->total_price}}VNĐ</td>
                        <td>{{ $order_detail->pay }}</td>
                        <td>{{ $order_detail->status_pay ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                        <td>{{ $order_detail->status_order->status_name }}</td>
                        <td>{{ $order_detail->created_at }}</td>
                        <td>{{ $order_detail->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
