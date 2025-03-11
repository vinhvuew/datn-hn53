<!-- COMMON SCRIPTS -->
<script src="<?php echo e(asset('client')); ?>/js/common_scripts.min.js"></script>
<script src="<?php echo e(asset('client')); ?>/js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="<?php echo e(asset('client')); ?>/js/carousel-home.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notyf = new Notyf({
            duration: 3000,
            position: {
                x: 'right',
                y: 'top'
            },
            ripple: true,
        });

        <?php if(session('success')): ?>
            notyf.success('<?php echo e(session('success')); ?>');
        <?php endif; ?>

        <?php if(session('error')): ?>
            notyf.error('<?php echo e(session('error')); ?>');
        <?php endif; ?>
    });
</script>

<script>
    const notyf = new Notyf({
        duration: 3000, // Thời gian hiển thị (ms)
        position: {
            x: 'right',
            y: 'top'
        }, // Vị trí thông báo
    });
</script>
<?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/layouts/parials/js.blade.php ENDPATH**/ ?>