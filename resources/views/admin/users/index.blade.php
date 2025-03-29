@extends('admin.layouts.master')
@section('item-user')
    open
@endsection
@section('user-index')
    active
@endsection

@section('content')
    <main>
        <div class="container mt-4">
            <div id="alert-container"></div>

            <div class="card shadow-sm border-0 rounded">
                <div class="card-header text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quản Lý Người Dùng</h5>
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm me-2" placeholder="Nhập tên, email hoặc SĐT"
                            style="max-width: 250px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm me-2">🔍 Tìm kiếm</button>

                        @if (request('search'))
                            <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Quay Lại</a>
                        @endif
                    </form>
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
                                    <th>Địa Chỉ</th>
                                    <th>Vai Trò</th>
                                    <th class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->role_id == 2)
                                        {{-- Chỉ hiển thị User --}}
                                        <tr id="user-row-{{ $user->id }}">
                                            <td class="text-center align-middle">{{ $user->id }}</td>
                                            <td class="align-middle">{{ $user->name }}</td>
                                            <td class="align-middle">{{ $user->email ?? '-' }}</td>
                                            <td class="align-middle">{{ $user->phone ?? '-' }}</td>
                                            <td class="align-middle">{{ $user->address }}</td>
                                            <td class="align-middle">
                                                <select name="role" class="form-select form-select-sm role-select"
                                                    data-user-id="{{ $user->id }}"
                                                    data-old-role="{{ $user->role_id }}">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center align-middle">
                                                <form class="delete-form d-inline" data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-user">
                                                        <i class="fas fa-trash-alt"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý sự kiện XÓA người dùng bằng SweetAlert2 + AJAX

            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function() {
                    let form = this.closest('form');
                    let userId = form.getAttribute('data-user-id');
                    let userName = form.getAttribute('data-user-name');

                    Swal.fire({
                        title: "Xác nhận xóa?",
                        text: `Bạn có chắc chắn muốn xóa người dùng "${userName}"?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Xóa",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ route('users.destroy', '') }}/${userId}`, {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(
                                    data); // Debug kiểm tra phản hồi từ server
                                    if (data.success) {
                                        Swal.fire("Đã xóa!", "Người dùng đã bị xóa.",
                                            "success");
                                        document.getElementById(`user-row-${userId}`)
                                            .remove();
                                    } else {
                                        Swal.fire("Lỗi!", data.message ||
                                            "Không thể xóa người dùng.", "error");
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                    Swal.fire("Lỗi!",
                                        "Đã xảy ra lỗi khi gửi yêu cầu xóa.",
                                        "error");
                                });

                            }
                    });
                });
            });

            // Xử lý sự kiện THAY ĐỔI VAI TRÒ bằng SweetAlert2 + AJAX 
            document.querySelectorAll('.role-select').forEach(select => {
                select.addEventListener('change', function() {
                    let userId = this.getAttribute('data-user-id');
                    let newRoleId = this.value;
                    let oldRoleId = this.getAttribute('data-old-role');

                    Swal.fire({
                        title: "Xác nhận thay đổi?",
                        text: "Bạn có chắc chắn muốn thay đổi vai trò của người dùng này?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('users.updateRole') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        role_id: newRoleId
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.message ===
                                        "Cập nhật vai trò thành công!") {
                                        Swal.fire("Thành công!",
                                            "Vai trò đã được cập nhật.", "success");
                                        if (newRoleId == 3 || newRoleId == 4) {
                                            document.getElementById(
                                                    `user-row-${userId}`).style
                                                .display = "none";
                                        }
                                        select.setAttribute('data-old-role', newRoleId);
                                    } else {
                                        Swal.fire("Lỗi!", data.message, "error");
                                        select.value = oldRoleId;
                                    }
                                }).catch(error => {
                                    Swal.fire("Lỗi!", "Không thể thay đổi vai trò.",
                                        "error");
                                    select.value = oldRoleId;
                                });
                        } else {
                            select.value = oldRoleId;
                        }
                    });
                });
            });
        });
    </script>
@endsection
