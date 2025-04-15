@extends('admin.layouts.master')
@section('item-order', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2">
            <span class="text-muted fw-light">Đơn hàng /</span> Danh sách đơn hàng
        </h4>
        <div class="card mb-3">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2">{{ $pending }}</h3>
                                    <p class="mb-0">Chờ xác nhận</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="{{ route('orders.index', ['status' => 'pending']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-hourglass bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2">{{ $confirmed }}</h3>
                                    <p class="mb-0">Đã xác nhận</p>
                                </div>
                                <div class="avatar me-lg-4">
                                    <a href="{{ route('orders.index', ['status' => 'confirmed']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-circle bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h3 class="mb-2">{{ $shipping }}</h3>
                                    <p class="mb-0">Chờ giao hàng</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="{{ route('orders.index', ['status' => 'shipping']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bxs-truck bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-2">{{ $delivered }}</h3>
                                    <p class="mb-0">Đang giao hàng</p>
                                </div>
                                <div class="avatar">
                                    <a href="{{ route('orders.index', ['status' => 'delivered']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-package bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2">{{ $payment_status }}</h3>
                                    <p class="mb-0">Chờ thanh toán</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="{{ route('orders.index', ['payment_status' => 'Chờ thanh toán']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-credit-card bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2">{{ $order_confirmation }}</h3>
                                    <p class="mb-0">Hoàn thành</p>
                                </div>
                                <div class="avatar me-lg-4">
                                    <a href="{{ route('orders.index', ['status' => 'order_confirmation']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-double bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h3 class="mb-2">{{ $refund }}</h3>
                                    <p class="mb-0">Hoàn hàng</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="{{ route('orders.index', ['status' => 'refund_completed']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-refresh bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-2">{{ $canceled }}</h3>
                                    <p class="mb-0">Đã hủy</p>
                                </div>
                                <div class="avatar">
                                    <a href="{{ route('orders.index', ['status' => 'canceled']) }}">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-x-circle bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('orders.updateStatus') }}" method="POST">
            @csrf
            <div class="mb-2 d-flex gap-3 justify-content-between">
                <!-- Nút xử lý ẩn ban đầu -->
                <div>
                    <select name="status" class="form-select w-auto d-none">
                        @if (request('status') == 'pending')
                            <option value="confirmed">Xác nhận</option>
                        @endif
                        @if (request('status') == 'confirmed')
                            <option value="shipping">Chờ giao hàng</option>
                        @endif
                        @if (request('status') == 'shipping')
                            <option value="delivered">Đang giao hàng</option>
                        @endif
                    </select>

                    <!-- Nút submit sẽ ẩn/hiện bằng JavaScript -->
                    @php
                        $status = request('status');
                    @endphp

                    @if (in_array($status, ['pending', 'confirmed', 'shipping']))
                        <button id="bulkActionBtn" type="submit" class="btn btn-primary btn-sm d-none">
                            <i class="bx bx-check-double me-1"></i> Xử lý đơn đã chọn
                        </button>
                    @endif

                </div>
                <div>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-list-ul"></i> Tất cả
                    </a>
                    @if (request('status') || request('payment_status'))
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bx bx-x"></i> Xóa lọc
                        </a>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example"
                        class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                @if (in_array($status, ['pending', 'confirmed', 'shipping']))
                                    <th>
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                @endif
                                <th>Tên khách hàng</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>ORDER_{{ $order->id }}</td>
                                    @if (in_array($status, ['pending', 'confirmed', 'shipping']))
                                        <td>
                                            <input type="checkbox" class="order-checkbox" name="order_id[]"
                                                value="{{ $order->id }}">
                                        </td>
                                    @endif
                                    <td>{{ $order->user->name }}</td>
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
                                        <span id="order-status-{{ $order->id }}"
                                            class="badge
                                            @switch($order->status)
                                                @case('pending') bg-warning text-dark @break
                                                @case('confirmed') bg-secondary text-white @break
                                                @case('shipping') bg-primary @break
                                                @case('delivered') bg-success @break
                                                @case('completed') bg-info @break
                                                @case('received') bg-info @break
                                                @case('order_confirmation') bg-success @break
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
                                                'received' => 'Đã nhận hàng',
                                                'order_confirmation' => 'Hoàn thành',
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
                                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem Chi Tiết"
                                            class="btn btn-info btn-sm me-1"
                                            href="{{ route('orders.show', $order->id) }}">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
@endsection

@include('admin.layouts.parials.datatable')
