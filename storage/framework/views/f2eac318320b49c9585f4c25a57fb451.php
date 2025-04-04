<?php $__env->startSection('content'); ?>
<main class="bg_gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div id="confirm">
                    <div class="icon icon--order-success svg add_bottom_15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72">
                            <!-- Nền đỏ -->
                            <rect width="72" height="72" fill="#D32F2F" rx="36" />
                            <!-- Dấu X -->
                            <g stroke="#FFF" stroke-width="6" stroke-linecap="round">
                                <line x1="20" y1="20" x2="52" y2="52" />
                                <line x1="52" y1="20" x2="20" y2="52" />
                            </g>
                        </svg>
                        
                    </div>
                <h2>Thanh toán thất bại!</h2>
                <p>Vui lòng thanh toán sớm nhất có thể !</p>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/datn-hn53/resources/views/client/checkout/failed.blade.php ENDPATH**/ ?>