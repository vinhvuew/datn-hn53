<?php $__env->startSection('style-libs'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
    <script>
        const checkboxes = document.querySelectorAll('.order-checkbox');
        const actionBtn = document.getElementById('bulkActionBtn');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                const anyChecked = Array.from(checkboxes).some(c => c.checked);
                actionBtn.classList.toggle('d-none', !anyChecked);
            });
        });

        // Nếu có checkbox "Chọn tất cả"
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.addEventListener('change', () => {
                checkboxes.forEach(cb => cb.checked = checkAll.checked);

                const anyChecked = Array.from(checkboxes).some(c => c.checked);
                actionBtn.classList.toggle('d-none', !anyChecked);
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/layouts/parials/datatable.blade.php ENDPATH**/ ?>