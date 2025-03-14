@extends('admin.layouts.master')
@section('title')
    Quản lý đơn hàng
@endsection
@section('menu-item-order', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">
            <span class="text-muted fw-light">Đơn hàng /</span> Danh sách đơn hàng
        </h4>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thanh Toán</th>
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
                                        class="btn btn-info btn-sm me-1" href="{{ route('orders.show', $order->id) }}">xem
                                        chi tiết
                                        <i class="mdi mdi-eye"></i>
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

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        new DataTable("#example", {
            order: []
        });
    </script>
@endsection
