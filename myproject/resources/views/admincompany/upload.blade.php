@extends('master')
	@section('content')

	<div class="container">
		
		<div class="row">

			<div class="col-md-6">		
				<form action="{{route('importUser')}}" method="POST" enctype="multipart/form-data" role="form">

					<label>Upload file</label>
					<input type="file" name="file" class="file">
					<input type="hidden" value="{{$id}}" name="id_company" />
					<input type="hidden" value="{{ csrf_token() }}" name="_token" /><br>
					<input type="submit" name="upload" class="upload btn btn-info" value="Import"> 

				</form>
				
				@if (session('message'))

		            <br>
		            <div class="alert alert-danger">

		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		           
		                {{session('message')}}
		            </div>
		          
		        @endif  

			</div>	

		</div>
  

	</div>


	@endsection