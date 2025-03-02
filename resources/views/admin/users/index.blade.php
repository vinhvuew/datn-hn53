@extends('admin.layouts.master')

@section('content')
    <div class="container mt-4">
        <div id="alert-container"></div> 

        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Quản Lý Người Dùng</h5>
            </div>
            <div class="card-body">
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
                                    <td class="align-middle">{{ $user->email ?? '-' }}</td>
                                    <td class="align-middle">{{ $user->phone ?? '-' }}</td>
                                    <td class="align-middle">
                                        <select name="role" class="form-select form-select-sm role-select"
                                            data-user-id="{{ $user->id }}"
                                            data-old-role="{{ $user->role }}">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </td>
                                    <td class="text-center align-middle">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirmDelete(event, '{{ $user->name }}')">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        
        function confirmDelete(event, userName) {
            if (!confirm('Bạn có chắc chắn muốn xóa người dùng "' + userName + '"?')) {
                event.preventDefault();
            }
        }

        $(document).ready(function () {
            $('.role-select').on('change', function () {
                let selectElement = $(this);
                let userId = selectElement.data('user-id');
                let newRole = selectElement.val();
                let oldRole = selectElement.attr('data-old-role');
                let token = "{{ csrf_token() }}";

                if (!confirm("Bạn có chắc chắn muốn thay đổi vai trò?")) {
                    selectElement.val(oldRole);
                    return;
                }

                $.ajax({
                    url: "{{ route('users.updateRole') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        user_id: userId,
                        role: newRole
                    },
                    success: function (response) {
                        selectElement.attr('data-old-role', newRole);
                        $('#alert-container').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `);
                    },
                    error: function (xhr) {
                        let errorMessage = "Có lỗi xảy ra.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        selectElement.val(oldRole);
                        $('#alert-container').html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${errorMessage}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `);
                    }
                });
            });
        });
    </script>
@endsection
