@extends('master')

	@section('content')


<div class="container">

	<div class="row">
		<form>
			<legend>List User Company</legend>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>

					</tr>
				</thead>
				<tbody>
				<?php $no = 1; ?>
				@foreach($user_company as $user)
					<tr>
						<td>{{$no++}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>@if($user->role == 2) Admin User @else Normal User @endif</td>
					</tr>

				@endforeach	
				</tbody>
			</table>
			


		</form>
	</div>	

</div>


	@endsection