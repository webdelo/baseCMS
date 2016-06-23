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
                        Добавление категории
                        <button type="submit" class="btn btn-success btn-sm objectFormSubmit">Сохранить</button>
                        <a href="{{url($urlRoot).'/categories'}}" class="btn btn-danger btn-sm">Отмена</a>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <p class="error bg-danger">Сообщение об ошибке</p>
            <p class="success bg-success">Сообщение об успехе</p>
            <form class="form-horizontal objectForm" action="{{url($urlRoot).'/categories'}}" method="post" data-post-action="reload">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Родительская категория</label>
                    <div class="col-sm-10">
                        <select name="parentId" class="form-control">
                            <option value="0">Нет родителя</option>
                            @foreach($categories->get() as $categoryItem)
                                @if( !$categoryItem->parentId )
                                    <option value="{{$categoryItem->id}}">
                                        {{$categoryItem->getName()}}
                                    </option>
                                    @foreach($categoryItem->subCategories as $subCategory)
                                        @if( !$categoryItem->parentId )
                                            <option value="{{$subCategory->id}}">
                                                &nbsp;&nbsp;&nbsp;|- {{$subCategory->getName()}}
                                            </option>
                                            @foreach($subCategory->subCategories as $nextLevel)
                                                <option value="{{$nextLevel->id}}">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|- {{$nextLevel->getName()}}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Алиас</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alias" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection