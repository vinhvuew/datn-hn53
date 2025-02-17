@extends('admin.layouts.master')
@section('content')
    <div class="cart">
       
        <h3 class="text-center"><br>Thêm Ảnh</h3>


        <div class="cart-boby">
            <form action="{{route('image.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="img">Hình Ảnh </label>
                    <input type="file" class="form-control  @error('img') is-invalid @enderror " name="img"
                        value="{{ old('img') }}">
                    @error('img')
                        <div class="invalid-feeback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="created_at">Ngày Up Ảnh </label>
                    <input type="date" class="form-control  @error('created_at') is-invalid @enderror " name="created_at"
                        value="{{ old('created_at') }}">
                    @error('created_at')
                        <div class="invalid-feeback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <button class="btn btn-success">Thêm Ảnh</button>
                </div>



            </form>


        </div>

    </div>
@endsection

@section('style-libs')
@endsection

@section('script-libs')
@endsection
