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
            position: fixed;
            width: 100%;
            z-index: 100;
            top: 0;
        }
        body {
               padding-top: 70px;
           }
        .formContainer {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header class="bg-dark">
        @include('admin.super.layouts.blocks.nav.index')
    </header>
    <div id="app">
    <div class="container">
        <div class="formContainer">
            @yield('form')
        </div>
    </div>

        @yield('table')
        <footer-component></footer-component>
    </div>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
