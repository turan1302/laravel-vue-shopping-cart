<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Shop Homepage - Start Bootstrap Template</title>

    @vite('resources/css/app.css')

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('front') }}/assets/favicon.ico"/>
    <!-- Bootstrap icons-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('front') }}/css/styles.css" rel="stylesheet"/>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>

    @vite('resources/js/app.js')
<!-- Core theme JS-->
<script src="{{ asset('front') }}/js/scripts.js"></script>
</body>
</html>
