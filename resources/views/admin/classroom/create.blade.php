<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
<div class="container">
    <form class="form-horizontal" role="form">
        <h2>Добавление кабинета</h2>
        <div class="form-group">
            <label for="Name" class="col-sm-3 control-label">Название предмета</label>
            <div class="col-sm-9">
                <input type="text" id="Name" placeholder="Кабинет..." class="form-control" autofocus>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form> <!-- /form -->
</div> <!-- ./container -->
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
