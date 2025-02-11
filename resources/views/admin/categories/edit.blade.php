@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Sửa Danh Mục</h1>

    <form action="{{ route('category.update',$category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{old('name',$category->name)}}"> 
            @error('name')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form> 
</div>
@endsection

