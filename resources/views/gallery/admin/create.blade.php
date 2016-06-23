@extends('app')

@section('content')
    <link rel="stylesheet" href="/css/admin/employees.css">
    <script src="/js/admin/employee.js"></script>
    <script src="/js/plupload/plupload.full.min.js"></script>
    {{--<script type="text/javascript" src="/js/plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script>--}}
    <script src="/js/plupload/i18n/ru.js"></script>
    <div class="content-section-a">
        <div class="container">
            <h1>
                Новый альбом
                <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                <a href="{{url('/admin/gallery')}}" class="btn btn-warning btn-sm">Отмена</a>
            </h1>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/gallery" method="post" data-post-action="reload">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control ckeditor"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Фото</label>
                    <div class="col-sm-10">
                        <p>
                            Загрузка фотографий будет доступна в режиме редактирования
                        </p>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
@endsection