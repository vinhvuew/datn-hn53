<?php $__env->startSection('content'); ?>
<main class="bg_gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="confirm">
                    <div class="icon icon--order-success svg add_bottom_15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                            </g>
                        </svg>
                    </div>
                    <h2>Đặt hàng thành công!</h2>
                    <p>Cảm ơn bạn đã mua hàng tại Legend Shoes!</p>
                    <p>Chúng tôi sẽ gửi email xác nhận đơn hàng cho bạn.</p>
                    <div class="buttons">
                        <a href="/" class="btn_1">Tiếp tục mua sắm</a>
                        <a href="/profile/myOder" class="btn_1 outline">Xem đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
<style>
    #confirm {
        text-align: center;
        padding: 60px 0;
    }
    #confirm h2 {
        margin-bottom: 25px;
    }
    #confirm .buttons {
        margin-top: 30px;
    }
    #confirm .buttons .btn_1 {
        margin: 0 10px;
    }
    .icon--order-success svg path {
        animation: checkmark 0.25s ease-in-out 0.7s backwards;
    }
    .icon--order-success svg circle {
        animation: checkmark-circle 0.6s ease-in-out backwards;
    }
    @keyframes checkmark {
        0% {
            stroke-dashoffset: 50px;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
    @keyframes checkmark-circle {
        0% {
            stroke-dashoffset: 240px;
        }
        100% {
            stroke-dashoffset: 480px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/checkout/complete.blade.php ENDPATH**/ ?>