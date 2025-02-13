@extends('admin.layouts.master')

@section('content')
<div class="container my-4">
    <h1 class="text-center">Chỉnh sửa trạng thái đơn hàng</h1>

    {{-- Hiển thị thông báo lỗi hoặc thành công --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="status_order_id" class="form-label">Trạng thái đơn hàng</label>
            <select name="status_order_id" id="status_order_id" class="form-select" required 
                {{ $order->status_order_id == 4 ? 'disabled' : '' }}> {{-- Vô hiệu hóa nếu đơn hàng đã giao thành công --}}
                
                @foreach ($statusList as $status)
                    <option value="{{ $status->id }}"
                        {{ $order->status_order_id == $status->id ? 'selected' : '' }}
                        @if(in_array($order->status_order_id, [3, 4]) && $status->id < $order->status_order_id)
                            disabled
                        @endif
                    >
                        {{ $status->status_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nút cập nhật sẽ bị ẩn nếu đơn hàng đã giao thành công --}}
        @if ($order->status_order_id != 4)
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        @else
            <div class="alert alert-info">Đơn hàng đã giao thành công. Không thể chỉnh sửa trạng thái.</div>
        @endif

        <a href="{{ route('orders') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
