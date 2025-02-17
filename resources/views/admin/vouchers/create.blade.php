@extends('admin.layouts.master')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header text-white">
                <h5 class="mb-0">Thêm Mã Giảm Giá</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('voucher.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="voucher" class="form-label">Mã Voucher:</label>
                        <input type="text" class="form-control @error('voucher') is-invalid @enderror" id="voucher"
                            name="voucher" value="{{ old('voucher') }}">
                        @error('voucher')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Voucher:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valid_from" class="form-label">Ngày Bắt Đầu:</label>
                            <input type="date" class="form-control @error('valid_from') is-invalid @enderror"
                                id="valid_from" name="valid_from" value="{{ old('valid_from') }}">
                            @error('valid_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="valid_to" class="form-label">Ngày Kết Thúc:</label>
                            <input type="date" class="form-control @error('valid_to') is-invalid @enderror"
                                id="valid_to" name="valid_to" value="{{ old('valid_to') }}">
                            @error('valid_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-plus-circle"></i> Thêm Voucher
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
