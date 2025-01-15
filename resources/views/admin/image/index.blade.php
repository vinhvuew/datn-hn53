@extends('admin.layouts.master')
@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ảnh</th>
      <th scope="col">Chức Năng</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Ảnh</td>
      <td>
        <button type="button" class="btn btn-success">Xóa</button>
        <button type="button" class="btn btn-danger">Sửa</button>
      </td>
     
    </tr>
   
   
  </tbody>
</table>

@endsection
@section('style-libs')
@endsection
@section('script-libs')
@endsection
