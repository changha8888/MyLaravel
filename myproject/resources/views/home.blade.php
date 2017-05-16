@extends('master')

	@section('content')
						@if (session('message'))

							<div class="alert alert-success">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message')}}

							</div>

						@endif

      <a href="{{route('addcompany')}}" class="btn btn-primary">{{ __('language.create_company') }}</a>


  	<table class="table table-striped">

  			<tr>
  				<th>No.</th>
  				<th>{{ __('language.name_company') }}</th>
  				<th>{{ __('language.description') }}</th>
  				<th>{{ __('language.admin_email') }}</th>  				
  				<th>{{ __('language.action') }}</th>
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
  						<a href="{{route('viewcompany',$com->id_company)}}" class="btn btn-primary">{{ __('language.view') }}</a>
              <a href="{{route('editcompany',$com->id_company)}}" class="btn btn-primary">{{ __('language.edit') }}</a>
  						<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');">{{ __('language.delete') }}</button>
  					</form>
  				</td>

  			</tr>
  		@endforeach	

  	</table>

	@endsection			        
