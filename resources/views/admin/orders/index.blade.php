@extends('admin.layouts.master')

@section('content')
    <div class="container my-4">
        <h1 class="text-center mb-4">Quản lý đơn hàng</h1>

        {{-- Hiển thị thông báo thành công hoặc lỗi --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Bảng danh sách đơn hàng --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">User</th>
                        <th scope="col">Address</th>
                        <th scope="col">Voucher</th>
                        <th scope="col">Total Money</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Status Pay</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listOrders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->voucher_name }}</td>
                            <td>{{ ($order->total_price) }}vnđ  </td>
                            <td>{{ $order->pay}}</td>
                            <td>{{ $order->status_pay }}</td>
                            <td>{{ $order->status_name }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="{{ route('orders.show', $order->id)}}" class="btn btn-info">Detail</a>
                                    <a href="#" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('style-libs')
    {{-- Thêm các thư viện CSS nếu cần --}}
@endsection

@section('script-libs')
    {{-- Thêm các thư viện JavaScript nếu cần --}}
@endsection
