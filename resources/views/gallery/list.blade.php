@extends('skelet')

@section('content')
<script type="text/javascript" src="/js/gallery.js"></script>
{{--<script src="/js/lightbox/jquery-1.11.0.min.js"></script>--}}
<script src="/js/lightbox/lightbox.min.js"></script>
<link href="/js/lightbox/css/lightbox.css" rel="stylesheet" />
<div class="content-page-header">
    <div class="container">
        <div class="row pageHeader">
            <div class="col-md-12">
                <h1>Галерея</h1>
                <p>Вы можете ознакомится с результатами наших трудов.</p>
            </div>
        </div>
    </div>
</div>
<div class="container" ng-controller="ctrlGallery">
    @foreach( $albums as $album )
    <div ng-repeat="album in albums | filter:query">
        <h3 class="albumHead">{{$album->getName()}}</h3>
        <div class="albumImages">
            @foreach( $album->images as $image )
            <span class="animated">
                <a href="{{$image->getImage('1024x768')}}" data-lightbox="{{$album->getName()}}">
                    <img src="{{$image->getImage('200x200')}}" alt=""/>
                </a>
            </span>
            @endforeach
        </div>
    </div>
    @endforeach
</div>


@endsection