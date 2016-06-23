<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{{isset($metaDescription) ? $metaDescription : ''}}">
    <meta name="keywords" content="{{isset($metaKeywords) ? $metaKeywords : ''}}">
    <meta name="author" content="Dmitri Cercel">
    <link rel="icon" href="/bootstrap/favicon.ico">

    <title>{{isset($metaTitle) ? $metaTitle : 'Стоматологическая клиника "Русанна"'}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/dist/css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animated.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dent.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Exo+2:400,700,500,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/js/knob.js"></script>
    <script src="/js/waypoint.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/carousel.css') }}" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<body ng-app="test-app">
@include('header')

@yield('content')

@include('footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="/bootstrap/assets/js/vendor/holder.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
