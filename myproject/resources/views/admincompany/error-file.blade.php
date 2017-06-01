@extends('master')

	@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<legend>File User Error </legend>
				@foreach($filename as $name)

					<a href="{{url('file-detail/'.$id_company.'/'.$name)}}">{{$name}}</a><br>	

				@endforeach	
			</div>
		</div>
	</div>


	@endsection