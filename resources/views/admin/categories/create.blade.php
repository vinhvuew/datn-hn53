@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Thêm Danh Mục</h1>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}"> 
            @error('name')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form> 
</div>
@endsection


