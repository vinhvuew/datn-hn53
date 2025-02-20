<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Allaia Bootstrap eCommerce Template - ThemeForest">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

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

</body>

</html>
