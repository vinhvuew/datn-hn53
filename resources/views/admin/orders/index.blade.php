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
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->voucher }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                            <td>{{ $order->payment_method }}</td>
                            <td class="{{ $order->name_status == 'Đã thanh toán' ? 'text-success' : 'text-danger' }}">
                                {{ $order->name_status }}
                            </td>
                            <td class="{{ $order->status_pay == 'Hoàn thành' ? 'text-success' : 'text-warning' }}">
                                {{ $order->status_pay }}
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="" class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
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
