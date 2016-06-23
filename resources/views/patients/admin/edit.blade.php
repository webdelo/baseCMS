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
                        Редактирование пациента
                        <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                        <a href="{{url('/admin/patients')}}" class="btn btn-warning btn-sm">Отмена</a>
                        <a
                            id="browse"
                            class="btn btn-primary btn-sm"
                            href="javascript:"
                            data-action="/admin/patients/uploadImage?objectId={{$patient->id}}"
                        >
                            @if( $patient->image)
                                Изменить фото
                            @else
                                Загрузить фото
                            @endif
                        </a>
                        <div id="fileDetails"></div>
                    </h1>
                </div>
                <div class="col-sx-5 col-md-2">
                    <a href="{{$patient->getAvatar()}}" data-lightbox="lightbox" class="photoThumb">
                        <img id="avatar" class="img-thumbnail" src="{{$patient->getAvatar()}}" alt="">
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="/admin/patients/{{$patient->id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$patient->id}}">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Категория</label>
                    <div class="col-sm-10">
                        <select name="categoryId" class="form-control">
                            @foreach ($categories->get() as $category)
                                <option value="{{$category->id}}" <?=$patient->categoryId==$category->id?'selected="selected"':''?>> {{$category->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Статус</label>
                    <div class="col-sm-10">
                        <select name="statusId" class="form-control">
                            @foreach ($statuses->get() as $status)
                                <option value="{{$status->id}}" <?=$patient->statusId==$status->id?'selected="selected"':''?>> {{$status->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Фамилия</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" value="{{$patient->getLastname()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" value="{{$patient->getFirstname()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Отчество</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="patronymic" value="{{$patient->getPatronymic()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Дата рождения</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="birthdate" value="{{$patient->getBirthdate()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" value="{{$patient->getPhone()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$patient->getEmail()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Место работы</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="workFor" value="{{$patient->getWorkFor()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Адрес</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="{{$patient->getAddress()}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Пол</label>
                    <div class="col-sm-10">
                        <select name="male" class="form-control">
                            <option value="1" <?=$patient->male==1?'selected="selected"':''?>>Мужской</option>
                            <option value="0" <?=$patient->male==0?'selected="selected"':''?>>Женский</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Примечание</label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control ckeditor">{{$patient->getNote()}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection