@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Галерея <a href="/admin/gallery/create/" class="btn btn-primary btn-sm">Создать</a></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="additional">
                    Раздел предназначен для управлеия альбомами. Вы можете создавать, редактировать, удалять альбомы.
                    В каждый альбом вы можете загрузить неограниченное количество фотографий.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <p class="error bg-danger">Сообщение об ошибке</p>
    <table class="listContainer table table-hover table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Дата регистрации</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <? $count = 0; ?>
        @foreach ($albums as $album)
            <tr class="listRow" id="listRow{{$album->id}}">
                <td>{{++$count}}</td>
                <td>{{$album->getName()}}</td>
                <td>
                    {{$album->getDescription()?$album->getDescription():'Описание отсутствует'}}
                </td>
                <td>
                    {{$album->created_at}}
                </td>
                <td>
                    <a href="{{url('/admin/gallery/'.$album->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                    <a
                        class="btn btn-danger btn-sm delete"
                        data-action="/admin/gallery/{{$album->id}}"
                        data-post="_method=DELETE&_token={{ csrf_token() }}"
                        data-confirm="Удалить запись?"
                    >Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <?=$albums->render()?>
</div>


@endsection