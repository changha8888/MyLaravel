@extends('master')

	@section('content')
						@if (session('message'))

							<div class="alert alert-success">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message')}}

							</div>

						@endif

      <a href="{{route('addcompany')}}" class="btn btn-primary">Add Company</a>


  	<table class="table table-striped">

  			<tr>
  				<th>No.</th>
  				<th>Name Company</th>
  				<th>Description</th>
  				<th>Admin Email</th>  				
  				<th>Action</th>
  			</tr>

  		<?php $no=1; ?>

  		@foreach($company as $com)
  			<tr>
  				<td>{{$no++}}</td>
  				<td>{{$com->name_company}}</td>
  				<td>{{$com->description}}</td>
  				<td>{{$com->email}}</td>
  				<td>
	  				<form action="{{route('deletecompany',$com->id_company)}}" method="get" role="form">
  						<a href="{{route('viewcompany',$com->id_company)}}" class="btn btn-primary">View</a>
              <a href="{{route('editcompany',$com->id_company)}}" class="btn btn-primary">Edit</a>
  						<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');">Delete</button>
  					</form>
  				</td>

  			</tr>
  		@endforeach	

  	</table>

	@endsection			        
