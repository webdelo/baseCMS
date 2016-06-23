@extends('app')

@section('content')
    <link rel="stylesheet" href="/css/admin/employees.css">
    <script src="/js/admin/employee.js"></script>
    <script src="/js/plupload/plupload.full.min.js"></script>
    {{--<script type="text/javascript" src="/js/plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script>--}}
    <script src="/js/plupload/i18n/ru.js"></script>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-sx-5 col-md-10">
                    <h1>
                        Редактирование расписания
                        <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                        <a href="{{url('/admin/schedule')}}" class="btn btn-warning btn-sm">Отмена</a>
                        <div id="fileDetails"></div>
                    </h1>
                </div>

            </div>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/schedule/{{$visit->id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$visit->id}}">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
                    <div class="col-sm-10">
                        <select name="categoryId" class="form-control">
                            @foreach ($categories->get() as $category)
                                <option value="{{$category->id}}" <?=$visit->categoryId==$category->id?'selected="selected"':''?>> {{$category->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Статус</label>
                    <div class="col-sm-10">
                        <select name="statusId" class="form-control">
                            @foreach ($statuses->get() as $status)
                                <option value="{{$status->id}}" <?=$visit->statusId==$status->id?'selected="selected"':''?>> {{$status->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Пациент</label>
                    <div class="col-sm-10">
                        {{$visit->patient->getName()}}<br>
                        <div class="additional">
                            {{$visit->patient->getPhone()}}, {{$visit->patient->getEmail()}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Место работы</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="workFor" value="{{$visit->getWorkFor()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Адрес</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="{{$visit->getAddress()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Диагноз</label>
                    <div class="col-sm-10">
                        <textarea name="diagnosis" class="form-control">{{$visit->getDiagnosis()}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Лечение</label>
                    <div class="col-sm-10">
                        <textarea name="treatment" class="form-control">{{$visit->getTreatment()}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Примечание</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control">{{$visit->getNote()}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection