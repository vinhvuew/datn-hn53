@extends('admin.layouts.master')

@section('item-product', 'open')
@section('item-product-index', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Sản phẩm /</span> Danh sách sản phẩm
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <!-- Search Bar and Add Product Button -->
            <div class="card-header d-flex justify-content-end align-items-center">
                <a class="btn btn-primary me-2" href="{{ route('products.create') }}">
                    + THÊM SẢN PHẨM</a>
            </div>
            <!-- Product Table -->
            <div class="card-body">
                <table id="example"
                    class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Tên sp</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá cơ bản</th>
                            <th>Giá bán</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->brand->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ Storage::url($item->img_thumbnail) }}" width="50px"></td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->base_price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($item->price_sale, 0, ',', '.') }} VND</td>
                                <td>
                                    @if ($item->variants->isEmpty())
                                        <em>Không có biến thể</em>
                                    @else
                                        <h4>Biến thể sản phẩm</h4>
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Sku</th>
                                                    <th>Giá nhập</th>
                                                    <th>Giá bán</th>
                                                    <th>Tồn Kho</th>
                                                    <th>Ảnh biến thể</th>
                                                    <th>Thuộc Tính</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($item->variants as $variant)
                                                    <tr>
                                                        <td>{{ $variant->sku }}</td>
                                                        <td>{{ number_format($variant->wholesale_price, 0, ',', '.') }} VND
                                                        </td>
                                                        <td>{{ number_format($variant->selling_price, 0, ',', '.') }} VND
                                                        </td>
                                                        <td>{{ $variant->quantity }}</td>
                                                        <td>
                                                            @if ($variant->image)
                                                                <img src="{{ Storage::url($variant->image) }}"
                                                                    width="50px" alt="">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($variant->attributes)
                                                                <ul>
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        <li>{{ $attribute->attribute->name }}:
                                                                            {{ Str::limit($attribute->attributeValue->value, 15) }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <em>Không có thuộc tính</em>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-success">Chi
                                        tiết</a>
                                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Chỉnh
                                        sửa</a>
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
