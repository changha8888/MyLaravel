@extends('master')

	@section('content')


<div class="container-fluid">	
	
	<form action="{{url('registercompany')}}" method="POST" role="form">
		<div class="col-md-6">
			<legend>{{ __('language.company') }}</legend>

		
				<div class="form-group">
					<label for="">{{ __('language.name') }}</label>
					<input type="text" name="company_name" class="form-control" id="company_name" placeholder="{{ __('language.name_company') }}">
					@if($errors->has('company_name'))
							<p style="color:red">{{$errors->first('company_name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">{{ __('language.description') }}</label>
					
					<textarea name="company_description" id="company_description" class="form-control" rows="3" placeholder="{{ __('language.description') }}"></textarea>
					@if($errors->has('company_description'))
							<p style="color:red">{{$errors->first('company_description')}}</p>
					@endif	
				</div>

				
					{{csrf_field()}}
			</div>

			<div class="col-md-6">
				<legend>{{ __('language.admin_company') }}</legend>

				
				<div class="form-group">
					<label for="">{{ __('language.admin_name') }}</label>
					<input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="{{ __('language.admin_name') }}">
					@if($errors->has('admin_name'))
							<p style="color:red">{{$errors->first('admin_name')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">{{ __('language.email') }}</label>
					<input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="{{ __('language.admin_company') }}">
					@if($errors->has('admin_email'))
							<p style="color:red">{{$errors->first('admin_email')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">{{ __('language.password') }}</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="{{ __('language.admin_company') }}">
					@if($errors->has('password'))
							<p style="color:red">{{$errors->first('password')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">{{ __('language.confirm_password') }}</label>
					<input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="{{ __('language.confirm_password') }}">
					@if($errors->has('password_confirm'))
							<p style="color:red">{{$errors->first('password_confirm')}}</p>
					@endif	
				</div>
				
						@if (session('message_fail'))

						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Register fail, Email already exist !!!</strong> 
						</div>
						

						@endif	

			</div>
			<button type="submit" class="btn btn-primary">{{ __('language.create_company') }}</button>
	</form>



</div>



	@endsection			  	