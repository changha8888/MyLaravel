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
				        <th>{{ __('language.name') }}</th>
				        <th>{{ __('language.email') }}</th>
				        <th>{{ __('language.role') }}</th>
				        <th>{{ __('language.login_couter') }}</th>
				        <th>{{ __('language.action') }}</th>
			        </tr>
			      
			      <?php $no=1; ?>
			    @foreach($users as $user)
			        <tr>
				        <td>{{$no++}}</td>
				        <td>{{$user->name}}</td>
				        <td>{{$user->email}}</td>
				        <td>{{$user->permission}}</td> 
				        <td>{{$user->count_login}}</td>       

			            <td>
				          	<form class="" action="{{route('home.destroy',$user->id)}}" method="post">
					            <input type="hidden" name="_method" value="delete">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
					            <!-- <a href="{{route('home.edit',$user->id)}}" class="btn btn-primary">{{ __('language.role') }}</a> -->
					            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');" name="name" value="{{ __('language.delete') }}">

				            </form>
			          	</td>

			        </tr>

			    @endforeach


			    <table class="table table-hover">
			    	<thead>
			    		<tr>
			    			<th>No.</th>
			    			<th>Name Company</th>
			    			<th>Description</th>
			    			<th>Admin Company</th>
			    			<th>Action</th>

			    		</tr>
			    	</thead>
			    	<tbody>

	    		 <?php $no_=1; ?>
			    	@foreach($company as $data)

			    		<tr>
			    			<td>{{$no_++}}</td>
			    			<td>{{$data->name}}</td>
			    			<td>{{$data->description}}</td>
			    			<td>{{$data->email}}</td>

			    		
			    			<td>
				          		<form class="" action="{{route('deletecompany')}}" method="get">
						            <input type="hidden" name="id_company" value="{{$data->id_company}}">
						            <input type="hidden" name="id_admin" value="{{$data->id}}">
						            <input type="hidden" name="_token" value="{{ csrf_token() }}">
						            <a href="{{route('editcompany',['name' =>$data->name,'description' =>$data->description,'email' =>$data->email,'id_company' =>$data->id_company,'id_admin' =>$data->id])}}" class="btn btn-primary">Edit</a>
						            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');" name="name" value="Delete">

				            	</form>
			          		</td>

			    		</tr>

			    	@endforeach	
			    	</tbody>
			    </table>



	@endsection			        
