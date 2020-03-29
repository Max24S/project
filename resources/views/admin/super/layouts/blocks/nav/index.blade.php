<style>
    ul li:hover> div{
        display: block;
        z-index: 2000;
    }
    .dropdown-menu {
        top: 35px;
        left: -40px;
    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto d-flex justify-content-around w-100">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Пользователи</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Добавить сотрудника</a>
                        <a class="dropdown-item" href="#">Редактировать список сотрудников</a>
                        <a class="dropdown-item" href="#">Добавить ученика</a>
                        <a class="dropdown-item" href="#">Редактировать список учеников</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Предметы</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Добавить предмет</a>
                        <a class="dropdown-item" href="#">Редактировать предметы</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Классы</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Добавить класс</a>
                        <a class="dropdown-item" href="#">Редактировать классы</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Кабинеты</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Добавить кабинет</a>
                        <a class="dropdown-item" href="#">Редактировать кабинеты</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
