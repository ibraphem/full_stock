<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{__('FLEXIBLEPOS v2.0')}}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/css/dataTables.bootstrap.min.css')}}">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
	<link href="{{ asset('/dist/css/AdminLTE.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<!-- page wise style -->
	@yield('page-style')
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	@if(!empty(setting('fevicon_path')))
        <link rel="icon" href="{{asset(setting('fevicon_path'))}}"  />
	@else
		<link rel="icon" href="{{asset('images/logo-top.png')}}"  />
	@endif

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	@include('partials.optional')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('partials.navbar')
			@include('partials.sidebar')
			<div id="app">
				@yield('content')
			</div>
		@include('partials.footer')
		<div class="control-sidebar-bg"></div>
		<script src="{{asset('js/app.js')}}"></script>
		<script src="{{asset("/js/filesaver.js")}}"></script>
		<script src="{{asset("/js/jquerywordexport.js")}}"></script>
		<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
		@yield('script')
	</div>
</body>
</html>
