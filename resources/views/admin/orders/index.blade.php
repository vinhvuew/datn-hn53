@extends('admin.layouts.master')
@section('item-order', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Đơn hàng /</span> Danh sách đơn hàng
        </h4>
        <div class="card">
            <div class="card-body">
                <table id="example" class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thanh Toán</th>
                            <th>TT thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>ORDER {{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                <td>
                                    <span
                                        class="badge
                                        @switch($order->payment_method)
                                            @case('COD') bg-warning text-dark @break
                                            @case('VNPAY_DECOD') bg-info text-white @break
                                            @case('MOMO') bg-success @break
                                            @default bg-secondary
                                        @endswitch">
                                        {{ [
                                            'COD' => 'COD',
                                            'VNPAY_DECOD' => 'VNPAY_DECOD',
                                            'MOMO' => 'MOMO',
                                        ][$order->payment_method] ?? 'Không rõ' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($order->payment_status == 'Thanh toán thành công')
                                        <span class="badge bg-success">Thanh toán thành công</span>
                                    @elseif ($order->payment_status == 'Chờ thanh toán')
                                        <span class="badge bg-warning text-dark">Chờ thanh toán</span>
                                    @elseif ($order->payment_status == 'Thanh toán khi nhận hàng')
                                        <span class="badge bg-primary">Thanh toán khi nhận hàng</span>
                                    @else
                                        <span class="badge bg-secondary">Không xác định</span>
                                    @endif
                                </td>

                                <td>
                                    <span
                                        class="badge
                                            @switch($order->status)
                                                @case('pending') bg-warning text-dark @break
                                                @case('confirmed') bg-secondary text-white @break
                                                @case('shipping') bg-primary @break
                                                @case('delivered') bg-success @break
@case('completed') bg-info @break
                                                @case('canceled') bg-danger @break
                                                @case('admin_canceled') bg-danger @break
                                                @case('return_request') bg-danger @break
                                                @case('refuse_return') bg-danger @break
                                                @case('sent_information') bg-primary @break
                                                @case('return_approved') bg-danger @break
                                                @case('returned_item_received') bg-danger @break
                                                @case('refund_completed') bg-danger @break
                                                @default bg-secondary
                                            @endswitch">
                                        {{ [
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Xác nhận',
                                            'shipping' => 'Chờ giao hàng',
                                            'delivered' => 'Đang giao hàng',
                                            'completed' => 'Giao hàng thành công',
                                            'canceled' => 'Người mua đã hủy',
                                            'admin_canceled' => 'Đã hủy bởi' . Auth::user()->name,
                                            'return_request' => 'Yêu cầu trả hàng',
                                            'refuse_return' => 'Từ chối trả hàng',
                                            'sent_information' => 'Thông tin hoàn tiền',
                                            'return_approved' => 'Chấp nhận trả hàng',
                                            'returned_item_received' => 'Đã nhận được hàng trả lại',
                                            'refund_completed' => 'Hoàn tiền thành công',
                                        ][$order->status] ?? 'Không rõ' }}
                                    </span>
                                </td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem Chi Tiết"
                                        class="btn btn-info btn-sm me-1" href="{{ route('orders.show', $order->id) }}">
                                        <i class='bx bxs-show'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.parials.datatable')
