@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    Категории
                    <a href="{{url($urlRoot).'/categories/create'}}" class="btn btn-primary btn-sm">Создать</a>
                    <a href="{{url($urlRoot)}}" class="btn btn-danger btn-sm">Назад</a>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="additional">
                    Раздел предназначен для управления категориями. Вы можете создавать, редактировать, удалять категории.
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
        @foreach ($categories->get() as $category)
            <tr class="listRow" id="listRow{{$category->id}}">
                <td>{{++$count}}</td>
                <td>{{$category->getName()}}</td>
                <td>
                    {{$category->getDescription()?$category->getDescription():'Описание отсутствует'}}
                </td>
                <td>
                    {{$category->created_at}}
                </td>
                <td>
                    <a href="{{url($urlRoot.'/categories/'.$category->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                    <a
                        class="btn btn-danger btn-sm delete"
                        data-action="{{url($urlRoot.'/categories/'.$category->id)}}"
                        data-post="_method=DELETE&_token={{ csrf_token() }}"
                        data-confirm="Удалить запись?"
                    >Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@endsection