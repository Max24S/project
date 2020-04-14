

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
    @if( Auth::user()->role=='Завуч')
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <li class="nav-item dropdown1">
            <button type="button" class="btn btn-1  dropdown-toggle text-white" data-toggle="dropdown" >Расписание</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable')}}">Просмотреть</a>
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
                <a class="dropdown-item" href="#">Редактировать</a>
            </div>
        </li>
    </div>
    @endif
    @guest
        @else
        <div class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Выйти') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    @endguest
</nav>
