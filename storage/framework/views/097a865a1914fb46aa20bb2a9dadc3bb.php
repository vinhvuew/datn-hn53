<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="<?php echo e(asset('admin')); ?>/assets" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        𝕷𝖊𝖌𝖊𝖓𝖉 𝕾𝖍𝖔𝖕
    </title>

    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="<?php echo e(asset('client')); ?>/img/logo16x16.png"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <?php echo $__env->yieldContent('style-libs'); ?>

    <!-- Helpers -->
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/js/helpers.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/js/config.js"></script>
    <?php echo $__env->make('admin.layouts.parials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <?php echo $__env->make('admin.layouts.parials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <?php echo $__env->make('admin.layouts.parials.navBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <?php echo $__env->yieldContent('content'); ?>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php echo $__env->make('admin.layouts.parials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo e(asset('admin')); ?>/assets/js/main.js"></script>
    <?php echo $__env->make('admin.layouts.parials.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Page JS -->
    <?php echo $__env->yieldContent('script-libs'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\datn-hn53\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>