<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
    <div class="container mt-4">
        <div id="alert-container"></div> 

        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Quản Lý Người Dùng</h5>
            </div>
            <div class="card-body">
=======

    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header text-white">
                <h5 class="mb-0">Quản Lý Người Dùng</h5>
            </div>
            <div class="card-body">

                <!-- Hiển thị thông báo thành công -->
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Hiển thị lỗi nếu có -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
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
                                <tr>
                                    <td class="text-center align-middle"><?php echo e($user->id); ?></td>
                                    <td class="align-middle"><?php echo e($user->name); ?></td>
<<<<<<< HEAD
                                    <td class="align-middle"><?php echo e($user->email ?? '-'); ?></td>
                                    <td class="align-middle"><?php echo e($user->phone ?? '-'); ?></td>
                                    <td class="align-middle">
                                        <select name="role" class="form-select form-select-sm role-select"
                                            data-user-id="<?php echo e($user->id); ?>"
                                            data-old-role="<?php echo e($user->role); ?>">
                                            <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User</option>
                                            <option value="moderator" <?php echo e($user->role == 'moderator' ? 'selected' : ''); ?>>Moderator</option>
                                            <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                        </select>
                                    </td>
                                    <td class="text-center align-middle">
                                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST"
                                            class="d-inline" onsubmit="return confirmDelete(event, '<?php echo e($user->name); ?>')">
=======
                                    <td class="align-middle"><?php echo e($user->email); ?></td>
                                    <td class="align-middle"><?php echo e($user->phone); ?></td>
                                    <td class="align-middle"><?php echo e($user->role); ?></td>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST"
                                            class="d-inline" onsubmit="return confirmDelete()">
>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">
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

<<<<<<< HEAD
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
                let token = "<?php echo e(csrf_token()); ?>";

                if (!confirm("Bạn có chắc chắn muốn thay đổi vai trò?")) {
                    selectElement.val(oldRole);
                    return;
                }

                $.ajax({
                    url: "<?php echo e(route('users.updateRole')); ?>",
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
=======
    <script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa người dùng này?');
        }
    </script>


>>>>>>> 07e8e7158f77a68db8f04b241cf0796e284dc9fd
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/users/index.blade.php ENDPATH**/ ?>