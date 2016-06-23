@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <h1>
            Пациенты
            <a href="/admin/patients/create/" class="btn btn-primary btn-sm">Создать</a>
            <a href="/admin/patients/categories/" class="btn btn-warning btn-sm">Редактировать категории</a>
        </h1>
    </div>
</div>
<div class="container">
    <p class="error bg-danger">Сообщение об ошибке</p>
    <table class="listContainer table table-hover table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Адрес</th>
            <th>Место работы</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Дата регистрации</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <? $count = 0; ?>
        @foreach ($patients as $patient)
            <tr class="listRow" id="listRow{{$patient->id}}">
                <td>{{++$count}}</td>
                <td>
                    {{$patient->getName()}}
                </td>
                <td>
                    {{$patient->getAddress()}}
                </td>
                <td>
                    {{$patient->getWorkFor()}}
                </td>
                <td>
                    {{$patient->isMale()?'Мужской':'Женский'}}
                </td>
                <td>
                    {{$patient->getBirthdate()}}
                </td>
                <td>
                    {{$patient->created_at}}
                </td>
                <td>
                    <a href="{{url('/admin/patients/'.$patient->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                    <a
                        class="btn btn-danger btn-sm delete"
                        data-action="/admin/patients/{{$patient->id}}"
                        data-post="_method=DELETE&_token={{ csrf_token() }}"
                        data-confirm="Удалить запись?"
                    >Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <?=$patients->render()?>
</div>


@endsection