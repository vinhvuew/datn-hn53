<?php $__env->startSection('content'); ?>
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <h1>Cart page</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>VARIANT</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>  
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('storage/' . $cart->product->image)); ?>" width="50">
                            </td>
                            <td><?php echo e($cart->product->name); ?></td>
                            <td><?php echo e($cart->variant->name ?? 'N/A'); ?></td>
                            <td>
                                <form action="<?php echo e(route('cart.updateQuantity', $cart->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" name="quantity" value="<?php echo e($cart->quantity - 1); ?>" class="btn btn-sm btn-outline-secondary">-</button>
                                    <span class="px-2"><?php echo e($cart->quantity); ?></span>
                                    <button type="submit" name="quantity" value="<?php echo e($cart->quantity + 1); ?>" class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </td>
                            <td>$<?php echo e(number_format($cart->total_price, 2)); ?></td>
                            <td>
                                <form action="<?php echo e(route('cart.destroy', $cart->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/cart/index.blade.php ENDPATH**/ ?>