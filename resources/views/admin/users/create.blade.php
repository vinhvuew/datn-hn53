@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

<div class="container">
    <h1>Add New User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>phone</label>
            <input type="phone" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>

@endsection


