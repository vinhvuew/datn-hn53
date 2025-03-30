@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách Voucher</h1>

        <!-- Thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Nút tạo voucher mới -->

        <!-- Bảng danh sách voucher -->
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center">
                <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">Tạo Voucher Mới</a>

            </div>
            <div class="card-body">
                <table id="example"
                    class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã Voucher</th>
                            <th>Tên Voucher</th>
                            <th>Giảm giá</th>
                            <th>Điều kiện áp dụng</th>
                            <th>Giảm giá tối đa</th>
                            <th>Trạng thái</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                {{-- Mã Voucher --}}
                                <td>{{ $voucher->code }}</td>

                                {{-- Tên Voucher --}}
                                <td>{{ $voucher->name }}</td>

                                {{-- Giảm Giá --}}
                                <td>
                                    @if ($voucher->discount_type == 'percentage')
                                        {{ number_format($voucher->discount_value, 0) }}%
                                    @else
                                        {{ number_format($voucher->discount_value, 0) }} VND
                                    @endif
                                </td>

                                {{-- Điều Kiện Áp Dụng --}}
                                <td>{{ number_format($voucher->min_order_value, 0) }} VND</td>

                                {{-- Giảm Giá Tối Đa (Chỉ hiển thị nếu có) --}}
                                <td>
                                    {{ $voucher->discount_type == 'percentage' && $voucher->max_discount_value ? number_format($voucher->max_discount_value, 0) . ' VND' : '-' }}
                                </td>

                                {{-- Trạng Thái --}}
                                <td>
                                    @php
                                        $statusClass = match ($voucher->status) {
                                            'active' => 'bg-success',
                                            'expired' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($voucher->status) }}</span>
                                </td>

                                {{-- Ngày Bắt Đầu --}}
                                <td>{{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }}</td>

                                {{-- Ngày Kết Thúc --}}
                                <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</td>

                                {{-- Thao Tác --}}
                                <td class="text-center">
                                    <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa voucher này?')">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </form>
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
