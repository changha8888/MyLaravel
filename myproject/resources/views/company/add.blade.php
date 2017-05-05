@extends('master')

	@section('content')


<div class="container-fluid">	
	
	<form action="{{url('registercompany')}}" method="POST" role="form">
		<div class="col-md-6">
			<legend>Company</legend>

		
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company name">
					@if($errors->has('company_name'))
							<p style="color:red">{{$errors->first('company_name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Description</label>
					
					<textarea name="company_description" id="company_description" class="form-control" rows="3" placeholder="Description company"></textarea>
					@if($errors->has('company_description'))
							<p style="color:red">{{$errors->first('company_description')}}</p>
					@endif	
				</div>

				
					{{csrf_field()}}
			</div>

			<div class="col-md-6">
				<legend>Admin Company</legend>

				
				<div class="form-group">
					<label for="">Admin Name</label>
					<input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Admin name">
					@if($errors->has('admin_name'))
							<p style="color:red">{{$errors->first('admin_name')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">Admin Email</label>
					<input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="Admin Email">
					@if($errors->has('admin_email'))
							<p style="color:red">{{$errors->first('admin_email')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Password">
					@if($errors->has('password'))
							<p style="color:red">{{$errors->first('password')}}</p>
					@endif	
				</div>
				<div class="form-group">
					<label for="">Confirm Password</label>
					<input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirm Password">
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
			<button type="submit" class="btn btn-primary">Add Company</button>
	</form>



</div>



	@endsection			  	