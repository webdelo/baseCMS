@extends('app')

@section('content')
    <link rel="stylesheet" href="/css/admin/employees.css">
    <script src="/js/admin/employee.js"></script>
    <script src="/js/admin/natives.js"></script>
    <script src="/js/admin/objectView.class.js"></script>
    <script src="/js/plupload/plupload.full.min.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
    {{--<script type="text/javascript" src="/js/plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script>--}}
    <script src="/js/plupload/i18n/ru.js"></script>

    <div class="content-section-a">
        <div class="container">
            <h1>
                Редактирование статьи
                <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                <a href="{{url('/admin/articles')}}" class="btn btn-warning btn-sm">Назад</a>
            </h1>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/articles/{{$article->id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$article->id}}">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
                    <div class="col-sm-10">
                        <select name="categoryId" class="form-control">
                            <option value="0">Не выбрана</option>
                            @foreach( $categories->get() as $category )
                                <option value="{{$category->id}}" @if($category->id==$article->categoryId)selected="selected"@endif>{{$category->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Статус</label>
                    <div class="col-sm-10">
                        <select name="statusId" class="form-control">
                            <option value="0">Не выбран</option>
                            @foreach( $statuses->get() as $status )
                                <option value="{{$status->id}}" @if($status->id==$article->statusId)selected="selected"@endif>{{$status->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$article->getName()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Алиас</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alias" value="{{$article->getAlias()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Заголовок h1</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="h1" value="{{$article->getH1()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control ckeditor">{{$article->getDescription()}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Текст</label>
                    <div class="col-sm-10">
                        <textarea name="text" class="form-control ckeditor">{{$article->getText()}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="metaTitle" value="{{$article->getMetaTitle()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="metaKeywords" value="{{$article->getMetaKeywords()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="metaDescription" value="{{$article->getMetaDescription()}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection