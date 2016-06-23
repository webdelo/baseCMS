<script type="text/javascript" src="/js/script.js"></script>
{{--<div class="content-section-a">--}}
    {{--<div class="container">--}}
        {{--<div class="knobs row">--}}
            {{--<div class="chart_wrapper col-xs-6 col-sm-3">--}}
                {{--<input--}}
                    {{--id="chart_anim_2"--}}
                    {{--class="knob dentists dial"--}}
                    {{--data-title="Парадонтология"--}}
                    {{--value="0"--}}
                    {{--data-targetValue="100"--}}
                    {{--data-readOnly=true--}}
                    {{--data-fgColor="#fff"--}}
                    {{--data-bgColor="#ccc"--}}
                {{--/>--}}

                {{--<div class="circle gray light">--}}
                    {{--<img src="/images/index/bleach.jpg">--}}
                    {{--<span class="title">Отбеливание зубов</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="chart_wrapper col-xs-6 col-sm-3">--}}
            {{--<input--}}
                    {{--class="knob therapy dial"--}}
                    {{--data-title="Терапия"--}}
                    {{--value="0"--}}
                    {{--data-targetValue="100"--}}
                    {{--data-readOnly=true--}}
                    {{--data-fgColor="#fff"--}}
                    {{--data-bgColor="#ccc"--}}
            {{--/>--}}

                {{--<div class="circle gray light">--}}
                    {{--<img src="/images/index/health.jpg">--}}
                    {{--<span class="title">Терапия</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="chart_wrapper col-xs-6 col-sm-3">--}}
            {{--<input--}}
                    {{--class="knob prosthetics dial"--}}
                    {{--data-title="Протезирование"--}}
                    {{--value="0"--}}
                    {{--data-targetValue="100"--}}
                    {{--data-readOnly=true--}}
                    {{--data-fgColor="#fff"--}}
                    {{--data-bgColor="#ccc"--}}
            {{--/>--}}

                {{--<div class="circle gray light">--}}
                    {{--<img src="/images/index/implants.jpg">--}}
                    {{--<span class="title">Импланты</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="chart_wrapper col-xs-6 col-sm-3">--}}
            {{--<input--}}
                    {{--class="knob surgery dial"--}}
                    {{--data-title="Хирургия"--}}
                    {{--value="0"--}}
                    {{--data-targetValue="100"--}}
                    {{--data-readOnly=true--}}
                    {{--data-fgColor="#fff"--}}
                    {{--data-bgColor="#ccc"--}}
            {{--/>--}}

                {{--<div class="circle gray light">--}}
                    {{--<span class="title">Хирургия</span>--}}
                    {{--<span class="pie_value" id="bh_value">%</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="content-section-a">
    <div class="container most-useful-services">
        <div class="row">
            <div class="col-lg-4">
                <div class="animated">
                    <img class="img-circle" src="/images/index/bleach.png" alt="Generic placeholder image" width="300" height="300">
                    <h2>{{$firstArticle->getH1()}}</h2>
                    <p>{!! $firstArticle->getText() !!}</p>
                </div>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="animated">
                    <img class="img-circle" src="/images/index/healthCare.png" alt="Generic placeholder image" width="300" height="300">
                    <h2>{{$secondArticle->getH1()}}</h2>
                    <p>{!! $secondArticle->getText() !!}</p>
                </div>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="animated">
                    <img class="img-circle" src="/images/index/implants.png" alt="Generic placeholder image" width="300" height="300">
                    <h2>{{$thirdArticle->getH1()}}</h2>
                    <p>{!! $thirdArticle->getText() !!}</p>
                </div>
            </div><!-- /.col-lg-4 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="/services/" class="more">Узнать больше об услугах</a>
            </div>
        </div>
    </div>
</div>