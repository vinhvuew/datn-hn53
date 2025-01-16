@extends('admin.layouts.master')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Người mua</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Mã giảm giá</th>
                <th scope="col">Tổng tiền</th>  
                <th scope="col">Phương thức thanh toán</th>
                <th scope="col">Trạng thái thanh toán</th>
                <th scope="col">Trạng thái đơn hàng</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Thời gian cập nhật</th>
                <th scope="col">Chức năng</th>  
            </tr>
        </thead>
        <tbody>
            @foreach ($listOrders as $key => $order)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$order->user_name}}</td> 
                <td>{{$order->shipping_address}}</td>
                <td>{{$order->voucher}}</td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->payment_method}}</td>
                <td>{{$order->name_status}}</td>
                <td>{{$order->status_pay}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->updated_at}}</td>
                <td>
                    <a href=""><button class="btn btn-warning">Chỉnh sửa</button></a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
