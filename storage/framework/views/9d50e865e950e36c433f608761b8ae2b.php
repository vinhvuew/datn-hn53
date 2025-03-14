<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        
        <h1 class="text-center mb-4">Quản Lý Bình Luận</h1>

       <a href="<?php echo e(route('comment.create')); ?>" class="btn btn-success" >Các Nội Dung Vi Phạm Cộng Đồng</a> 

        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
   
   
        <div class="table-responsive my-3">
            <table class="table table-bordered table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Người Dùng </th>
                        <th scope="col">parent_id</th>
                        <th scope="col">Mã Sản Phẩm</th>
                        <th scope="col">Biến Thể</th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Thời gian tạo</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Chức Năng</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e($value->user_id); ?></td>
                            <td><?php echo e($value->parent_id); ?></td>
                            <td><?php echo e($value->product_id); ?></td>
                            <td><?php echo e($value->variant_id); ?></td>
                            <td><?php echo e($value->content); ?></td>
                            <td><?php echo e($value->created_at); ?></td>
                            <td><?php echo e($value->updated_at); ?></td>
                           
                            <td>

                                <div class="d-flex justify-content-center">
                                
                                    <form action="<?php echo e(route('comment.destroy', $value->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">
                                            Xóa
                                        </button>
                                    </form> 
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/admin/comment/index.blade.php ENDPATH**/ ?>