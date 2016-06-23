@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    Услуги
                    <a href="/admin/services/create/" class="btn btn-primary btn-sm">Создать</a>
                    <a href="/admin/services/categories/" class="btn btn-warning btn-sm">Редактировать категории</a>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="additional">
                    Раздел предназначен для управления услугами. Вы можете создавать, редактировать, удалять услуги.
                    Этот радел поможет сохранять цены в актуальном состоянии.
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
            <th>Цена</th>
            <th>Еденица измерения</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <? $count = 0; ?>
        @foreach ($services as $service)
            <tr class="listRow" id="listRow{{$service->id}}">
                <td>{{++$count}}</td>
                <td>
                    {{$service->getName()}}
                    <div class="additional">
                        Создано <strong>{{$service->created_at}}</strong>
                    </div>
                </td>
                <td>
                    {{$service->getDescription()?$service->getDescription():'Описание отсутствует'}}
                </td>
                <td>
                    {{$service->getPrice()}}
                </td>
                <td>
                    {{$service->getMeasure()}} {{$service->measurement->getNameByValue($service->getMeasure())}}
                </td>
                <td>
                    <a href="{{url('/admin/services/'.$service->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                    <a
                        class="btn btn-danger btn-sm delete"
                        data-action="/admin/services/{{$service->id}}"
                        data-post="_method=DELETE&_token={{ csrf_token() }}"
                        data-confirm="Удалить запись?"
                    >Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <?=$services->render()?>
</div>


@endsection