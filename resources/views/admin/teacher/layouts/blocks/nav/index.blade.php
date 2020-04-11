
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown1">
                <button type="button" class="btn btn-1  dropdown-toggle text-white" data-toggle="dropdown" >Домашнее задание</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('admin.teacher.homework.create')}}">Создать</a>
                    <a class="dropdown-item" href="#">Редактировать</a>
                </div>
            </li>
            @yield('nav-head')
        </ul>
    </div>
</nav>
