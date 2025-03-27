@extends('admin.layouts.master')
@section('title')
    Cập nhật quyền truy cập
@endsection

@section('menu-item-account')
    open
@endsection

@section('menu-sub-permission')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Tài Khoản /</span> Cập nhật quyền truy cập
        </h4>
        <form action="{{ route('permissions.update', $dataID->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Cập nhật quyền truy cập</h4>
                        <p>Quản lý quyền cho các chức năng cho hệ thống</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-info">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary">
                            Cập nhật
                        </button>
                    </div>
                </div>

                <div class="row">

                    <!-- Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Thông tin quyền truy cập</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Quyền</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $dataID->name }}">
                                </div>
                                <div class="col-6">
                                    <label for="">Quyền</label>
                                    <span class="text-danger" style="margin-left: 125px">* Trường này nhập theo định dạng
                                        (Table . function)</span>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ $dataID->slug }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-product-add.js"></script>
@endsection
