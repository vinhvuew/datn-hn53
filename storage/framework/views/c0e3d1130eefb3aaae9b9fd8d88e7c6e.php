<?php $__env->startSection('title'); ?>
    Liên hệ quản trị viên
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/chat.css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div id="app">
            <div class="container mb-3">
                <div class="text-primary">
                    <h1 class="text-primary fw-bold">Liên Hệ Quản Trị Viên</h1>
                </div>
                <!-- Hiển thị trạng thái người dùng -->
                <div class="status mt-2">
                    <b>Trạng thái: <span id="user-status">Đang kiểm tra...</span></b>
                </div>
                <hr>
                <div id="message-box" style="height: 400px; overflow-y: auto; background-color: #ffff; padding: 10px;">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2): ?>
                            <?php if(Auth::user()->id === $item->sender_id): ?>
                                <div class="message sent">
                                    <strong>Bạn: </strong><?php echo e($item->message); ?>

                                </div>
                            <?php else: ?>
                                <div class="message received">
                                    <strong>Shop: </strong><?php echo e($item->message); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(Auth::user()->role_id == 3): ?>
                            <?php if(Auth::user()->id === $item->sender_id): ?>
                                <div class="message sent">
                                    <strong>Bạn: </strong><?php echo e($item->message); ?>

                                </div>
                            <?php else: ?>
                                <div class="message received">
                                    <strong>Quảng trị viên: </strong><?php echo e($item->message); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Form gửi tin nhắn -->
                <div class="input-box mt-2">
                    <textarea class="form-control" id="message-input" placeholder="Nhập tin nhắn..." rows="3"></textarea>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <button class="btn btn-primary" id="send-message-btn">Gửi</button>
                        <form action="<?php echo e(route('outChat', $roomId)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Thoát cuộc trò chuyện</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <script>
        let userId = <?php echo e(auth()->id()); ?>;
        let receiverId = <?php echo e($receiverId); ?>;
        let roomId = <?php echo e($roomId); ?>;
        let roleId = <?php echo e(auth()->user()->role_id); ?>;
        // console.log(roleId)
    </script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/present.js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/chat/room.blade.php ENDPATH**/ ?>