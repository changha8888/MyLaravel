@extends('master')

	@section('content')


		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="{{route('updateuser')}}" method="POST" role="form" id="form-register">
						<legend>Edit User</legend>

						<div class="form-group">
							<label for="">{{ __('language.name') }}</label>
							<input type="text" class="form-control" id="name" placeholder="{{ __('language.name') }}" name="name" value="{{$user->name}}">
							@if($errors->has('name'))
								<p style="color:red">{{$errors->first('name')}}</p>
							@endif	

						</div>

						<div class="form-group">
							<label for="">{{ __('language.email') }}</label>
							<input type="text" class="form-control" id="email" placeholder="{{ __('language.email') }}" name="email" value="{{$user->email}}">
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

						 <input type="hidden" name="id_user" value="{{$id_user}}">
						 <input type="hidden" name="id_company" value="{{$id_company}}">
						
					
						{{csrf_field()}}


						<button type="submit" class="btn btn-primary">Save</button>

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





	@endsection			        
