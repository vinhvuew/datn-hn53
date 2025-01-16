@extends('admin.layouts.master')
@section('content')

<div class="cart">
    <h3 class="text-center">Quản Lí Ảnh</h3>

    <div class="cart-boby">
        {{-- <a href="{{route('image_gallery.create')}}" class="btn btn-success">Thêm Ảnh</a> --}}

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
                        <td><img src="{{ asset('storage/' . $image->img) }}" alt="Image" width="100"></td> 
                        <td>{{ $image->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $image->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <!-- Thêm các nút chức năng như chỉnh sửa, xóa nếu cần -->
                            {{-- <a href="{{ route('image.edit', $image->id) }}" class="btn btn-warning">Sửa</a> --}}
                            {{-- <form action="{{ route('image.destroy', $image->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form> --}}
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
