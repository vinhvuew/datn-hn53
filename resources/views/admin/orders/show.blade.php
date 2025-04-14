@extends('admin.layouts.master')
@section('title')
    Chi tiết đơn hàng
@endsection
@section('item-order', 'active')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Đơn Hàng /</span> Chi tiết đơn hàng
        </h4>
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">

            <div class="d-flex flex-column justify-content-center">
                <div class="d-flex">
                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                    @php
                        $statusClasses = [
                            'Chờ thanh toán' => 'bg-warning mx-2 rounded-pill text-dark',
                            'Thanh toán khi nhận hàng' => 'bg-danger mx-2 rounded-pill text-white',
                            'Thanh toán thành công' => 'bg-success mx-2 rounded-pill',
                        ];
                    @endphp
                    <span class="badge {{ $statusClasses[$order->payment_status] ?? 'bg-secondary' }}">
                        {{ $order->payment_status ?? 'Không rõ' }}
                    </span>
                    <span
                        class="badge
                        @switch($order->status)
                            @case('pending') bg-warning rounded-pill text-dark @break
                            @case('confirmed') bg-secondary rounded-pill text-white @break
                            @case('shipping') bg-primary rounded-pill @break
                            @case('delivered') bg-success rounded-pill @break
                            @case('completed') bg-info rounded-pill @break
                            @case('canceled') bg-danger rounded-pill @break
                            @case('admin_canceled') bg-danger rounded-pill @break
                            @case('return_request') bg-danger rounded-pill @break
                            @case('refuse_return') bg-danger rounded-pill @break
                            @case('sent_information') bg-primary rounded-pill @break
                            @case('return_approved') bg-success rounded-pill @break
                            @case('returned_item_received') bg-danger rounded-pill @break
                            @case('refund_completed') bg-danger rounded-pill @break
                            @default bg-secondary
                        @endswitch">
                        {{ [
                            'pending' => 'Chờ xác nhận',
                            'confirmed' => 'Xác nhận',
                            'shipping' => 'Chờ giao hàng',
                            'delivered' => 'Đang giao hàng',
                            'completed' => 'Giao hàng thành công',
                            'canceled' => 'Người mua đã hủy',
                            'admin_canceled' => 'Đã hủy bởi ' . Auth::user()->name,
                            'return_request' => 'Yêu cầu trả hàng',
                            'refuse_return' => 'Từ chối trả hàng',
                            'sent_information' => 'Thông tin hoàn tiền',
                            'return_approved' => 'Chấp nhận trả hàng',
                            'returned_item_received' => 'Đã nhận được hàng trả lại',
                            'refund_completed' => 'Hoàn tiền thành công',
                        ][$order->status] ?? 'Không rõ' }}
                    </span>
                </div>
                @php
                    use Carbon\Carbon;
                    $orderDate = $order->order_date
                        ? Carbon::parse($order->order_date)->setTimezone('Asia/Ho_Chi_Minh')
                        : null;
                @endphp
                <p class="mt-1 mb-0">
                    Ngày {{ $orderDate?->format('d') }},
                    Tháng {{ $orderDate?->format('m') }}
                    Năm {{ $orderDate?->format('Y') }},
                    {{ $orderDate?->format('h:i A') }}
                </p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <a class="btn btn-info" href="{{ route('orders.index') }}">Quay Lại</a>
                @if (isset($rufund) && $rufund->order_id === $order->id)
                    <a class="btn btn-success" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#rufund">Lý
                        do
                        hoàn hàng</a>
                @endif

                @if ($order->status == 'pending')
                    {{-- <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                        @csrf
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancel">Hủy
                            đơn</button>
                    </form> --}}
                    <form action="{{ route('orders.confirmed', $order->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn?')">Xác
                            nhận</button>
                    </form>
                @elseif ($order->status == 'confirmed')
                    <form action="{{ route('orders.shipping', $order->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn?')">Chờ
                            giao hàng</button>
                    </form>
                @elseif ($order->status == 'shipping')
                    <form action="{{ route('orders.delivered', $order->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn?')">Đang
                            giao hàng</button>
                    </form>
                @elseif($order->status == 'delivered')
                    <form action="{{ route('profile.orders.confirm-received', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn?');">
                            Đã giao hàng
                        </button>
                    </form>
                @elseif ($order->status == 'canceled')
                    <form action="" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                @elseif ($order->status == 'return_request')
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse">Từ
                        chối</button>
                @elseif ($order->status == 'return_approved')
                    <form action="{{ route('orders.returned_item_received', $order->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Kiểm tra hàng hoàn</button>
                    </form>
                @elseif ($order->status == 'returned_item_received' || $order->status == 'sent_information')
                    <a class="btn btn-danger" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#confirmation">
                        Hoàn tiền
                    </a>
                @endif
            </div>
        </div>
        <!-- Order Details Table -->
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Chi tiết đơn hàng</h5>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables-order-details table">
                            <thead>
                                <tr>
                                    <th class="w-50">Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    @if ($item->product)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center mb-1">
                                                    <div class="avatar me-2 pe-1">
                                                        @if ($item->product->img_thumbnail)
                                                            <img class="rounded-2"
                                                                src="{{ Storage::url($item->product->img_thumbnail) }}"
                                                                width="50px" alt="">
                                                        @else
                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                width="50px" alt="Default Image">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong>{{ $item->product_name }}</strong>
                                                    </div>
                                                </div>
                                                <span class="block text-sm text-gray-700">
                                                    Không biến thể
                                                </span>
                                            </td>
                                            <td>
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price, 0, ',', '.') }} VND</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center mb-1">
                                                    <div class="avatar me-2 pe-1">
                                                        @if ($item->variant && $item->variant->product->img_thumbnail)
                                                            <img class="rounded-2"
                                                                src="{{ Storage::url($item->variant->product->img_thumbnail) }}"
                                                                width="50px" alt="">
                                                        @else
                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                width="50px" alt="Default Image">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong>{{ $item->product_name }}</strong>
                                                    </div>
                                                </div>
                                                @php
                                                    $attributes = explode(' - ', $item->variant_attribute);
                                                    $values = explode(' - ', $item->variant_value);
                                                @endphp

                                                <span class="block text-sm text-gray-700">
                                                    @foreach ($attributes as $index => $attribute)
                                                        {{ $attribute }}: {{ $values[$index] ?? '' }}@if (!$loop->last)
                                                            |
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </td>
                                            <td>
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th>
                                        Mã voucher
                                    </th>
                                    <th>
                                        voucher
                                    </th>
                                    <th>
                                        Giảm giá
                                    </th>
                                    <th>
                                        Số tiền đã giảm
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $order->voucher_code }}
                                    </td>
                                    <td>
                                        {{ $order->voucher_name }}
                                    </td>
                                    <td>
                                        {{ $order->voucher_discount_type == 'percentage'
                                            ? number_format($order->voucher_discount_value, 0) . '%'
                                            : number_format($order->voucher_discount_value, 0) }}
                                    </td>
                                    <td>
                                        {{ number_format($order->voucher_discount_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-end align-items-center m-3 p-1">
                            <div class="order-calculations">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="w-px-100 text-heading fw-bold">Tổng cộng:</span>
                                    <h6 class="mb-0">{{ number_format($item->order->total_price, 0, ',', '.') }} VND
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title m-0">Hoạt động vận chuyển</h5>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="timeline pb-0 mb-0">
                            @php
                                $hasReceived = false;
                            @endphp

                            @foreach ($events as $item)
                                @if ($item->name === 'Giao hàng thành công')
                                    @php $hasReceived = true; @endphp
                                @endif
                            @endforeach
                            @foreach ($events as $item)
                                @if ($item->name !== 'Đang giao hàng' && $item->name !== 'Giao hàng thành công')
                                    <li
                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                        <span class="timeline-point-wrapper"> <span
                                                class="timeline-point timeline-point-primary"></span> </span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                <span class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                    |
                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                            </div>
                                            <p class="mt-2">{{ $item->note }}</p>
                                        </div>
                                    </li>
                                @elseif ($item->name === 'Đang giao hàng')
                                    {{-- Hiển thị "Giao hàng thành công" nếu chưa có trong danh sách --}}
                                    @if (!$hasReceived)
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point-wrapper"> <span
                                                    class="timeline-point timeline-point-secondary"></span> </span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0 mt-1">Giao hàng thành công</h6>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    {{-- Hiển thị trạng thái "Đang giao hàng" --}}
                                    <li
                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                        <span class="timeline-point-wrapper"> <span
                                                class="timeline-point timeline-point-primary"></span> </span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                <span class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                    |
                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                            </div>
                                            <p class="mt-2">{{ $item->note }}</p>
                                        </div>
                                    </li>
                                @elseif ($item->name === 'Giao hàng thành công')
                                    <li
                                        class="timeline-item timeline-item-transparent {{ !$loop->last ? 'border-primary' : 'border-transparent' }}">
                                        <span class="timeline-point-wrapper"> <span
                                                class="timeline-point timeline-point-primary"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                <span class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}
                                                    |
                                                    {{ $item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}</span>
                                            </div>
                                            <p class="mt-2">{{ $item->note }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Chi tiết khách hàng</h6>
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <div class="avatar me-2">
                                @if ($order->user->avatar)
                                    <img src="{{ Storage::url($order->user->avatar) }}" alt="Avatar"
                                        class="rounded-circle">
                                @else
                                    <img src="{{ asset('themes/image/logo.jpg') }}" alt="Avatar"
                                        class="rounded-circle">
                                @endif

                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html">
                                    <h6 class="mb-1">{{ $order->user->name }}</h6>
                                </a>
                                <small>Mã khách hàng: #{{ $order->user->id }}</small>
                            </div>
                        </div>
                        {{-- <div class="d-flex justify-content-start align-items-center mb-4">
                            <span
                                class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                    class='mdi mdi-cart-plus mdi-24px'></i></span>
                            <h6 class="text-nowrap mb-0">{{ $order->count('user_id') }} Đơn Hàng</h6>
                        </div> --}}
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Thông tin liên lạc</h6>
                        </div>
                        <p class=" mb-1">Email: {{ $order->user->email }}</p>
                        <p class=" mb-0">Số điện thoại: {{ $order->user->phone }}</p>
                    </div>
                </div>

                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between">
                        <h6 class="card-title m-0">Thông tin giao hàng</h6>
                    </div>
                    <div class="card-body">
                        <p>Email: {{ $order->address->email }}</p>
                        <p>SĐT: {{ $order->address->phone }}</p>
                        <p class="mb-0">Địa chỉ: {{ $order->address->address }}, {{ $order->address->ward }}
                            <br> {{ $order->address->district }}
                            <br>Tỉnh/Thành Phố: {{ $order->address->province }}
                            {{ $order->user_address }}<br>Việt Nam
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if (isset($rufund) && $rufund->order_id === $order->id)
            <!-- Refund Modal-->
            <div class="modal fade" id="rufund" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body py-3 py-md-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Yêu cầu trả hàng / hoàn tiền</h3>
                                <p class="pt-1">Thông tin chi tiết Yêu cầu trả hàng / hoàn tiền</p>
                            </div>
                            <form action="{{ route('orders.return_request', $order->id) }}" class="row g-4"
                                method="POST">
                                @csrf
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" value="{{ $rufund->reason }}"
                                            disabled />
                                        <label for="reason">Lý do trả hàng / hoàn tiền</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control"
                                            value="{{ number_format($rufund->total_amount, 0, ',', '.') }} VNĐ"
                                            disabled />
                                        <label for="total_amount">Số tiền hoàn lại</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" value="{{ $rufund->refund_on }}"
                                            disabled />
                                        <label for="refund_on">Hoàn tiền vào ( Ngân Hàng/STK/Chủ Tài Khoản )</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control" cols="30" rows="10" disabled>{{ $rufund->note }}</textarea>
                                        <label for="modalEditUserEmail">Mô tả</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mt-2">
                                    <label for="modalEditUserEmail">Ảnh chứng minh</label>
                                    <div class="form-floating form-floating-outline">
                                        @foreach ($prove_refunds as $item)
                                            @if ($item->image)
                                                <img id="myImg" class="rounded-2"
                                                    src="{{ Storage::url($item->image) }}" width="80px">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mt-2">
                                    <label for="modalEditUserEmail">Video chứng minh</label>
                                    <div class="form-floating form-floating-outline">
                                        @foreach ($prove_refunds as $item)
                                            @if ($item->video)
                                                <video class="rounded-2" controls src="{{ Storage::url($item->video) }}"
                                                    width="80px"></video>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" value="{{ $rufund->email }}"
                                            disabled />
                                        <label for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    @if ($order->status === 'return_request')
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Xác nhận</button>
                                        <button type="button" data-bs-dismiss="modal" aria-label="Close"
                                            class="btn btn-outline-secondary">
                                            Quay lại
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Refund Modal -->
        @endif
        <div class="col-6">
            <div id="myModal" class="modal col-6">
                <span class="close" id="closeBtn">&times;</span>
                <img class="modal-contents" id="imgModal">
            </div>
        </div>
        <div class="modal fade" id="confirmation" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Hoàn tiền khách hàng</h3>
                            <p class="pt-1">Thông tin sẽ được gửi đến người mua hàng</p>
                        </div>
                        <form action="{{ route('orders.refund_completed', $order->id) }}" class="row g-4" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea name="note"cols="30" rows="10" class="form-control"></textarea>
                                    <label for="modalEditUserFirstName">Nội dung</label>
                                </div>
                                <div class="mt-2">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Hủy bỏ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="refuse" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Lý do từ chối yêu cầu trả hàng / hoàn tiền</h3>
                            <p class="pt-1">Thông tin sẽ được gửi đến người mua hàng</p>
                        </div>
                        <form action="{{ route('orders.refuse_return', $order->id) }}" class="row g-4" method="POST">
                            @csrf
                            <div class="col-12 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea name="note"cols="30" rows="10" class="form-control"></textarea>
                                    <label for="modalEditUserFirstName">Lý do từ chối</label>
                                </div>
                                @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Hủy bỏ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cancel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Lý do hủy đơn hàng</h3>
                            <p class="pt-1">Thông tin sẽ được gửi đến người mua hàng</p>
                        </div>
                        {{-- <form action="{{ route('orders.cancel', $order->id) }}" class="row g-4" method="POST">
                            @csrf
                            <div class="col-12 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea name="note"cols="30" rows="10" class="form-control" placeholder="Lý do từ chối..."></textarea>
                                    <label for="note">Lý do từ chối</label>
                                </div>
                                @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Hủy bỏ</button>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
@section('style-libs')
    <style>
        .modal-contents {
            margin: 15% auto;
            display: block;
            width: 75%;
            max-width: 600px;
        }
    </style>
@endsection
@section('script-libs')
    <script>
        document.getElementById('flexCheckChecked').addEventListener('change', function() {
            const additionalInput = document.getElementById('additionalInput');
            if (this.checked) {
                additionalInput.style.display = 'block'; // Hiển thị ô input
            } else {
                additionalInput.style.display = 'none'; // Ẩn ô input
            }
        });
    </script>
    <script>
        // Lấy phần tử hình ảnh và modal
        var img = document.getElementById("myImg");
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("imgModal");
        var closeBtn = document.getElementById("closeBtn");

        // Khi người dùng nhấp vào hình ảnh, mở modal và hiển thị hình ảnh lớn
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src; // Đặt hình ảnh modal với hình ảnh đã nhấp
        }

        // Khi người dùng nhấp vào nút đóng, đóng modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Khi người dùng nhấp ngoài modal, đóng modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-order-details.js"></script>
@endsection
