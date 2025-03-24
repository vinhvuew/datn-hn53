<?php $__env->startSection('content'); ?>

<div class="cart">
    <h3 class="text-center"><br>Quản Lý Ảnh</h3>

    <div class="cart-boby">
        
           <a href="<?php echo e(route('image.create')); ?>" class="btn btn-success" >Thêm Ảnh</a>

        <table class="table table-striped tab-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Chỉnh Sửa</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $listImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($image->id); ?></td>
                        <td>
                            <img src="<?php echo e(Storage::url($image->img)); ?>" alt="Image" width="100px" height="100px">

                        </td>
                       
                       <td><?php echo e($image->created_at->format('d/m/Y h:i:s')); ?></td>
                     
                        
                        <td><?php echo e($image->updated_at->format('d/m/Y h:i:s')); ?></td>
                        <td>
                            
                            <a href="" class="btn btn-warning">Sửa</a>
                            <a href="" class="btn btn-danger">Xóa</a>
                           
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/image/index.blade.php ENDPATH**/ ?>