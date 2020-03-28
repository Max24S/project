<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Page Teacher</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<style>
    body{
        margin-top:80px;
    }
</style>
<body>
<header>
    <div class="container">
        @include('admin.teacher.layouts.blocks.nav.index')
    </div>
</header>
<main role="main">
    @yield('form')
</main>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
