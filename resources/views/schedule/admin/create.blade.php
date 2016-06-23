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
                Новая запись в расписании
                <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                <a href="{{url('/admin/schedule')}}" class="btn btn-warning btn-sm">Отмена </a>
            </h1>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/schedule" method="post" data-post-action="reload">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="statusId" value="1">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            @include('schedule.admin.findPatient')
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Дата и время</label>
                    <div class="col-sm-4">
                        <input type="input" class="form-control datetimepickers" name="date" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
                    <div class="col-sm-4">
                        <select name="categoryId" class="form-control">
                            @foreach ($visitCategories->get() as $category)
                                <option value="{{$category->id}}"> {{$category->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Примечание</label>
                    <div class="col-sm-4">
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection