@extends('admin.layouts.master')
@section('item-atribute', 'open')

@section('item-atribute-value', 'active')
@section('content')
    <div class="container mt-5">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">GIÁ TRỊ THUỘC TÍNH /</span> DANH SÁCH GIÁ TRỊ THUỘC TÍNH
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif


    </div>

    <!-- Category List Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-end align-items-center">
            <a class="btn btn-primary me-2" href="{{ route('attribute-values.create') }}">
                <i class="mdi mdi-plus me-0 me-sm-1"></i>
                + THÊM GIÁ TRỊ THUỘC TÍNH</a>
        </div>
        <div class="card-body">
            <table id="example" class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>STT</th>
                        <th>TÊN THUỘC TÍNH</th>
                        <th>GIÁ TRỊ THUỘC TÍNH</th>
                        <th>HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($values as $value)
                        <!-- Placeholder Rows -->
                        <tr class="text-center">
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->attribute->name }}</td>
                            <td>{{ $value->value }}</td>
                            <td>

                                <a href="{{ route('attribute-values.edit', $value->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('attribute-values.destroy', $value->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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
