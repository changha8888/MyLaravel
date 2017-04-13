<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

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
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			
		</div>
	</nav>

	<?php 

	?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="{{url('login')}}" method="POST" role="form">
						<legend>{{ __('language.login') }}</legend>

						<div class="form-group">
							<label for="">{{ __('language.email') }}</label>
							<input type="text" class="form-control" id="email" placeholder="{{ __('language.email') }}" name="email">
							@if($errors->has('email'))
								<p style="color:red">{{$errors->first('email')}}</p>
							@endif	

						</div>

						<div class="form-group">
							<label for="">{{ __('language.password') }}</label>
							<input type="password" class="form-control" id="password" placeholder="{{ __('language.password') }}" name="password">
							@if($errors->has('password'))
								<p style="color:red">{{$errors->first('password')}}</p>
							@endif	

						</div>
					
						{{csrf_field()}}

						<div class="checkbox">

							<label><input type="checkbox" value="remember">{{ __('language.remember_me') }}</label>

						</div>

						<button type="submit" class="btn btn-primary">{{ __('language.login') }}</button>
						@if($errors->has('errorlogin'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							{{$errors->first('errorlogin')}}
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>




		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>