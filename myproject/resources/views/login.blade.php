
	@extends('master')

	@section('content')
						@if (session('message'))

							<div class="alert alert-success">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message')}}

							</div>

						@endif

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

						<a class="btn btn-link" href="{{ url('/forgot-password') }}">
                            Forgot Password?
                        </a>
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




	@endsection			        