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

						</div>

						<div class="form-group">
							<label for="">{{ __('language.email') }}</label>
							<input type="text" class="form-control" id="email" placeholder="Email" name="email">

						</div>

						<div class="form-group">
							<label for="">{{ __('language.password') }}</label>
							<input type="password" class="form-control" id="password" placeholder="{{ __('language.password') }}" name="password">

						</div>
						<div class="form-group">
							<label for="">{{ __('language.confirm_password') }}</label>
							<input type="password" class="form-control" id="password_confirm" placeholder="{{ __('language.confirm_password') }}" name="password_confirm">

						</div>
					
						{{csrf_field()}}

						@if (session('message'))

							<div class="alert alert-success">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message')}}

							</div>

						@endif

						@if (session('message_fail'))

							<span><p style="color:red"> {{session('message_fail')}} </p></span>

						@endif	


						<button type="submit" class="btn btn-primary">{{ __('language.register') }}</button>
						
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript">
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
			
		</script>

@endsection	