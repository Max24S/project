<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto d-flex justify-content-around w-100">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('student.homework.index')}}" >Домашнее задание</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{route('student.timetable.index')}}"  aria-haspopup="true" aria-expanded="false">Расписание</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
