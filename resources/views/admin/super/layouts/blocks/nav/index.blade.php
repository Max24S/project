<style>
    ul {
        list-style: none;
        color:#fff;
        font-size: 16px;
        padding: 0;
        margin:0;
    }
    ul li:hover> ul{
        display: block;
    }
    ul li li {
        padding: 15px 10px;
        border: 1px #fff solid;
    }

    ul ul   {
        background-color: #1b1e21;
        position: absolute;
        display: none;

    }
</style>
<nav>
    <ul class="d-flex justify-content-between position-relative">
        <li>
            Пользователи
            <ul>
                <li>Добавить сотрудника</li>
                <li>Редактировать список учеников</li>
                <li>Добавить ученика</li>
                <li>Редактировать список учеников</li>
            </ul>
        </li>
        <li>
            Предметы
            <ul>
                <li>Добавить предмет</li>
                <li>Редактировать предметы</li>
            </ul>
        </li>
        <li >
            Классы
            <ul>
                <li>Добавить класс</li>
                <li>Редактировать классы</li>
            </ul>
        </li>
        <li>
            Кабинеты
            <ul>
                <li>Добавить кабинет</li>
                <li>Редактировать кабинеты</li>
            </ul>
        </li>
    </ul>
</nav>
