

<nav class=" head navbar navbar-expand-md fixed-top ">
    <div class="row w-100">
        <div class="col-8">
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto d-flex">
                    <li class="nav-item mr-4">
                        <a class="nav-link link-menu" href="{{route('admin.teacher.homework')}}" >Домашнее задание</a>
                    </li>
            @guest
            @else
                @if( Auth::user()->role=='Завуч')
                    <li class="nav-item">
                        <div class="dropdown">
                            <span class="nav-link link-menu  d-block dropdown-toggle" data-toggle="dropdown" >
                                Расписание
                            </span>
                            <div class="dropdown-menu">
                                <a class=" drop dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
                                <a class=" drop dropdown-item" href="{{route('admin.teacher.head-teacher.timetable')}}">Просмотреть</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
                @endif
            @endguest
        </div>
        <div class="col-4">
            <div class="justify-content-end d-flex">
                @guest
                @else
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class=" link-menu nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class=" dropdown-item drop" href="{{ route('logout') }}"
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
            </div>
        </div>
    </div>
</nav>
<style>
    .head {
        background-color: #051d2c;
    }
    .dropdown-toggle{
        cursor: pointer;
    }
    .head .link-menu {
        color: #fff;
        text-decoration: none;
    }
    .dropdown-menu .drop{
        color:#051d2c
    }
    .custom-toggler.navbar-toggler {
        border-color: rgb(255,102,203);
    }
</style>
