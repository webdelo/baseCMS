@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/schedule.css">
<script src="/js/admin/schedule/schedule.js"></script>
<script src="/js/form.class.js"></script>

<div class="content-section-a">
    <div class="container">
        <h1>
            График приёма пациентов
        </h1>
    </div>
</div>
<div class="container schedule">
    <p class="error bg-danger">Сообщение об ошибке</p>
    <div class="row schedule-date-controls">
        <div class="col-md-2 col-xs-12">
            <div class="prev">
                <a href="/admin/schedule/" class="prevLink btn btn-default">
                    <span class="additional">Воскресенье</span>
                    1 мая 2016
                    <span class="badge">2</span>
                </a>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="current">
                <h2 class="date">
                    <span class="additional">Понедельник</span>
                    2 мая 2016
                </h2>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="next">
                <a href="/admin/schedule/" class="nextLink btn btn-default">
                    <span class="additional">Вторник</span>
                    3 мая 2016
                    <span class="badge">12</span>
                </a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="table-responsive schedule-date-contain">
        <table class="listContainer table">
            <thead>
            <tr>
                <th class="time">Время</th>
                <th class="doctor">Яшан Н.В.</th>
                <th class="doctor">Яшан Л.В.</th>
                <th class="doctor">Зариф В.В.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>8:30</td>
                <td class="patient">
                    <div class="patient-content">
                        <div class="patient-name">
                            Черчел Дмитрий Юрьевич
                        </div>
                        <div class="additional">
                            г. Кишинев, ул. Куза-водэ 23 кв. 136
                        </div>

                        <div class="patient-controls">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Изменить <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Редактировать</a></li>
                                    <li><a href="#">Отменить</a></li>
                                </ul>
                            </div>
                            <button
                                class="btn btn-default btn-sm"
                                data-toggle="popover"
                                data-trigger="focus"
                                title="Детали о пациенте"
                                data-content="<p>+373 67 37 178, rainxc@mail.ru</p><p>Web-Delo, глава отдела разработки</p> <a href='/admin/patients/1/edit' target='_blank' class='btn btn-default'>Подробней</a>"
                                data-placement="bottom"
                                data-html="true"
                            >
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </button>
                        </div>
                    </div>
                </td>
                <td class="patient disabled">

                </td>
                <td class="patient">
                    Черчел Анна Васильевна
                    <div class="additional">
                        г. Кишинев, ул. Куза-водэ 23 кв. 136
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>9:30</td>
                <td class="patient">
                    Димитренко Станислав
                    <div class="additional">
                        г. Бендеры, ул. Тираспольская 23
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient disabled">

                </td>
                <td class="patient">
                    Попов Андрей Юрьевич
                    <div class="additional">
                        г. Бендеры, ул. Ленина 23 кв. 136
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>10:30</td>
                <td class="patient">
                    Годияк Даниил Геннадьевич
                    <div class="additional">
                        г. Тирасполь, ул. Карла-Либкнехта 65
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient disabled">

                </td>
                <td class="patient">
                    Попова Наталья
                    <div class="additional">
                        г. Бендеры, ул. Ленина 23 кв. 136
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>11:30</td>
                <td class="patient">
                    Гринчак Александр
                    <div class="additional">
                        с. Терновка, пер. Конституции 26
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient disabled">

                </td>
                <td class="patient">
                    Гринчак Татьяна
                    <div class="additional">
                        с. Терновка, пер. Конституции 26
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>13:30</td>
                <td class="patient">
                    Сакара Иван
                    <div class="additional">
                        г. Кишинев, ул. Негруцци 23 кв. 191
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient">
                    Сакара Вероника Никоноровна
                    <div class="additional">
                        г. Кишинев, ул. Негруцци 23 кв. 191
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
                <td class="patient disabled"></td>
            </tr>
            <tr>
                <td>14:30</td>
                <td class="patient">
                    Вранчан Павел Олегович
                    <div class="additional">
                        г. Кишинев, ул. Валя-Кручей 87 кв. 28
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient">
                    Марченко Даниил
                    <div class="additional">
                        г. Кишинев, ул. Костюженская 23 кв. 136
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
                <td class="patient disabled"></td>
            </tr>
            <tr>
                <td>15:30</td>
                <td class="patient">
                    <button type="button" class="btn btn-success btn-sm add-visit" data-toggle="modal" data-target="#myModal">
                        Добавить
                    </button>
                </td>
                <td class="patient">
                    Батырь Майя
                    <div class="additional">
                        г. Кишинев, ул. Костюженская 65
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
                <td class="patient disabled"></td>
            </tr>
            <tr>
                <td>16:30</td>
                <td class="patient">
                    Цопа Валерий
                    <div class="additional">
                        г. Яловены, ул. Карла-Маркса 73
                    </div>
                    <div class="details">
                        <p>05.05.1989 | +373 67 37 178, rainxc@mail.ru</p>
                        <p>WebDelo, начальник отдела программирования</p>
                    </div>
                </td>
                <td class="patient">
                    Попа Стелла
                    <div class="additional">
                        г. Яловены, ул Ленина 237
                    </div>
                    <div class="details">
                        <p>24.08.1993 | +373 67 37 648, rusanochka@mail.ru</p>
                        <p>Студент стоматолог</p>
                    </div>
                </td>
                <td class="patient disabled"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title" id="myModalLabel">Запись пациента на приём</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal new-visit-form" action="/admin/schedule" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group">
                        <label for="time" class="col-sm-2 control-label">Время</label>
                        <div class="col-sm-10">
                            <input id="time" type="text" class="form-control timepick" name="time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input id="lastname" type="text" class="form-control" name="lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-10">
                            <input id="firstname" type="text" class="form-control" name="firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="patronymic" class="col-sm-2 control-label">Отчество</label>
                        <div class="col-sm-10">
                            <input id="patronymic" type="text" class="form-control" name="patronymic">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Примечание</label>
                        <div class="col-sm-10">
                            <textarea id="note" name="note" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary new-visit-form-submit">Записать</button>
            </div>
        </div>
    </div>
</div>


@endsection