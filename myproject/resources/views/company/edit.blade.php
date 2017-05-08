@extends('master')

	@section('content')


<div class="container-fluid">	
	<div class="col-md-6">
		<form action="{{route('updatecompany')}}" method="POST" role="form">

			<legend>Company</legend>

				<div class="form-group">
					<label for="">Name Company</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Company name" value="{{$company[0]->name}}">
					@if($errors->has('name'))
							<p style="color:red">{{$errors->first('name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Description</label>
					
					<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description company">{{$company[0]->description}}</textarea>
					@if($errors->has('description'))
							<p style="color:red">{{$errors->first('description')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Email Admin Company</label>
					<input type="text" name="email" class="form-control" id="email" value="{{$company[0]->email}}">
					@if($errors->has('email'))
							<p style="color:red">{{$errors->first('email')}}</p>
					@endif	
				</div>

				 <input type="hidden" name="id_company" value="{{$company[0]->id_company}}">

					{{csrf_field()}}

			<button type="submit" class="btn btn-primary">Save</button>
		</form>

	</div>



</div>


@endsection			        
