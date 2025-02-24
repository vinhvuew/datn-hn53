<!-- Favicons-->
<link rel="shortcut icon" href="{{ asset('client') }}/img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('client') }}/img/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
    href="{{ asset('client') }}/{{ asset('client') }}/img/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
    href="{{ asset('client') }}/img/apple-touch-icon-144x144-precomposed.png">

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
<link rel="preload" href="{{ asset('client') }}/css/bootstrap.min.css" as="style">
<link rel="stylesheet" href="{{ asset('client') }}/css/bootstrap.min.css">
<link rel="preload" href="{{ asset('client') }}/css/style.css" as="style">
<link rel="stylesheet" href="{{ asset('client') }}/css/style.css">

<!-- SPECIFIC CSS -->
<link rel="preload" href="{{ asset('client') }}/css/home_1.css" as="style">
<link rel="stylesheet" href="{{ asset('client') }}/css/home_1.css">
