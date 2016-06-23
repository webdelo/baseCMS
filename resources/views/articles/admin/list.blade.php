@extends('app')

@section('content')
<link rel="stylesheet" href="/css/admin/employees.css">
<script src="/js/admin/employees.js"></script>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Статьи
                    <a href="/admin/articles/create/" class="btn btn-primary btn-sm">Создать</a>
                    <a href="/admin/articles/categories/" class="btn btn-warning btn-sm">Редактировать категории</a>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="additional">
                    Раздел предназначен для управления статьями. Вы можете создавать, редактировать, удалять статьи.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <p class="error bg-danger">Сообщение об ошибке</p>
    @if($articles->count()==0)
        <p class="error bg-primary">
            Не найдено ни одного альбома.
            Вы можете создать альбом и загрузить
            фотографии <a href="/admin/articles/create/">на этой странице</a>
        </p>
    @endif
    <div class="table-responsive">
        <table class="listContainer table table-hover table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Алиас</th>
                <th>Статус</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <? $count = 0; ?>
            @foreach ($articles as $article)
                <tr class="listRow" id="listRow{{$article->id}}">
                    <td>{{++$count}}</td>
                    <td>
                        {{$article->getName()}}
                        <div class="additional">
                            Создано <strong>{{$article->created_at}}</strong>
                        </div>
                    </td>
                    <td>
                        {{$article->getAlias()}}
                    </td>
                    <td class="{{$article->status->getAlias()}}">
                        <font color="{{$article->status->getColor()}}">{{$article->status->getName()}}</font>
                    </td>
                    <td class="{{$article->category->getAlias()}}">
                        <font color="{{$article->category->getColor()}}">{{$article->category->getName()}}</font>
                    </td>
                    <td>
                        <a href="{{url('/admin/articles/'.$article->id)}}/edit" class="btn btn-primary btn-sm">Редактировать</a>
                        <a
                            class="btn btn-danger btn-sm delete"
                            data-action="/admin/articles/{{$article->id}}"
                            data-post="_method=DELETE&_token={{ csrf_token() }}"
                            data-confirm="Удалить запись?"
                        >Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <?=$articles->render()?>
    </div>
</div>




@endsection