<?php $__env->startSection('item-user'); ?>
    open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('user-index'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="container mt-4">
            <div id="alert-container"></div>

            <div class="card shadow-sm border-0 rounded">
                <div class="card-header  text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quản Lý Người Dùng</h5>
                    <form action="<?php echo e(route('users.index')); ?>" method="GET" class="d-flex">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                            class="form-control form-control-sm me-2" placeholder="Nhập tên, email hoặc SĐT"
                            style="max-width: 250px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm me-2">🔍 Tìm kiếm</button>

                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-warning btn-sm">Quay Lại</a>
                        <?php endif; ?>
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
                                    <th>Vai Trò</th>
                                    <th class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="user-row-<?php echo e($user->id); ?>">
                                        <td class="text-center align-middle"><?php echo e($user->id); ?></td>
                                        <td class="align-middle"><?php echo e($user->name); ?></td>
                                        <td class="align-middle"><?php echo e($user->email ?? '-'); ?></td>
                                        <td class="align-middle"><?php echo e($user->phone ?? '-'); ?></td>
                                        <td class="align-middle">
                                            <select name="role" class="form-select form-select-sm role-select"
                                                data-user-id="<?php echo e($user->id); ?>" data-old-role="<?php echo e($user->role); ?>">
                                                <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User
                                                </option>
                                                <option value="moderator"
                                                    <?php echo e($user->role == 'moderator' ? 'selected' : ''); ?>>
                                                    Moderator</option>
                                                <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form class="delete-form d-inline" data-user-id="<?php echo e($user->id); ?>"
                                                data-user-name="<?php echo e($user->name); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm delete-user">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            // Xác nhận xóa user
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
                            fetch(`<?php echo e(route('users.destroy', '')); ?>/${userId}`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        _method: "DELETE"
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: "Đã xóa!",
                                        text: "Người dùng đã bị xóa thành công.",
                                        icon: "success"
                                    });
                                    document.getElementById(`user-row-${userId}`)
                                        .remove();
                                }).catch(error => {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Không thể xóa người dùng.",
                                        icon: "error"
                                    });
                                });
                        }
                    });
                });
            });

            // Xác nhận thay đổi vai trò
            document.querySelectorAll('.role-select').forEach(select => {
                select.addEventListener('change', function() {
                    let userId = this.getAttribute('data-user-id');
                    let newRole = this.value;
                    let oldRole = this.getAttribute('data-old-role');

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
                            fetch("<?php echo e(route('users.updateRole')); ?>", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        role: newRole
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: "Thành công!",
                                        text: "Vai trò đã được cập nhật.",
                                        icon: "success"
                                    });
                                    select.setAttribute('data-old-role', newRole);
                                }).catch(error => {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Không thể thay đổi vai trò.",
                                        icon: "error"
                                    });
                                    select.value = oldRole;
                                });
                        } else {
                            select.value = oldRole;
                        }
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/users/index.blade.php ENDPATH**/ ?>