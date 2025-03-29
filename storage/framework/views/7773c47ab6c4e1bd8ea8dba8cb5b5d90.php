<?php $__env->startSection('order', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <div class="content-wrapper" style="padding: 1px 0 250px;">
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="user-profile-header-banner">
                                <img src="<?php echo e(asset('admin')); ?>/assets/img/pages/profile-banner.png" alt="Banner image"
                                    class="rounded-top">
                            </div>
                            <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-4">
                                <form action="<?php echo e(route('profile.updateAvatar')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <div class="position-relative d-inline-block">
                                        <img src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>" alt="user image"
                                            class="d-block rounded-circle user-profile-img"
                                            style="width: 100px; height: 100px; object-fit: cover;">


                                        <label for="avatar-upload"
                                            class="position-absolute bottom-0 end-0 bg-white p-1 rounded-circle shadow"
                                            style="cursor: pointer;">
                                            <i class="fas fa-camera text-primary"></i>
                                        </label>
                                        <input type="file" id="avatar-upload" name="avatar" class="d-none"
                                            onchange="this.form.submit()">
                                    </div>
                                </form>
                                <div class="flex-grow-1 mt-3 mt-lg-5">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4><?php echo e(Auth::user()->name); ?></h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">

                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-invert-colors me-1 mdi-20px'></i>
                                                    <span class="fw-medium">
                                                        <?php switch(Auth::user()->role):
                                                            case ('user'): ?>
                                                                Thành viên
                                                            <?php break; ?>

                                                            <?php case ('admin'): ?>
                                                                Quản trị
                                                            <?php break; ?>

                                                            <?php case ('moderator'): ?>
                                                                Nhân viên
                                                            <?php break; ?>

                                                            <?php default: ?>
                                                                Không xác định
                                                        <?php endswitch; ?>
                                                    </span>
                                                </li>

                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-map-marker-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Việt Nam</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class='mdi mdi-calendar-blank-outline me-1 mdi-20px'></i>
                                                    <span class="fw-medium">Tham gia:
                                                        <?php echo e(Auth::user()->created_at->format('d/m/Y')); ?>

                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-warning text-dark fw-bold">
                                            <i class='mdi mdi-account-check-outline me-1'></i>Đã kết nối
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Header -->

                <?php echo $__env->make('client.users.profile.layouts.Navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- User Profile Content -->
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <!-- About User -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <small class="card-text text-uppercase">Thông tin</small>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-account-outline mdi-24px"></i><span class="fw-medium mx-2">Họ và
                                            tên: </span> <span><?php echo e(Auth::user()->name); ?></span>
                                    </li>

                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-star-outline mdi-24px"></i><span class="fw-medium mx-2">Vai
                                            trò:</span>
                                        <span>
                                            <?php switch(Auth::user()->role):
                                                case ('user'): ?>
                                                    Thành viên
                                                <?php break; ?>

                                                <?php case ('admin'): ?>
                                                    Quản trị
                                                <?php break; ?>

                                                <?php case ('moderator'): ?>
                                                    Nhân viên
                                                <?php break; ?>

                                                <?php default: ?>
                                                    Không xác định
                                            <?php endswitch; ?>
                                        </span>
                                    </li>

                                    <li class="d-flex align-items-center mb-3">
                                        <i class='mdi mdi-map-marker-outline mdi-24px'></i>
                                        <span class="fw-medium mx-2">Địa chỉ:
                                        </span><span><?php echo e(Auth::user()->address); ?></span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3"><i class="mdi mdi-flag-outline mdi-24px"></i>
                                        <span class="fw-medium mx-2">Quốc
                                            gia:</span> <span>Việt Nam</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-1"><i
                                            class="mdi mdi-translate mdi-24px"></i><span class="fw-medium mx-2">Ngôn
                                            ngữ:</span> <span>Tiếng việt</span>
                                    </li>
                                </ul>
                                <small class="card-text text-uppercase">Liên hệ</small>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-3"><i
                                            class="mdi mdi-phone-outline mdi-24px"></i><span class="fw-medium mx-2">Liên
                                            hệ:</span> <span><?php echo e(Auth::user()->phone); ?></span></li>
                                    <li class="d-flex align-items-center mb-1"><i
                                            class="mdi mdi-email-outline mdi-24px"></i><span
                                            class="fw-medium mx-2">Email:</span>
                                        <span><?php echo e(Auth::user()->email); ?></span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!--/ About User -->
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <!-- Activity Timeline -->
                        <div class="card card-action mb-4">
                            <div class="card-header align-items-center">
                                <h5 class="card-action-title mb-0"><i
                                        class='mdi mdi-chart-timeline-variant mdi-24px me-2'></i>Hoạt
                                    động,
                                    Đơn hàng của tôi</h5>
                            </div>
                            <div class="card-body pt-3 pb-0">
                                <div class="col-xl-12 mb-5">
                                    <div class="list-group">
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="list-group-item">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5>Đơn hàng #<?php echo e($order->id); ?></h5>
                                                        <p>Ngày đặt: <?php echo e($order->order_date); ?></p>
                                                        <p>Trạng thái:
                                                            <span
                                                                class="badge
                                                                <?php switch($order->status):
                                                                    case ('pending'): ?> bg-warning text-dark <?php break; ?>
                                                                    <?php case ('confirmed'): ?> bg-secondary text-white <?php break; ?>
                                                                    <?php case ('shipping'): ?> bg-primary <?php break; ?>
                                                                    <?php case ('delivered'): ?> bg-success <?php break; ?>
                                                                    <?php case ('completed'): ?> bg-info <?php break; ?>
                                                                    <?php case ('canceled'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('admin_canceled'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('return_request'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('refuse_return'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('sent_information'): ?> bg-primary <?php break; ?>
                                                                    <?php case ('return_approved'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('returned_item_received'): ?> bg-danger <?php break; ?>
                                                                    <?php case ('refund_completed'): ?> bg-danger <?php break; ?>
                                                                    <?php default: ?> bg-secondary
                                                                <?php endswitch; ?>">
                                                                <?php echo e([
                                                                    'pending' => 'Chờ xác nhận',
                                                                    'confirmed' => 'Xác nhận',
                                                                    'shipping' => 'Chờ giao hàng',
                                                                    'delivered' => 'Đang giao hàng',
                                                                    'completed' => 'Giao hàng thành công',
                                                                    'canceled' => 'Người mua đã hủy',
                                                                    'admin_canceled' => 'Đã hủy bởi' . Auth::user()->name,
                                                                    'return_request' => 'Yêu cầu trả hàng',
                                                                    'refuse_return' => 'Từ chối trả hàng',
                                                                    'sent_information' => 'Thông tin hoàn tiền',
                                                                    'return_approved' => 'Chấp nhận trả hàng',
                                                                    'returned_item_received' => 'Đã nhận được hàng trả lại',
                                                                    'refund_completed' => 'Hoàn tiền thành công',
                                                                ][$order->status] ?? 'Không rõ'); ?>

                                                            </span>
                                                        </p>
                                                        <p>Tổng tiền:
                                                            <strong><?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                                                                VNĐ</strong>
                                                        </p>
                                                    </div>

                                                    <button class="btn btn-label-warning toggle-details">
                                                        <a class=""
                                                            href="<?php echo e(route('profile.detailOrder', $order->id)); ?>">Xem chi
                                                            tiết
                                                        </a>
                                                    </button>
                                                    
                                                </div>

                                                <!-- Danh sách sản phẩm trong đơn hàng -->
                                                <div class="collapse mt-3" id="orderDetails<?php echo e($order->id); ?>">
                                                    <ul class="list-group">
                                                        <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <?php if($detail->variant): ?>
                                                                    <!-- Trường hợp có biến thể -->

                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <img src="<?php echo e(Storage::url($detail->variant->image ?? $detail->product->image)); ?>"
                                                                            alt="<?php echo e($detail->product->name ?? 'Không có tên sản phẩm'); ?>"
                                                                            width="70" height="100"
                                                                            class="me-3 rounded shadow-sm">

                                                                        <div>
                                                                            <strong
                                                                                class="text-primary"><?php echo e($detail->product_name ?? 'Không có tên sản phẩm'); ?></strong>
                                                                            <p class="mb-1">
                                                                                💰 Giá:
                                                                                <strong><?php echo e(number_format($detail->price, 0, ',', '.')); ?>

                                                                                    VNĐ</strong>
                                                                                (Số lượng: <?php echo e($detail->quantity); ?>)
                                                                            </p>

                                                                            <!-- Hiển thị biến thể -->
                                                                            <p class="mb-1"><strong>🎨 Biến thể:</strong>
                                                                            </p>
                                                                            <ul class="list-unstyled ps-3">
                                                                                <?php $__currentLoopData = $detail->variant->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variantAttribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <li><i
                                                                                            class="bi bi-arrow-right-circle"></i>
                                                                                        <strong><?php echo e($variantAttribute->attribute->name ?? 'Không xác định'); ?>:</strong>
                                                                                        <?php echo e($variantAttribute->attributeValue->value ?? 'Không xác định'); ?>

                                                                                    </li>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </ul>

                                                                        </div>

                                                                    </div>
                                                                <?php elseif($detail->product): ?>
                                                                    <!-- Trường hợp không có biến thể, chỉ có sản phẩm -->
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <img src="<?php echo e(Storage::url($detail->product->img_thumbnail)); ?>"
                                                                            alt="<?php echo e($detail->product->name); ?>"
                                                                            width="70" height="70"
                                                                            class="me-3 rounded shadow-sm">

                                                                        <div>
                                                                            <strong
                                                                                class="text-dark"><?php echo e($detail->product_name); ?></strong>
                                                                            <p class="mb-1">
                                                                                💰 Giá:
                                                                                <strong><?php echo e(number_format($detail->price, 0, ',', '.')); ?>

                                                                                    VNĐ</strong>
                                                                                (Số lượng: <?php echo e($detail->quantity); ?>)
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <span>Sản phẩm không xác định</span>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </ul>
                                                </div>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!--/ Activity Timeline -->
                    </div>
                </div>
                <!--/ User Profile Content -->
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-details").forEach(button => {
            button.addEventListener("click", function() {
                const targetId = this.getAttribute("data-target");
                const targetDiv = document.querySelector(targetId);
                targetDiv.classList.toggle("show");
            });
        });
    });
</script>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/users/profile/order.blade.php ENDPATH**/ ?>