<?php $__env->startSection('content'); ?>
    <main>
        <div class="content-wrapper" style="padding: 1px 0 250px;">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h3 class="text-center mb-4">Yêu cầu trả hàng hàng / Hoàn tiền</h3>
                <form action="<?php echo e(route('profile.refundRequests')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-12 col-md-12">
                        <table class="datatables-order-details table">
                            <thead>
                                <tr>
                                    <th class="w-50">Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->product): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="avatar me-2 pe-1">
                                                        <?php if($item->product->img_thumbnail): ?>
                                                            <img src="<?php echo e(Storage::url($item->product->img_thumbnail)); ?>"
                                                                width="50px" alt="">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('images/default-thumbnail.png')); ?>"
                                                                width="50px" alt="Default Image">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <span><?php echo e($item->product_name); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo e(number_format($item->price, 0, ',', '.')); ?> VND</td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e(number_format($item->total_price, 0, ',', '.')); ?> VND</td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center mb-1">
                                                    <div class="avatar me-2 pe-1">
                                                        <?php if($item->variant && $item->variant->product->img_thumbnail): ?>
                                                            <img class="rounded-2"
                                                                src="<?php echo e(Storage::url($item->variant->product->img_thumbnail)); ?>"
                                                                width="50px" alt="">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('images/default-thumbnail.png')); ?>"
                                                                width="50px" alt="Default Image">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <span><?php echo e($item->product_name); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                                    $attributes = explode(' - ', $item->variant_attribute);
                                                    $values = explode(' - ', $item->variant_value);
                                                ?>
                                                <span class="block text-sm text-gray-700">
                                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($attribute); ?>: <?php echo e($values[$index] ?? ''); ?>

                                                        <?php if(!$loop->last): ?>
                                                            |
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </span>
                                            </td>
                                            <td><?php echo e(number_format($item->price, 0, ',', '.')); ?> VND</td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e(number_format($item->total_price, 0, ',', '.')); ?> VND</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">


                        <div class="col-12 col-md-6">
                            <label for="reason" class="mb-1 mt-2">Lý do</label>
                            <select class="form-select" name="reason">
                                <option selected disabled>Lý do hoàn tiền</option>
                                <option value="Thiếu hàng">Thiếu hàng</option>
                                <option value="Hàng lỗi">Hàng lỗi</option>
                                <option value="Khác với mô tả">Khác với mô tả</option>
                            </select>
                        </div>
                        <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-12 col-md-6">
                            <label for="total_amount" class="mb-1 mt-2">Số tiền hoàn lại</label>
                            <input type="text" class="form-control"
                                value="<?php echo e(number_format($item->order->total_price, 0, ',', '.')); ?> VNĐ" disabled>
                            <input type="hidden" name="total_amount" value="<?php echo e($item->order->total_price); ?>">
                        </div>
                        <?php $__errorArgs = ['total_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-12 col-md-12">
                            <label for="refund_on" class="mb-1 mt-2">Hoàn tiền vào ( Ngân Hàng/STK/Chủ Tài Khoản )</label>
                            <input type="text" name="refund_on" class="form-control"
                                placeholder="VÍ DỤ: MBBANK/0345961416/LÝ TRUNG ĐỨC" value="<?php echo e(old('refund_on')); ?>" />
                        </div>
                        <?php $__errorArgs = ['refund_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-12 col-md-12">
                            <label for="note" class="mb-1 mt-2">Mô tả</label>
                            <textarea name="note" cols="30" rows="1" class="form-control" placeholder="Lý do chi tiết"></textarea>
                        </div>
                        <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-12 col-md-6">
                            <label for="note" class="mb-1 mt-2">Ảnh chứng minh</label>
                            <input type="file" name="proveRufund[image][]" class="form-control" multiple />
                        </div>
                        <?php if($errors->has('proveRufund.image.*')): ?>
                            <div class="text-danger">
                                <?php $__currentLoopData = $errors->get('proveRufund.image.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 col-md-6">
                            <label for="note" class="mb-1 mt-2">Video chứng minh</label>
                            <input type="file" name="proveRufund[video][]" class="form-control" multiple />
                        </div>
                        <?php if($errors->has('proveRufund.video.*')): ?>
                            <div class="text-danger">
                                <?php $__currentLoopData = $errors->get('proveRufund.video.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 col-md-12">
                            <label for="Email" class="mb-1 mt-2">Email</label>
                            <input type="email"name="email" class="form-control" placeholder="Email"
                                value="<?php echo e($item->order->user->email); ?>" />
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-12 text-center mt-3">
                            <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi Yêu Cầu</button>
                            <a href="<?php echo e(route('profile.detailOrder', $order->id)); ?>" class="btn btn-outline-secondary">Hủy
                                bỏ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/pages/page-profile.css" />
    <style>
        a {
            color: #4C5671;
        }

        .rts-header__menu ul li a {
            color: #000000;
        }

        .rts-header__right .login__btn {
            border: 1px solid #000000;
            color: #000000;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #9055fd;
            color: #fff;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/users/refund/refund.blade.php ENDPATH**/ ?>