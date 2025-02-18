<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>𝕷𝖊𝖌𝖊𝖓𝖉 𝕾𝖍𝖔𝖕</title>
    @include('client.layouts.parials.css')

</head>

<body>
    <header>
        @include('client.layouts.parials.header')
    </header>
    @yield('content')
    <footer>
        @include('client.layouts.parials.footer')
    </footer>
    @include('client.layouts.parials.js')

</body>

</html>
