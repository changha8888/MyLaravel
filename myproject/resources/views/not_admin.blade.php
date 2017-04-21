@extends('master')

	@section('content')

		
		  	<table class="table table-striped">
			      <tr>
			        <th>No.</th>
				        <th>{{ __('language.name') }}</th>
				        <th>{{ __('language.email') }}</th>
				        <th>{{ __('language.role') }}</th>
				        <th>{{ __('language.login_couter') }}</th>
				       
			      </tr>
			      
			      <?php $no=1; ?>
			    @foreach($users as $user)
			        <tr>
			          <td>{{$no++}}</td>
			          <td>{{$user->name}}</td>
			          <td>{{$user->email}}</td>
			          <td>{{$user->permission}}</td> 
			          <td>{{$user->count_login}}</td>       


			        </tr>

			    @endforeach
			    
			</table>    

	@endsection			        