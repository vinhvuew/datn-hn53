@extends('admin.layouts.master')
@section('content')
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Người mua</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Trạng thái đơn hàng</th>
                <th scope="col">Mã giảm giá</th>
                <th scope="col">Phương thức thanh toán</th>
                <th scope="col">Trạng thái thanh toán</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Thời gian cập nhật</th>
                <th scope="col">Chức năng</th>  
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href=""><button class="btn btn-warning">Chỉnh sửa</button></a>
                    <a href=""><button class="btn btn-danger">Xóa</button></a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
