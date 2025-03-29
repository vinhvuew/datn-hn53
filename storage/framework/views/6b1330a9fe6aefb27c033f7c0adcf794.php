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
                <div class="card-header text-white d-flex justify-content-between align-items-center">
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
                                    <th>Địa Chỉ</th>
                                    <th>Vai Trò</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->role_id == 2): ?>
                                        
                                        <tr id="user-row-<?php echo e($user->id); ?>">
                                            <td class="text-center align-middle"><?php echo e($user->id); ?></td>
                                            <td class="align-middle"><?php echo e($user->name); ?></td>
                                            <td class="align-middle"><?php echo e($user->email ?? '-'); ?></td>
                                            <td class="align-middle"><?php echo e($user->phone ?? '-'); ?></td>
                                            <td class="align-middle"><?php echo e($user->address); ?></td>
                                            <td class="align-middle">
                                                <select name="role" class="form-select form-select-sm role-select"
                                                    data-user-id="<?php echo e($user->id); ?>"
                                                    data-old-role="<?php echo e($user->role_id); ?>">
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($role->id); ?>"
                                                            <?php echo e($user->role_id == $role->id ? 'selected' : ''); ?>>
                                                            <?php echo e($role->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                    <?php endif; ?>
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
                            fetch(`<?php echo e(route('users.destroy', '')); ?>/${userId}`, {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
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
                            fetch("<?php echo e(route('users.updateRole')); ?>", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/users/index.blade.php ENDPATH**/ ?>