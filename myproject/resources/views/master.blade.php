<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="//code.jquery.com/jquery.js">\
		</script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
		<link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap-toggle.css')}}">
		<script type="text/javascript" src="{{asset('/js/bootstrap-toggle.js')}}"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>


			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">


				<li style="margin-top: 7px;">
					<form method="get" id='setlang' action="{{route('setlang')}}">
						<select name="lang" class="form-control" onchange="$('#setlang').submit();">

							<option @if (App::getLocale() == 'en') selected="selected" @endif value="en">English</option>
							<option @if (App::getLocale() == 'jp') selected="selected" @endif value="jp">Japan</option>
						</select> 
					</form>
				</li>


					@if(Auth::check())
					
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{url('logout')}}">{{__('language.logout')}}</a></li>	
							</ul>
						</li>

				 	@else

				 	<li><a href="{{ url('login') }}">{{ __('language.login') }}</a></li>
					<!-- <li><a href="{{ url('register') }}">{{ __('language.register') }}</a></li> -->

					@endif
				</ul>
	
			</div><!-- /.navbar-collapse -->


		</div>
	</nav>

	  @yield('content')

		<!-- jQuery -->
		<!-- <script src="//code.jquery.com/jquery.js"></script> -->
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	</body>
</html>