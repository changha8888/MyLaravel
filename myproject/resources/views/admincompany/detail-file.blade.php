@extends('master')

	@section('content')

		<div class="container">
			
			<div class="row">
				<legend style="color:red">Users Error</legend>

				<table class="table table-hover">
							
					<thead>
						<tr>
							<th>Row</th>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Status </th>

						</tr>
					</thead>
					<tbody>

					@foreach($error_users as $record)

						<tr>
							<td>{{$record->id_excel_file}}</td>
							<td>{{$record->name}}</td>
							<td>{{$record->email}}</td>
							<td>{{$record->password}}</td>
							<td>{{$record->status}}</td>
							
							
						</tr>


					@endforeach	
					</tbody>

				</table>
				{{ $error_users->links() }}
			</div>	
			<a  href="{{route('admin_company',$id_company) }}" class="btn btn-info"> OK </a>
						
		</div>


	@endsection