@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

<div class="container">
    <h1>Add New User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập Họ Tên Của Bạn" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"  placeholder="Nhập Email Của Bạn" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="phone" name="phone" placeholder="Nhập SĐT Của Bạn" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"placeholder="Nhập Password Của Bạn" class="form-control" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Thêm Mới User</button>
    </form>
</div>

@endsection
