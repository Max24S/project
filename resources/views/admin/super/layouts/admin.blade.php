<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        header {
            background-color: #1b1e21;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            z-index: 1;
            top: 0;
        }
        body {
            padding-top: 100px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            @include('admin.super.layouts.blocks.nav.index')
        </div>
    </header>

        @yield('form')

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
