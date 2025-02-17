<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Allaia Bootstrap eCommerce Template - ThemeForest">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="client/img/favicon.ico" type="client/image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="client/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="client/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="client/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="client/img/apple-touch-icon-144x144-precomposed.png">

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
    <link rel="preload" as="image" href="client/img/slides/slide_home_2.jpg">

    <!-- BASE CSS -->
    <link rel="preload" href="/client/css/bootstrap.min.css" as="style">
    <link rel="stylesheet" href="/client/css/bootstrap.min.css">
    <link rel="preload" href="/client/css/style.css" as="style">
    <link rel="stylesheet" href="/client/css/style.css">

    <!-- SPECIFIC CSS -->
    <link rel="preload" href="client/css/home_1.css" as="style">
    <link rel="stylesheet" href="client/css/home_1.css">

    <!-- SPECIFIC CSS -->
    <link href="client/css/listing.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="client/css/custom.css" rel="stylesheet">

    {{-- cart --}}
    <link href="client/css/cart.css" rel="stylesheet">
    <link href="client/css/checkout.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="client/css/product_page.css" rel="stylesheet">
    {{-- để lại bình luận --}}
    <link href="css/leave_review.css" rel="stylesheet">


</head>
