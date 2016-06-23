<div>
    <div class="content-section-a">
        <div class="container">
            <h1>
                График приёма пациентов
                <button type="button" class="btn btn-success btn-sm add-visit" data-toggle="modal" data-target="#myModal">
                    Записать пациента
                </button>
            </h1>
        </div>
    </div>
    <div class="container schedule">
        <p class="error bg-danger">Сообщение об ошибке</p>
        <div class="row schedule-date-controls">
            <div class="col-md-2 col-xs-12">
                <div class="prev">
                    <a ng-href="#{%prevDate.dmy%}" class="prevLink btn btn-default" ng-model="currentDate">
                        <span class="additional">{%prevDate.weekDayName%}</span>
                        {%prevDate.day%} {%prevDate.monthName%} {%prevDate.year%}
                        {{--<span class="badge">2</span>--}}
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="current">
                    <h2 class="date">
                        <span class="additional">{%date.weekDayName%}</span>
                        {%date.day%} {%date.monthName%} {%date.year%}
                    </h2>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="next">
                    <a ng-href="#{%nextDate.dmy%}" class="prevLink btn btn-default" ng-model="currentDate">
                        <span class="additional">{%nextDate.weekDayName%}</span>
                        {%nextDate.day%} {%nextDate.monthName%} {%nextDate.year%}
                        {{--<span class="badge">2</span>--}}
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
                    <th class="doctor" ng-repeat="doctor in doctors">{%doctor.employee.lastname%} {%doctor.employee.firstname%} {%doctor.employee.patronymic%}</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="row in times">
                    <td>{%row.time.hi%}</td>
                    <td class="patient" ng-repeat="visit in row.visits">
                        <div class="patient-content" ng-show="visit.patient">
                            <div class="patient-name">
                                {%visit.patient.lastname%} {%visit.patient.firstname%} {%visit.patient.patronymic%}
                            </div>
                            <div class="additional">
                                {%visit.patient.address%}
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
                        <button
                            type="button"
                            class="btn btn-success btn-sm add-visit"
                            data-toggle="modal"
                            data-target="#myModal"
                            ng-click="presetVisit(visit.doctorId, row.time.ymdhis)"
                            ng-hide="visit.patient"
                        >
                            Записать пациента
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="new-visit-form" name="newVisitForm" ng-submit="createNewVisit()" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title" id="myModalLabel">Запись пациента на приём {%newVisitForm.$invalid%}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" ng-model="visit._token" value="{{ csrf_token() }}">
                    <input type="hidden" ng-model="visit._method" value="POST">
                    <input type="hidden" ng-model="visit.categoryId" ng-init="visit.categoryId = 1" value="1"> <? // Обычный визит ?>
                    <input type="hidden" ng-model="visit.patientId" value="0">
                    <div class="row clinic">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="doctor" class="control-label">Доктор</label>
                                        <select
                                            name="doctorId"
                                            ng-model="visit.doctorId"
                                            ng-change="changedDoctor()"
                                            class="form-control"
                                            ng-options="doctor.id as ( doctor.employee.lastname +' '+ doctor.employee.firstname ) for doctor in doctors"
                                            required
                                        >
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="date" class="control-label">Дата и время</label>
                                        <input id="date" ng-model="visit.date" type="text" ng-change="changedDate()" class="form-control timepick" name="date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">
                                    Телефон
                                </label>
                                <input
                                    id="phone"
                                    ng-model="visit.phone"
                                    ng-change="searchByPhone()"
                                    international-phone-number
                                    type="tel"
                                    class="form-control"
                                    name="phone"
                                    required
                                >
                                <p ng-show="newVisitForm.phone.$invalid && !newVisitForm.phone.$pristine && newVisitForm.$invalid && !visit.patientId" class="help-block">Пожалуйста укажите номер телефона</p>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="control-label">
                                    Фамилия
                                </label>
                                <input
                                    id="lastname"
                                    ng-model="visit.lastname"
                                    ng-change="searchByName()"
                                    type="text"
                                    class="form-control"
                                    name="lastname"
                                    required
                                >
                                <p ng-show="newVisitForm.lastname.$invalid && !newVisitForm.lastname.$pristine && newVisitForm.$invalid && !visit.patientId" class="help-block">Пожалуйста укажите фамилию</p>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="control-label">
                                    Имя
                                </label>
                                <input
                                    id="firstname"
                                    ng-model="visit.firstname"
                                    ng-change="searchByName()"
                                    type="text"
                                    class="form-control"
                                    name="firstname"
                                    required
                                >
                                <p ng-show="newVisitForm.firstname.$invalid && !newVisitForm.firstname.$pristine && newVisitForm.$invalid && !visit.patientId" class="help-block">Пожалуйста укажите имя</p>
                            </div>
                            <div class="form-group">
                                <label for="patronymic" class="control-label">
                                    Отчество
                                </label>
                                <input
                                    id="patronymic"
                                    ng-model="visit.patronymic"
                                    ng-change="searchByName()"
                                    type="text"
                                    class="form-control"
                                    name="patronymic"
                                >
                            </div>
                            <div class="form-group">
                                <label for="note" class="control-label">Примечание</label>
                                <textarea id="note" ng-model="visit.note" name="note" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="found-container newContainer">
                                <h5>Новый пациент</h5>
                                <div class="table-responsive found-list phone-list">
                                    <table class="table table-hover">
                                        <tr class="patientRow selected">
                                            <td ng-show="visit.patient.lastname || visit.patient.firstname || visit.patient.phone">
                                                {%visit.patient.lastname%} {%visit.patient.firstname%}
                                                <div class="additional">
                                                    {%visit.patient.email ? visit.patient.email : 'E-mail не указан'%} | {%visit.patient.phone%}
                                                </div>
                                            </td>
                                            <td ng-hide="visit.patient.lastname || visit.patient.firstname || visit.patient.phone">
                                                Для регистрации пациента пожалуйста заполните форму
                                            </td>
                                            <td ng-show="visit.patient.lastname || visit.patient.firstname || visit.patient.phone">
                                                <button class="btn btn-success btn-sm selectPatient" ng-show="visit.patientId!=0" ng-click="chooseNewPatient($event)" type="button">Выбрать</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="found-container phoneContainer" ng-show="foundByPhone.length > 0 ">
                                <h5>Совпадения по номеру телефона <span class="badge">{%foundByPhone.length%}</span></h5>
                                <div class="table-responsive found-list phone-list">
                                    <table class="table table-hover">
                                        <tr ng-repeat="patient in foundByPhone" class="patientRow">
                                            <td>
                                                <a href="/admin/patients/{%patient.id%}/edit" target="_blank">{%patient.lastname%} {%patient.firstname%}</a>
                                                <div class="additional">
                                                    {%patient.email ? patient.email : 'E-mail не указан'%} | {%patient.phone%}
                                                </div>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-primary btn-sm selectPatient"
                                                    type="button"
                                                    ng-click="selectPatient(patient, $event)"
                                                    data-patient-id="{%patient.id%}"
                                                    ng-show="visit.patientId!=patient.id"
                                                >Выбрать</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="found-container nameContainer" ng-show="foundByName.length > 0 ">
                                <h5>Совпадения по ФИО <span class="badge">{%foundByName.length%}</span></h5>
                                <div class="table-responsive found-list">
                                    <table class="table table-hover">
                                        <tr ng-repeat="patient in foundByName" class="patientRow">
                                            <td>
                                                <a href="/admin/patients/{%patient.id%}/edit" target="_blank">{%patient.lastname%} {%patient.firstname%}</a>
                                                <div class="additional">
                                                    {%patient.email ? patient.email : 'E-mail не указан'%} | {%patient.phone%}
                                                </div>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-primary btn-sm selectPatient"
                                                    type="button"
                                                    ng-click="selectPatient(patient, $event)"
                                                    data-patient-id="{%patient.id%}"
                                                    ng-show="visit.patientId!=patient.id"
                                                >Выбрать</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary new-visit-form-submit">Записать</button>
                </div>
            </div>
        </form>
    </div>
</div>