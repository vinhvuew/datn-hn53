@extends('admin.layouts.master')

@section('content')

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header text-white">
                <h5 class="mb-0">Quản Lý Người Dùng</h5>
            </div>
            <div class="card-body">

                <!-- Hiển thị thông báo thành công -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Hiển thị lỗi nếu có -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Vai Trò</th>
                                <th class="text-center">Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center align-middle">{{ $user->id }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->phone }}</td>
                                    <td class="align-middle">{{ $user->role }}</td>
                                    <td class="text-center align-middle">

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa người dùng này?');
        }
    </script>


@endsection
