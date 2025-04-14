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
            duration: 1000,
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
        duration: 1000, // Thời gian hiển thị (ms)
        position: {
            x: 'right',
            y: 'top'
        }, // Vị trí thông báo
    });
</script>
<script>
    window.Echo.channel('orders')
        .listen('OrderStatusUpdated', (e) => {
            const badge = document.getElementById(`order-status-${e.order_id}`);
            if (!badge) return;

            // Mapping trạng thái → tên hiển thị và class màu
            const statusMap = {
                pending: {
                    text: 'Chờ xác nhận',
                    class: 'bg-warning text-dark'
                },
                confirmed: {
                    text: 'Xác nhận',
                    class: 'bg-secondary text-white'
                },
                shipping: {
                    text: 'Chờ giao hàng',
                    class: 'bg-primary'
                },
                delivered: {
                    text: 'Đang giao hàng',
                    class: 'bg-success'
                },
                completed: {
                    text: 'Giao hàng thành công',
                    class: 'bg-info'
                },
                canceled: {
                    text: 'Người mua đã hủy',
                    class: 'bg-danger'
                },
                admin_canceled: {
                    text: 'Đã hủy bởi ' + e.updated_by,
                    class: 'bg-danger'
                },
                return_request: {
                    text: 'Yêu cầu trả hàng',
                    class: 'bg-danger'
                },
                refuse_return: {
                    text: 'Từ chối trả hàng',
                    class: 'bg-danger'
                },
                sent_information: {
                    text: 'Thông tin hoàn tiền',
                    class: 'bg-primary'
                },
                return_approved: {
                    text: 'Chấp nhận trả hàng',
                    class: 'bg-danger'
                },
                returned_item_received: {
                    text: 'Đã nhận được hàng trả lại',
                    class: 'bg-danger'
                },
                refund_completed: {
                    text: 'Hoàn tiền thành công',
                    class: 'bg-danger'
                },
            };

            const status = statusMap[e.new_status] ?? {
                text: 'Không rõ',
                class: 'bg-secondary'
            };

            // Cập nhật text và class
            badge.textContent = status.text;
            badge.className = 'badge ' + status.class;
        });
</script>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/layouts/parials/js.blade.php ENDPATH**/ ?>