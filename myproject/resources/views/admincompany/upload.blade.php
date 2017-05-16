@extends('master')
	@section('content')

	<div class="container">
		
		<div class="row">

		
		<form action="{{route('importUser')}}" method="POST" enctype="multipart/form-data" role="form">

			<label>Upload file</label>
			<input type="file" name="file" class="file">
			<input type="hidden" value="{{$id}}" name="id" />
			<input type="hidden" value="{{ csrf_token() }}" name="_token" /><br>
			<input type="submit" name="upload" class="upload btn btn-info" value="Import"> 

		</form>

		</div>

	</div>


	@endsection