@extends('master')

	@section('content')


<div class="container-fluid">	
	<div class="col-md-6">
		<form action="{{route('updatecompany',['id_company' => $data['id_company'],'id_admin_cur' => $data['id_admin']])}}" method="POST" role="form">

			<legend>Company</legend>

				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Company name" value="{{$data['name']}}">
					@if($errors->has('name'))
							<p style="color:red">{{$errors->first('name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Description</label>
					
					<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description company">{{$data['description']}}</textarea>
					@if($errors->has('description'))
							<p style="color:red">{{$errors->first('description')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">Admin Company</label>

					<select name="admin" class="selectpicker form-control">

						
						<option value="{{$data['id_admin']}}">{{$data['email']}}  ---  Admin</option>


						@foreach ($user as $key => $value)

							<option value="{{$value->id}}">{{$value->name }} | {{$value->email}}</option>
						@endforeach

					</select>
					@if($errors->has('admin'))
								<p style="color:red">{{$errors->first('admin')}}</p>
							@endif	
					</div>

					{{csrf_field()}}

			<button type="submit" class="btn btn-primary">Save</button>
		</form>

	</div>

</div>


@endsection			        
