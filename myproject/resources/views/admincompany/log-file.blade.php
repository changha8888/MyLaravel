@extends('master')

	@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<legend>Log Files Upload </legend>

				<table class="table table-hover">

					<thead>
						<tr>
							<th>No.</th>
							<th>File Name</th>
							<th>Time </th>
							<th>Status</th>
						
						</tr>
					</thead>
					<tbody>
					<?php $no = 1 ?>
					@foreach($list_file as $value)

						<tr>
							<td>{{$no++}}</td>
							<td><a href="{{ url('file-detail/'.$id_company.'/'.$value->id.'/'.$value->file_name) }}"> {{$value->file_name}}</a></td>
							
							<td>{{$value->created_at}}</td>
							<td>{{$value->status}}</td>

							
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $list_file->links() }}
				<a  href="{{route('admin_company',$id_company) }}" class="btn btn-info"> OK </a>
			</div>
		</div>
	</div>


	@endsection