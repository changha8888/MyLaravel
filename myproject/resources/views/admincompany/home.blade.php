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
		<div class="col-md-6">
			<form>
			
				<legend>{{$company->name}}</legend>

				<a href="{{route('register',$company->id_company)}}" class="btn btn-primary">Register User</a>

				<a href="{{url('upload',$company->id_company)}}" class="btn btn-info">Upload File</a>


				<a href="{{url('log-upload/'.$company->id_company)}}" class="btn btn-warning">Log Upload File</a>



				<!-- <a href="{{url('error-file',$company->id_company)}}" class="btn btn-danger">Log</a> -->

			</form>
		</div>
	</div>

	<div class="row">
		<form>
			<legend>Users Company</legend>

			<table class="table table-hover">
			<?php $no = 1; ?>

				<thead>
					<tr>
						<!-- <th>No.</th> -->
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				@foreach($users_company as $user)

					<tr>
						<!-- <td>{{$no++}}</td> -->
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>

						<td>
							<form action="" method="get">
					            <a href="{{route('edituser',['id_user'=>$user->id,'id_company'=>$user->id_company])}}" class="btn btn-primary">Edit</a>

					            <a href="{{route('deleteuser',['id_user'=>$user->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');">{{ __('language.delete') }}</a>

				            </form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			{{ $users_company->links() }}
		</form>
	</div>
</div>





	@endsection
