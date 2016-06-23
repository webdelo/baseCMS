@extends('skelet')

@section('content')
<script src="/js/employees.js"></script>

<div class="content-page-header">
    <div class="container">
        <div class="row pageHeader">
            <div class="col-md-12">
                <h1>Наши сотрудники</h1>
                <p>Каждый из нас хорошо знает как делать свое дело</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @foreach ($categories as $category)
        <div class="row marginTopBottomNm">
            <h3 id="{{$category->alias}}">{{$category->name}}</h3>
            @foreach ($category->items as $employee)
                <div class="col-xs-6 col-md-5 employee animated">
                    <div class="col-xs-12 col-md-6 avatar">
                        <img src="{{$employee->getAvatar()}}" width="174">
                    </div>
                    <div class="col-xs-12 col-md-6 employeeDetails">
                        <h4>{{$employee->getName()}}</h4>
                        <h5 class="additional">{{$employee->position->getName()}}</h5>
                        <h5 class="additional">
                            @foreach ($employee->specialities as $speciality)
                                {{$speciality->getName()}}
                            @endforeach
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>


@endsection