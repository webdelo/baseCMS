<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/admin/controlPanel.css') }}" rel="stylesheet">
	{{--<link rel="stylesheet" href="{{ asset('/build/css/intlTelInput.css') }}">--}}

	<!-- Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Exo+2:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link href='{{ asset('/js/lightbox/css/lightbox.css') }}' rel='stylesheet' type='text/css'>
	<script src="/js/lightbox/lightbox.min.js"></script>

	<script src="/js/admin/settings.js"></script>

	<script src="/js/admin/fileUploader.js"></script>
	<script src="/js/admin/sorting.js"></script>
	{{--<script src="/build/js/intlTelInput.js"></script>--}}
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
	<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
	<script src="/js/admin/ckEditor.init.js"></script>

	<script src="/js/jquery/timepicker/jquery.datetimepicker.full.js"></script>
	<link rel="stylesheet" href="/js/jquery/timepicker/jquery.datetimepicker.css">

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
	<script src="/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
	{{--<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-route.js"></script>--}}
	{{--<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-animate.js"></script>--}}

	<script src="/bower_components/intl-tel-input/build/js/intlTelInput.js"></script>
	<link rel="stylesheet" href="/bower_components/intl-tel-input/build/css/intlTelInput.css">
	<script src="/bower_components/intl-tel-input/lib/libphonenumber/build/utils.js"></script>
	<script src="/bower_components/international-phone-number/releases/international-phone-number.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Rusanna billing</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/admin/') }}">Главная</a></li>
					<li><a href="{{ url('/admin/articles/') }}">Статьи</a></li>
					<li><a href="{{ url('/admin/services/') }}">Услуги</a></li>
					<li><a href="{{ url('/admin/employees/') }}">Сотрудники</a></li>
					<li><a href="{{ url('/admin/gallery/') }}">Галерея</a></li>
					<li><a href="{{ url('/admin/patients/') }}">Пациенты</a></li>
					<li><a href="{{ url('/admin/visits/') }}">Посещения</a></li>
					<li><a href="{{ url('/admin/schedule/') }}">Расписание</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
{{--						<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
{{--						<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Выход</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')


	<div class="content-section footer">
		<div class="container">
			<div class="copy">Developed by Dmitri Cercel &copy; 2015</div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
