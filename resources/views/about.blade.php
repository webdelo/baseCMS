@extends('skelet')

@section('content')
    <script type="text/javascript" src="/bower_components/angular/angular.min.js"></script>
    <script type="text/javascript" src="/js/ui-utils.min.js"></script>
    <script type="text/javascript" src="/js/contacts.js"></script>
    <div class="content-page-header">
        <div class="container">
            <div class="row pageHeader">
                <div class="col-md-12">
                    <h1>О нас</h1>
                    <p>Рады познакомиться с вами!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <div class="col-md-6">
                <div class="contactsImage"><img class="img-responsive" src="/images/about/cabinet.jpg" /></div>
            </div>
            <div class="col-md-6">
                <p>
                    {{$history->getText()}}
                </p>
            </div>
        </div>
    </div>
    <div class="content-section-a">
        <div class="container">
            <div class="col-md-6">
                <h3>{{$recruitment->getName()}}</h3>
                <p>{{$recruitment->getText()}}</p>
                <p></p>
            </div>
            <div class="col-md-6">
                <div class="contactsImage"><img class="img-responsive" src="/images/about/doctors.jpg" /></div>
            </div>
        </div>
    </div>
    <div class="content-section-b">
        <div class="container">
            <div class="col-md-6">
                <div class="contactsImage"><img class="img-responsive" src="/images/about/partnership.jpg" /></div>
            </div>
            <div class="col-md-6">
                <h3>{{$partnership->getName()}}</h3>
                <p>{!! $partnership->getText() !!}</p>
            </div>
        </div>
    </div>
@endsection