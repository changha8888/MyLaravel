@extends('master')

	@section('content')


<div class="container-fluid">	
	<div class="col-md-6">
		<form action="{{route('updatecompany')}}" method="POST" role="form">

			<legend>{{ __('language.company') }}</legend>

				<div class="form-group">
					<label for="">{{ __('language.name_company') }}</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Company name" value="{{$company[0]->name}}">
					@if($errors->has('name'))
							<p style="color:red">{{$errors->first('name')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">{{ __('language.description') }}</label>
					
					<textarea name="description" id="description" class="form-control" rows="3" placeholder="{{ __('language.description') }}">{{$company[0]->description}}</textarea>
					@if($errors->has('description'))
							<p style="color:red">{{$errors->first('description')}}</p>
					@endif	
				</div>

				<div class="form-group">
					<label for="">{{ __('language.email_admin_company') }}</label>
					<input type="text" name="email" class="form-control" id="email" value="{{$company[0]->email}}">
					@if($errors->has('email'))
							<p style="color:red">{{$errors->first('email')}}</p>
					@endif	
				</div>

				 <input type="hidden" name="id_company" value="{{$company[0]->id_company}}">

					{{csrf_field()}}

			<button type="submit" class="btn btn-primary">{{ __('language.save') }}</button>
		</form>

	</div>



</div>


@endsection			        
