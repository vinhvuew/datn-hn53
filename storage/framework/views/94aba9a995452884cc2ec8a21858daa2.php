<?php $__env->startSection('item-order', 'active'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2">
            <span class="text-muted fw-light">Đơn hàng /</span> Danh sách đơn hàng
        </h4>
        <div class="card mb-3">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2"><?php echo e($pending); ?></h3>
                                    <p class="mb-0">Chờ xác nhận</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'pending'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-hourglass bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2"><?php echo e($confirmed); ?></h3>
                                    <p class="mb-0">Đã xác nhận</p>
                                </div>
                                <div class="avatar me-lg-4">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'confirmed'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-circle bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h3 class="mb-2"><?php echo e($shipping); ?></h3>
                                    <p class="mb-0">Chờ giao hàng</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'shipping'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bxs-truck bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-2"><?php echo e($delivered); ?></h3>
                                    <p class="mb-0">Đang giao hàng</p>
                                </div>
                                <div class="avatar">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'delivered'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-package bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2"><?php echo e($payment_status); ?></h3>
                                    <p class="mb-0">Chờ thanh toán</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="<?php echo e(route('orders.index', ['payment_status' => 'Chờ thanh toán'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-credit-card bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-2"><?php echo e($order_confirmation); ?></h3>
                                    <p class="mb-0">Hoàn thành</p>
                                </div>
                                <div class="avatar me-lg-4">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'order_confirmation'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-double bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h3 class="mb-2"><?php echo e($refund); ?></h3>
                                    <p class="mb-0">Hoàn hàng</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'refund_completed'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-refresh bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-2"><?php echo e($canceled); ?></h3>
                                    <p class="mb-0">Đã hủy</p>
                                </div>
                                <div class="avatar">
                                    <a href="<?php echo e(route('orders.index', ['status' => 'canceled'])); ?>">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-x-circle bx-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="<?php echo e(route('orders.updateStatus')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-2 d-flex gap-3 justify-content-between">
                <!-- Nút xử lý ẩn ban đầu -->
                <div>
                    <select name="status" class="form-select w-auto d-none">
                        <?php if(request('status') == 'pending'): ?>
                            <option value="confirmed">Xác nhận</option>
                        <?php endif; ?>
                        <?php if(request('status') == 'confirmed'): ?>
                            <option value="shipping">Chờ giao hàng</option>
                        <?php endif; ?>
                        <?php if(request('status') == 'shipping'): ?>
                            <option value="delivered">Đang giao hàng</option>
                        <?php endif; ?>
                    </select>

                    <!-- Nút submit sẽ ẩn/hiện bằng JavaScript -->
                    <?php
                        $status = request('status');
                    ?>

                    <?php if(in_array($status, ['pending', 'confirmed', 'shipping'])): ?>
                        <button id="bulkActionBtn" type="submit" class="btn btn-primary btn-sm d-none">
                            <i class="bx bx-check-double me-1"></i> Xử lý đơn đã chọn
                        </button>
                    <?php endif; ?>

                </div>
                <div>
                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-primary btn-sm">
                        <i class="bx bx-list-ul"></i> Tất cả
                    </a>
                    <?php if(request('status') || request('payment_status')): ?>
                        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="bx bx-x"></i> Xóa lọc
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example"
                        class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <?php if(in_array($status, ['pending', 'confirmed', 'shipping'])): ?>
                                    <th>
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                <?php endif; ?>
                                <th>Tên khách hàng</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>ORDER_<?php echo e($order->id); ?></td>
                                    <?php if(in_array($status, ['pending', 'confirmed', 'shipping'])): ?>
                                        <td>
                                            <input type="checkbox" class="order-checkbox" name="order_id[]"
                                                value="<?php echo e($order->id); ?>">
                                        </td>
                                    <?php endif; ?>
                                    <td><?php echo e($order->user->name); ?></td>
                                    <td>
                                        <span
                                            class="badge
                                        <?php switch($order->payment_method):
                                            case ('COD'): ?> bg-warning text-dark <?php break; ?>
                                            <?php case ('VNPAY_DECOD'): ?> bg-info text-white <?php break; ?>
                                            <?php case ('MOMO'): ?> bg-success <?php break; ?>
                                            <?php default: ?> bg-secondary
                                        <?php endswitch; ?>">
                                            <?php echo e([
                                                'COD' => 'COD',
                                                'VNPAY_DECOD' => 'VNPAY_DECOD',
                                                'MOMO' => 'MOMO',
                                            ][$order->payment_method] ?? 'Không rõ'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span id="order-status-<?php echo e($order->id); ?>"
                                            class="badge
                                            <?php switch($order->status):
                                                case ('pending'): ?> bg-warning text-dark <?php break; ?>
                                                <?php case ('confirmed'): ?> bg-secondary text-white <?php break; ?>
                                                <?php case ('shipping'): ?> bg-primary <?php break; ?>
                                                <?php case ('delivered'): ?> bg-success <?php break; ?>
                                                <?php case ('completed'): ?> bg-info <?php break; ?>
                                                <?php case ('received'): ?> bg-info <?php break; ?>
                                                <?php case ('order_confirmation'): ?> bg-success <?php break; ?>
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
                                                'received' => 'Đã nhận hàng',
                                                'order_confirmation' => 'Hoàn thành',
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
                                    </td>
                                    <td><?php echo e(number_format($order->total_price, 0, ',', '.')); ?> VNĐ</td>
                                    <td><?php echo e(\Carbon\Carbon::parse($order->order_date)->format('d/m/Y')); ?></td>
                                    <td>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem Chi Tiết"
                                            class="btn btn-info btn-sm me-1"
                                            href="<?php echo e(route('orders.show', $order->id)); ?>">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.parials.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>