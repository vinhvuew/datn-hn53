<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Allaia Bootstrap eCommerce Template - ThemeForest">
    <meta name="author" content="Ansonika">
    <title>LegendShoes | Uy Tín Tạo Niềm Tin</title>

    @include('client.layouts.parials.css')
    @yield('style-libs')


</head>

<body>
    <div id="page">

        @include('client.layouts.parials.header')


        @yield('content')


        @include('client.layouts.parials.footer')

    </div>

    <div id="toTop"></div>

    @include('client.layouts.parials.js')
    @yield('script-libs')
    @include('client.chatai.index')


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
