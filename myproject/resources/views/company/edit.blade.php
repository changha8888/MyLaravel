@extends('master')

	@section('content')

<div class="container-fluid">	
	<div class="col-md-6">
		<form action="{{route('updatecompany')}}" method="POST" role="form">

			<legend>Company</legend>

				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Company name" value="{{$company->name}}">
					@if($errors->has('name'))
							<p style="color:red">{{$errors->first('name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Description</label>
					
					<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description company">{{$company->description}}</textarea>
					@if($errors->has('description'))
							<p style="color:red">{{$errors->first('description')}}</p>
					@endif	
				</div>
				 <input type="hidden" name="id_company" value="{{$company->id_company}}">

					{{csrf_field()}}

			<button type="submit" class="btn btn-primary">Save</button>
		</form>

	</div>

</div>


@endsection			        
