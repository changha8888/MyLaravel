@extends('master')

	@section('content')

	<div class="container">
		<div class="col-md-6">
		
			<legend>User Information</legend>

				<table class="table table-hover">
					
						<tr>
							<th>Name</th>
							<td>{{$user[0]->name}}</td>
						</tr>
						<tr>
							<th>Email</th>
							<td>{{$user[0]->email}}</td>
						</tr>
						<tr>
							<th>Company</th>
							<td>{{$user[0]->name_com}}</td>
						</tr>
						<tr>
							<th>Company Description</th>
							<td>{{$user[0]->description}}</td>
						</tr>
					
				</table>

		</div>
	</div>

	@endsection