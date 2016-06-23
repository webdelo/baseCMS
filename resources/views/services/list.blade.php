@extends('skelet')

@section('content')
<script src="/js/services.js"></script>

<div class="content-page-header">
    <div class="container">
        <div class="row pageHeader">
            <div class="col-md-12">
                <h1>Мы будем рады вам помочь</h1>
                <p>Цены предоставлены для ознакомления, после посещения доктора Вы сможете узнать точную стоимость лечения. Любые возникающие вопросы можно уточнить <a href="/contacts/">связавшись с нами</a>.</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row marginTopBottomNm">
        {{--<div class="col-md-4">--}}

        {{--</div>--}}
        {{--<div class="col-md-8">--}}

            @foreach ($categories as $category)
                <div class="container">
                <h2 id="{{$category->alias}}" class="categoryName">
                    {{$category->name}}
                </h2>
                        @foreach ($category->subCategories as $subCategory)
                            <div class="container">
                                <h3 id="{{$subCategory->alias}}">{{$subCategory->name}}</h3>
                                    @foreach ($subCategory->items as $service)
                                        <div class="container marginTopBottomNm lightBottomBorder service animated">
                                            <div class="col-md-9">
                                                <h4>{{$service->name}}</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="priceBlock">
                                                    <span class="price">{{$service->price}} лей</span>
                                                    <span class="measurement">/ {{$service->measure}} @if($service->measurement){{$service->measurement->getNameByValue($service->measure)}}@endif</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        @endforeach
                </div>
            @endforeach


            {{--@forelse ($services as $service)--}}
            {{--<div class="row marginTopBottomSm lightBottomBorder service">--}}
                {{--<div class="col-md-3">--}}
                    {{--<img class="img-rounded" src="/images/index/bleach.png" alt="Generic placeholder image" width="150" height="150">--}}
                {{--</div>--}}
                {{--<div class="col-md-8">--}}
                    {{--<h3>{{$service->name}}</h3>--}}
                    {{--<p>--}}
                        {{--{{$service->description}}--}}
                    {{--</p>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="priceBlock">--}}
                        {{--<span class="price">{{$service->price}} лей</span>--}}
                        {{--<span class="measurement">/ {{$service->measure}} {{$service->measurement->getNameByValue($service->measure)}}</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@empty--}}
                {{--Услуги не найдены в БД--}}
            {{--@endforelse--}}
        {{--</div>--}}
    </div>
</div>


@endsection