@extends('master')

	@section('content')

		<div class="container">
			
			<div class="row">
				<legend style="color:red">List Records Error</legend>

				<table class="table table-hover">
							
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php $no = 1; ?>
					@foreach($record_err as $record)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$record['name']}}</td>
							<td>{{$record['email']}}</td>
							<td>{{$record['password']}}</td>
							<td>{{$record['status']}}</td>
							
						</tr>

					@endforeach	
					</tbody>

				</table>
			</div>	
			<a  href="{{route('admin_company',$id) }}" class="btn btn-info"> OK </a>
						
		</div>


	@endsection