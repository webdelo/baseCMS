@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <h1>
            Визиты пациентов
            <a href="/admin/visits/create/" class="btn btn-primary btn-sm">Создать</a>
            <a href="/admin/visits/categories/" class="btn btn-warning btn-sm">Редактировать категории</a>
        </h1>
    </div>
</div>
<div class="container">
    <p class="error bg-danger">Сообщение об ошибке</p>
    <table class="listContainer table table-hover table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>
                ФИО
                <div class="additional">
                    Контакты
                </div>
            </th>
            <th>Дата рождения</th>
            <th>
                Адрес
                <div class="additional">
                    Место работы
                </div>
            </th>
            <th>Диагноз</th>
            <th>Лечение</th>

            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <? $count = 0; ?>
        @foreach ($visits as $visit)
            <tr class="listRow" id="listRow{{$visit->id}}">
                <td>{{++$count}}</td>
                <td>
                    {{$visit->patient->getName()}}
                    <div class="additional">
                        {{$visit->patient->getPhone()}}, {{$visit->patient->getEmail()}}
                    </div>
                </td>
                <td>{{$visit->getDate()}}</td>
                <td>
                    {{$visit->getAddress()}}
                    <div class="additional">
                        {{$visit->getWorkFor()}}
                    </div>
                </td>
                <td>
                    <div class="additional">{{$visit->getDiagnosis()?$visit->getDiagnosis():'Не определен'}}</div>
                </td>
                <td>
                    <div class="additional">{{$visit->getTreatment()?$visit->getTreatment():'Не определено'}}</div>
                </td>
                <td>
                    <a href="{{url('/admin/visits/'.$visit->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                    <a
                        class="btn btn-danger btn-sm delete"
                        data-action="/admin/visits/{{$visit->id}}"
                        data-post="_method=DELETE&_token={{ csrf_token() }}"
                        data-confirm="Удалить запись?"
                    >Удалить</a>
                    <div class="additional">
                        {{$visit->created_at}}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <?=$visits->render()?>
</div>


@endsection