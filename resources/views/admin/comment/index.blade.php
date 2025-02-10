@extends('admin.layouts.master')

@section('content')
    <div class="container my-4">
        
        <h1 class="text-center mb-4">Quản Lý Bình Luận</h1>

       <a href="{{route('comment.create') }}" class="btn btn-success" >Các Nội Dung Vi Phạm Cộng Đồng</a> 

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
   
   
        <div class="table-responsive my-3">
            <table class="table table-bordered table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Người Dùng </th>
                        <th scope="col">parent_id</th>
                        <th scope="col">Mã Sản Phẩm</th>
                        <th scope="col">Biến Thể</th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Thời gian tạo</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Chức Năng</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listComment  as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$value->user_id}}</td>
                            <td>{{$value->parent_id}}</td>
                            <td>{{$value->product_id}}</td>
                            <td>{{$value->variant_id}}</td>
                            <td>{{$value->content}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                           
                            <td>

                                <div class="d-flex justify-content-center">
                                
                                    <form action="{{ route('comment.destroy', $value->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">
                                            Xóa
                                        </button>
                                    </form> 
                                </div>
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