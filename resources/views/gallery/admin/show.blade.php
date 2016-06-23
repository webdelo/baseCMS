@extends('app')

@section('content')
    <link rel="stylesheet" href="/css/admin/employees.css">
    <script src="/js/admin/employee.js"></script>
    <div class="content-section-a">
        <div class="container">
            <h2>{{$employee->getName()}}
                <span class="additional">
                    @foreach($employee->specialities as $speciality)
                        {{$speciality->getName()}},
                    @endforeach
                    {{$employee->position->getName()}}
                </span>
            </h2>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Фото</label>
                <div class="col-sm-10">
                    <a class="btn btn-primary btn-sm">Загрузить</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success btn-lg objectFormSubmit">Сохранить</button>
                    <a href="{{url('/admin/employees')}}" class="btn btn-warning btn-lg">Отмена</a>
                </div>
            </div>
        </div>
    </div>
@endsection