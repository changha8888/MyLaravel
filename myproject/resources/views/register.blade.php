@extends('master')

	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="{{url('register')}}" method="POST" role="form" id="form-register">
						<legend>{{ __('language.register') }}</legend>

						<div class="form-group">
							<label for="">{{ __('language.name') }}</label>
							<input type="text" class="form-control" id="name" placeholder="{{ __('language.name') }}" name="name">
							@if($errors->has('name'))
								<p style="color:red">{{$errors->first('name')}}</p>
							@endif	

						</div>

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
						<div class="form-group">
							<label for="">{{ __('language.confirm_password') }}</label>
							<input type="password" class="form-control" id="password_confirm" placeholder="{{ __('language.confirm_password') }}" name="password_confirm">

							@if($errors->has('password_confirm'))
								<p style="color:red">{{$errors->first('password_confirm')}}</p>
							@endif
						</div>
					
						{{csrf_field()}}

						

						<button type="submit" class="btn btn-primary">{{ __('language.register') }}</button>

						@if (session('message_fail'))

						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Register fail, Email already exist !!!</strong> 
						</div>
						

						@endif	
						

						
					</form>
				</div>
			</div>
		</div>

		<!-- <script type="text/javascript">
		jQuery("#form-register").validate({
			rules:{
				name:{
					required:true,
					minlenth:3,
				},
				password:{
					required:true,
					minlenth:6,
				},
				password_confirm:{
					equalTo:"#password"
				},
				email:{
					required:true,
					email:true,
				}
			}
		});
			
		</script> -->

@endsection	