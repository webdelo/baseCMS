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
                Новый визит
                <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                <a href="{{url('/admin/visits')}}" class="btn btn-warning btn-sm">Отмена </a>
            </h1>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/visits" method="post" data-post-action="reload">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
                    <div class="col-sm-10">
                        <select name="categoryId" class="form-control">
                            @foreach ($categories->get() as $category)
                                <option value="{{$category->id}}"> {{$category->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Статус</label>
                    <div class="col-sm-10">
                        <select name="statusId" class="form-control">
                            @foreach ($statuses->get() as $status)
                                <option value="{{$status->id}}"> {{$status->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Пациент</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="patientId" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Место работы</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="workFor" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Адрес</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Диагноз</label>
                    <div class="col-sm-10">
                        <textarea name="diagnosis" class="form-control ckeditor"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Лечение</label>
                    <div class="col-sm-10">
                        <textarea name="treatment" class="form-control ckeditor"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Примечание</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control ckeditor"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection