@extends('admin.layouts.master')
@section('content')

<div class="cart">
    <h3 class="text-center"><br>Quản Lý Ảnh</h3>

    <div class="cart-boby">
        
           <a href="{{route('image.create') }}" class="btn btn-success" >Thêm Ảnh</a>

        <table class="table table-striped tab-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Chỉnh Sửa</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listImage as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td>
                            <img src="{{ Storage::url($image->img) }}" alt="Image" width="100px" height="100px">

                        </td>
                       
                       <td>{{ $image->created_at->format('d/m/Y h:i:s') }}</td>
                     
                        
                        <td>{{ $image->updated_at->format('d/m/Y h:i:s') }}</td>
                        <td>
                            
                            <a href="" class="btn btn-warning">Sửa</a>
                            <a href="" class="btn btn-danger">Xóa</a>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection

@section('style-libs')
@endsection

@section('script-libs')
@endsection
