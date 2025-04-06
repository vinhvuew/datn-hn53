<!-- Favicons-->
<link rel="shortcut icon" href="<?php echo e(asset('client')); ?>/img/logo16x16.png" type="image/x-icon">
<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo e(asset('client')); ?>/img/logo57x57.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo e(asset('client')); ?>/img/logo114x114.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo e(asset('client')); ?>/img/logo144x144.png">

<!-- GOOGLE WEB FONT -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap"
    as="fetch" crossorigin="anonymous">
<script>
    ! function(e, n, t) {
        "use strict";
        var o = "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap",
            r = "__3perf_googleFonts_c2536";

        function c(e) {
            (n.head || n.body).appendChild(e)
        }

        function a() {
            var e = n.createElement("link");
            e.href = o, e.rel = "stylesheet", c(e)
        }

        function f(e) {
            if (!n.getElementById(r)) {
                var t = n.createElement("style");
                t.id = r, c(t)
            }
            n.getElementById(r).innerHTML = e
        }
        e.FontFace && e.FontFace.prototype.hasOwnProperty("display") ? (t[r] && f(t[r]), fetch(o).then(function(e) {
            return e.text()
        }).then(function(e) {
            return e.replace(/@font-face {/g, "@font-face{font-display:swap;")
        }).then(function(e) {
            return t[r] = e
        }).then(f).catch(a)) : a()
    }(window, document, localStorage);
</script>

<!-- PRELOAD LARGE CONTENT -->
<link rel="preload" as="image" href="img/slides/slide_home_2.jpg">

<!-- BASE CSS -->
<link rel="preload" href="<?php echo e(asset('client')); ?>/css/bootstrap.min.css" as="style">
<link rel="stylesheet" href="<?php echo e(asset('client')); ?>/css/bootstrap.min.css">
<link rel="preload" href="<?php echo e(asset('client')); ?>/css/style.css" as="style">
<link rel="stylesheet" href="<?php echo e(asset('client')); ?>/css/style.css">

<!-- SPECIFIC CSS -->
<link rel="preload" href="<?php echo e(asset('client')); ?>/css/home_1.css" as="style">
<link rel="stylesheet" href="<?php echo e(asset('client')); ?>/css/home_1.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css
" rel="stylesheet">

<style>
    .notyf__toast {
        top: 55px !important;
        /* Khoảng cách từ cạnh trên */
    }

    /* css trang chi tiết sản phẩm , phần biến thể  */
    /* Cập nhật nền thành màu trắng */
    .prod_options {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;

    }

    .prod_options .row {
        margin-bottom: 15px;
    }

    .prod_options label {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .option-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* Thu nhỏ radio button */
    .option-item {
        background-color: #f1f1f1;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .option-item:hover {
        background-color: #007bff;
        color: white;
        transform: scale(1.05);
    }

    .option-input {
        display: none;
    }

    .option-input:checked+.option-item {
        background-color: #007bff;
        color: white;
        border: 2px solid #007bff;
    }


    #variant-stock {
        font-size: 16px;
        font-weight: bold;
        color: #d9534f;
    }

    #variant-stock.in-stock {
        color: #28a745;
    }

    @media (max-width: 768px) {
        .prod_options {
            padding: 15px;
        }

        .option-group {
            flex-direction: column;
            gap: 10px;
        }

        .qty-container {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>
<?php /**PATH /Users/admin/datn-hn53/resources/views/client/layouts/parials/css.blade.php ENDPATH**/ ?>