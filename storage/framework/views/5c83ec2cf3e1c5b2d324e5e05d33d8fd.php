<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Allaia Bootstrap eCommerce Template - ThemeForest">
    <meta name="author" content="Ansonika">
    <title>Legend Shoes | Uy Tín Tạo Niềm Tin</title>

    <?php echo $__env->make('client.layouts.parials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style-libs'); ?>


</head>

<body>
    <div id="page">

        <?php echo $__env->make('client.layouts.parials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

        <?php echo $__env->yieldContent('content'); ?>

        
        <?php echo $__env->make('client.layouts.parials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <div id="toTop"></div>

    <?php echo $__env->make('client.layouts.parials.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('script-libs'); ?>
    <?php echo $__env->make('client.chatai.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceRange = document.getElementById('priceRange'); // Lấy thanh trượt
        const priceValue = document.getElementById('priceValue'); // Lấy thẻ hiển thị giá trị

        // Cập nhật giá trị khi thanh trượt thay đổi
        priceRange.addEventListener('input', function () {
            priceValue.textContent = this.value + 'VND'; // Cập nhật giá trị hiển thị
        });

        // Cập nhật giá trị ban đầu khi trang được tải
        priceValue.textContent = priceRange.value + 'VND';
    });
</script>
</body>

</html>
<?php /**PATH /Users/admin/datn-hn53/resources/views/client/layouts/master.blade.php ENDPATH**/ ?>