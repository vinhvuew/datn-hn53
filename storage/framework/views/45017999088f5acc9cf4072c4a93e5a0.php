<?php $__env->startSection('title'); ?>
    Vai trò người dùng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('item-user'); ?>
    open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('user-role'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">Danh sách vai trò</h4>
        <p class="mb-4">Một vai trò cung cấp quyền truy cập vào các menu và tính năng được xác định trước để tùy thuộc vào
            vai trò được chỉ định,
            quản trị viên có thể truy cập vào những gì người dùng cần.</p>
        <!-- Role cards -->
        <div class="row g-4">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0">Tổng cộng <?php echo e($item->users->count()); ?> người dùng</p>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    <?php $__currentLoopData = $item->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->name == 'Admin'): ?>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="<?php echo e($user->name); ?>" class="avatar pull-up">
                                                <?php if($user->avatar == null): ?>
                                                    <img class="rounded-circle"
                                                        src="<?php echo e(asset('admin')); ?>/assets/img/avatars/1.png" alt="Avatar">
                                                <?php else: ?>
                                                    <img class="rounded-circle" src="<?php echo e(Storage::url($user->avatar)); ?>"
                                                        alt="Avatar">
                                                <?php endif; ?>
                                            </li>
                                        <?php else: ?>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="<?php echo e($user->name); ?>" class="avatar pull-up">
                                                <?php if($user->avatar == null): ?>
                                                    <img class="rounded-circle"
                                                        src="<?php echo e(asset('admin')); ?>/assets/img/avatars/1.png" alt="Avatar">
                                                <?php else: ?>
                                                    <img class="rounded-circle" src="<?php echo e(Storage::url($user->avatar)); ?>"
                                                        alt="Avatar">
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <?php if($item->name == 'Admin'): ?>
                                        <h5 class="mb-1">Quản Trị Viên</h5>
                                    <?php elseif($item->name == 'Staff'): ?>
                                        <h5 class="mb-1">Nhân Viên</h5>
                                        
                                        
                                    <?php endif; ?>
                                    <?php if($item->name == 'Admin'): ?>
                                        <a href="javascript:;" class="role-edit-modal">
                                            <span class="disabled">Có tất cả quyền</span>
                                        </a>
                                    <?php else: ?>
                                        <?php if($item->users->count() === 0): ?>
                                            <a href="javascript:;" data-id="<?php echo e($item->id); ?>" class="role-edit-modal">
                                                <span>Không có người dùng</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('permissions.access', $item->id)); ?>"
                                                data-id="<?php echo e($item->id); ?>" class="role-edit-modal">
                                                <span>Chỉnh sửa quyền truy cập</span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i
                                        class="mdi mdi-content-copy mdi-20px"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            

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
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $value->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->id); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->email); ?></td>

                                            <td>
                                                <?php if($item->role_id == 1): ?>
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="bx bx-laptop text-danger me-2"></i>
                                                        <?php echo e($item->role->name); ?>

                                                    </span>
                                                <?php elseif($item->role_id == 2): ?>
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="bx bx-user text-danger me-2"></i>
                                                        <?php echo e($item->role->name); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span
                                                        class="d-flex align-items-center text-heading justify-content-center">
                                                        <i class="mdi mdi-account-outline text-danger me-2"></i>
                                                        <?php echo e($item->role->name); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('style-libs'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
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

    <script src="<?php echo e(asset('themes')); ?>/admin/assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
    <script src="<?php echo e(asset('themes')); ?>/admin/assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js">
    </script>
    <script src="<?php echo e(asset('themes')); ?>/admin/assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js">
    </script>
    <script src="<?php echo e(asset('themes')); ?>/admin/assets/js/app-access-roles.js"></script>
    <script src="<?php echo e(asset('themes')); ?>/admin/assets/js/modal-add-role.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/admin/roles/index.blade.php ENDPATH**/ ?>