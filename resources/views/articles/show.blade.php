@extends('skelet')

@section('content')
    <script type="text/javascript" src="/js/gallery.js"></script>
    <script type="text/javascript" src="/js/wow.js"></script>
    <script src="/js/lightbox/lightbox.min.js"></script>
    <link href="/js/lightbox/css/lightbox.css" rel="stylesheet" />
    <link href="/js/jquery/mosaicflow/jquery.mosaicflow.css" rel="stylesheet" />
    <script src="/js/jquery/mosaicflow/jquery.mosaicflow.js" type="text/javascript" charset="utf-8"></script>


    <div class="container">
        @include('description')
        {{--<div class="row">--}}
            {{--<div class="socials">--}}
                {{--<a--}}
                    {{--href="https://www.facebook.com/"--}}
                    {{--target="_blank"--}}
                    {{--data-icon="facebook"--}}
                    {{--class="wow transparent fadeIn"--}}
                    {{--data-wow-duration="1s"--}}
                    {{--data-wow-delay="2s"--}}
                {{--></a>--}}
                {{--<a--}}
                    {{--href="https://www.instagram.com/"--}}
                    {{--target="_blank"--}}
                    {{--data-icon="instagram"--}}
                    {{--class="wow transparent fadeIn"--}}
                    {{--data-wow-duration="1s"--}}
                    {{--data-wow-delay="2s"--}}
                {{--></a>--}}
                {{--<a--}}
                    {{--href="https://photos.google.com/"--}}
                    {{--target="_blank"--}}
                    {{--data-icon="picasa"--}}
                    {{--class="wow transparent fadeIn"--}}
                    {{--data-wow-duration="1s"--}}
                    {{--data-wow-delay="2s"--}}
                {{--></a>--}}
            {{--</div>--}}
        {{--</div>--}}


        <div class="row controls">
            <div class="col-xs-4 toPrev wow fadeInLeft"
                 data-wow-duration="1s"
                 data-wow-delay="1s"
            >
                @if($article->prevAlbum())
                <a
                    href="/gallery/{{$article->prevAlbum()->id}}"
                >Предыдущий альбом</a>
                @endif
            </div>
            <div class="col-xs-4 toMain">
                <a
                    href="/"
                    class="wow transparent fadeIn"
                    data-wow-duration="1s"
                    data-wow-delay="1s"
                >На главную</a>
            </div>
            <div class="col-xs-4 toNext wow fadeInRight"
                 data-wow-duration="1s"
                 data-wow-delay="1s"
            >
                @if($article->nextAlbum())
                <a
                    href="/gallery/{{$article->nextAlbum()->id}}"

                >Следующий альбом</a>
                @endif
            </div>
        </div>
        <h3 class="articleHead wow transparent fadeInUp">
            {{$article->getName()}}
        </h3>
        <div class="articleImages mosaicflow demo-gallery group" data-min-item-width="300" >
            @foreach( $article->images as $image )
            <div class="mosaicflow__item">
                <a
                    href="{{$image->getImage('1024x768')}}"
                    data-lightbox="{{$article->getName()}}"
                    class="wow transparent fadeIn"
                    data-wow-duration="1s"
                    {{--data-wow-delay="1s"--}}
                >
                    <img src="{{$image->getImage('1024x768')}}" alt=""/>
                </a>
            </div>
            @endforeach
        </div>

    </div>

    {{--<div class="container" ng-controller="ctrlGallery">--}}

        {{--<div ng-repeat="article in articles | filter:query">--}}
            {{--<div class="articleImages mosaicflow demo-gallery group" data-min-item-width="300">--}}
                {{--<div class="mosaicflow__item animated">--}}
                    {{--<a--}}
                        {{--href="[[article.imageFull]]"--}}
                        {{--data-lightbox="[[article.name]]"--}}
                    {{-->--}}
                        {{--<img src="[[article.preview]]" alt=""/>--}}
                        {{--<p>[[article.name]]</p>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection