@extends('master')

	@section('content')

<div class="container-fluid">	
	<div class="col-md-6">
		<form action="{{url('registercompany')}}" method="POST" role="form">

			<legend>Company</legend>

		
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Company name">
					@if($errors->has('name'))
							<p style="color:red">{{$errors->first('name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Description</label>
					
					<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description company"></textarea>
					@if($errors->has('description'))
							<p style="color:red">{{$errors->first('description')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Admin Company</label>

					<select name="admin" class="selectpicker form-control">

						<option value="">Select User Admin</option>

						@foreach ($data as $key => $value)

							<option value="{{$value->id}}">{{$value->name }} | {{$value->email}}</option>
						@endforeach

					</select>
					@if($errors->has('admin'))
								<p style="color:red">{{$errors->first('admin')}}</p>
							@endif	
					</div>

					{{csrf_field()}}

			<button type="submit" class="btn btn-primary">Add Company</button>
		</form>

	</div>

</div>

<script type="text/javascript">
	
$('.btn').click(function() {
	var data = $('textarea[name=description]').val();

	console.log(data);

});

</script>

	@endsection			  	