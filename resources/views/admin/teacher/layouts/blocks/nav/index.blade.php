

<nav class=" head navbar navbar-expand-md fixed-top ">
    <div class="row w-100">
        <div class="col-8">
                <ul class="navbar-nav mr-auto d-flex">
                    <li class="nav-item mr-4">
                        <a class="nav-link link-menu" href="{{route('admin.teacher.homework')}}" >Домашнее задание</a>
                    </li>
            @guest
            @else
                @if( Auth::user()->role=='Завуч')
                        <li class="nav-item ">
                            <div class="btn-group">
                                <button type="button" class="link-menu btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Расписание
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
                                    <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable')}}">Просмотреть</a>
                                </div>
                            </div>
                        </li>
                    </ul>
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
                            <a class=" dropdown-item" href="{{ route('logout') }}"
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
    .head .link-menu {
        color: #fff;
        text-decoration: none;
    }

</style>
