@extends('admin.layouts.master')

@section('title')
    Vai trò người dùng
@endsection
@section('item-user')
    open
@endsection

@section('user-role')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">Danh sách vai trò</h4>
        <p class="mb-4">Một vai trò cung cấp quyền truy cập vào các menu và tính năng được xác định trước để tùy thuộc vào
            vai trò được chỉ định,
            quản trị viên có thể truy cập vào những gì người dùng cần.</p>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach ($roles as $item)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0">Tổng cộng {{ $item->users->count() }} người dùng</p>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($item->users as $user)
                                        @if ($item->name == 'Admin')
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $user->name }}" class="avatar pull-up">
                                                @if ($user->avatar == null)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('admin') }}/assets/img/avatars/1.png" alt="Avatar">
                                                @else
                                                    <img class="rounded-circle" src="{{ Storage::url($user->avatar) }}"
                                                        alt="Avatar">
                                                @endif
                                            </li>
                                        @else
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $user->name }}" class="avatar pull-up">
                                                @if ($user->avatar == null)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('admin') }}/assets/img/avatars/1.png" alt="Avatar">
                                                @else
                                                    <img class="rounded-circle" src="{{ Storage::url($user->avatar) }}"
                                                        alt="Avatar">
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    @if ($item->name == 'Admin')
                                        <h5 class="mb-1">Quản Trị Viên</h5>
                                    @elseif($item->name == 'Staff')
                                        <h5 class="mb-1">Nhân Viên</h5>
                                    @elseif($item->name == 'Accountant')
                                        <h5 class="mb-1">Kế Toán</h5>
                                    @elseif($item->name == 'Editor')
                                        <h5 class="mb-1">Biên Tập Viên</h5>
                                    @endif
                                    @if ($item->name == 'Admin')
                                        <a href="javascript:;" class="role-edit-modal">
                                            <span class="disabled">Có tất cả quyền</span>
                                        </a>
                                    @else
                                        @if ($item->users->count() === 0)
                                            <a href="javascript:;" data-id="{{ $item->id }}" class="role-edit-modal">
                                                <span>Không có người dùng</span>
                                            </a>
                                        @else
                                            <a href="{{ route('permissions.access', $item->id) }}"
                                                data-id="{{ $item->id }}" class="role-edit-modal">
                                                <span>Chỉnh sửa quyền truy cập</span>
                                            </a>
                                        @endif
                                    @endif

                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i
                                        class="mdi mdi-content-copy mdi-20px"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-5">
                            <div class="d-flex align-items-end h-100 justify-content-center">
                                <img src="{{ asset('admin') }}/assets/img/illustrations/man-with-laptop-light.png"
                                    class="img-fluid" alt="Image" width="90">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="{{ route('permissions.create') }}"
                                    class="btn btn-primary mb-3 text-nowrap add-new-role">
                                    Thêm vai trò</a>
                                <p class="mb-0">Thêm vai trò, nếu nó không tồn tại</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <h4 class="fw-medium mb-1 mt-5">Tổng số người dùng có vai trò của họ</h4>
            <p class="mb-0 mt-1">Tìm tất cả tài khoản quản trị viên của công ty bạn và vai trò liên kết của họ.</p>

            <div class="col-12">
                <!-- Role Table -->
                <div class="card">
                    <div class="card-body">
                        <table id="example"
                            class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $value)
                                    @foreach ($value->users as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->role_id == 1)
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="bx bx-laptop text-danger me-2"></i>
                                                        {{ $item->role->name }}
                                                    </span>
                                                @elseif ($item->role_id == 2)
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="bx bx-user text-danger me-2"></i>
                                                        {{ $item->role->name }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="mdi mdi-account-outline text-danger me-2"></i>
                                                        {{ $item->role->name }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-content-center">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem"
                                                        class="btn btn-info btn-sm me-1"
                                                        href="{{ route('permissions.edit', $value->id) }}">
                                                        <i class="bx bxs-show"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $value->id }}"
                                                        action="{{ route('permissions.destroy', $value->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-title="Xóa"
                                                            class="btn btn-danger btn-sm me-1"
                                                            onclick="confirmDelete({{ $value->id }})">
                                                            <i class='bx bxs-trash'></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Role Table -->
            </div>
        </div>
        <!--/ Role cards -->

        <!--  Modal -->
        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">Thêm vai trò mới</h3>
                            <p>Thiết lập quyền vai trò</p>
                        </div>
                        <!-- Add role form -->
                        <form action="{{ route('permissions.updateGant') }}" id="addRoleForm" class="row g-3"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <h5>Quyền vai trò</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quyền truy cập của quản trị viên <i
                                                        class="mdi mdi-information-outline" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Cho phép truy cập đầy đủ vào hệ thống"></i></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll" />
                                                        <label class="form-check-label" for="selectAll">
                                                            Chọn tất cả
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quản lý người dùng</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @php
                                                            $category = [
                                                                'categories.index' => 'Xem',
                                                                'categories.create' => 'Thêm',
                                                                'categories.edit' => 'Sửa',
                                                            ];
                                                            $products = [
                                                                'products.index' => 'Xem',
                                                                'products.create' => 'Thêm',
                                                                'products.edit' => 'Sửa',
                                                            ];
                                                            $attribute = [
                                                                'attributes.index' => 'Xem',
                                                                'attributes.create' => 'Thêm',
                                                                'attributes.edit' => 'Sửa',
                                                            ];
                                                            $attribute_value = [
                                                                'attribute_values.index' => 'Xem',
                                                                'attribute_values.create' => 'Thêm',
                                                                'attribute_values.edit' => 'Sửa',
                                                            ];
                                                            $permissions = [
                                                                'permissions.index' => 'Xem',
                                                                'permissions.create' => 'Thêm',
                                                                'permissions.edit' => 'Sửa',
                                                            ];
                                                        @endphp

                                                        @foreach ($permissions as $slug => $label)
                                                            @if ($item->slug == $slug)
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" id="role_id"
                                                                        type="checkbox"
                                                                        {{ $item->roles->contains(1) ? 'checked' : '' }}
                                                                        name="permissions[][]"
                                                                        value="{{ $item->id }}" />
                                                                    <label class="form-check-label" for="permissions[]">
                                                                        {{ $label }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quản lý danh mục</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="dbManagementRead" />
                                                            <label class="form-check-label" for="dbManagementRead">
                                                                Đọc
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="dbManagementWrite" />
                                                            <label class="form-check-label" for="dbManagementWrite">
                                                                Viết
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="dbManagementCreate" />
                                                            <label class="form-check-label" for="dbManagementCreate">
                                                                Tạo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quản lý sản phẩm</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="finManagementRead" />
                                                            <label class="form-check-label" for="finManagementRead">
                                                                Đọc
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="finManagementWrite" />
                                                            <label class="form-check-label" for="finManagementWrite">
                                                                Viết
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="finManagementCreate" />
                                                            <label class="form-check-label" for="finManagementCreate">
                                                                Tạo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quản lý thuộc tính</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="reportingRead" />
                                                            <label class="form-check-label" for="reportingRead">
                                                                Đọc
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="reportingWrite" />
                                                            <label class="form-check-label" for="reportingWrite">
                                                                Viết
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="reportingCreate" />
                                                            <label class="form-check-label" for="reportingCreate">
                                                                Tạo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Xác Nhận</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Hủy bỏ</button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lắng nghe các nhấp chuột vào liên kết chỉnh sửa vai trò
            const editRoleLinks = document.querySelectorAll('.role-edit-modal');

            editRoleLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Lấy ID từ thuộc tính data-id
                    const roleId = this.getAttribute('data-id');

                    // Pass the ID into the modal
                    const roleModal = document.getElementById('addRoleModal');
                    const roleIdInput = roleModal.querySelector(
                        'input[id="role_id"]'); // Giả sử bạn có một đầu vào ẩn để giữ role_id

                    if (roleIdInput) {
                        // Cập nhật thuộc tính tên hộp kiểm một cách động
                        const checkboxes = roleModal.querySelectorAll('.form-check-input');
                        checkboxes.forEach(function(checkbox) {
                            checkbox.name = `permissions[${roleId}][]`;
                        });
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Hành động này sẽ xóa vĩnh viễn quyền!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <script src="{{ asset('themes') }}/admin/assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('themes') }}/admin/assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js">
    </script>
    <script src="{{ asset('themes') }}/admin/assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js">
    </script>
    <script src="{{ asset('themes') }}/admin/assets/js/app-access-roles.js"></script>
    <script src="{{ asset('themes') }}/admin/assets/js/modal-add-role.js"></script>
@endsection
