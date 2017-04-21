@extends('master')

	@section('content')

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
					            <a href="{{route('home.edit',$user->id)}}" class="btn btn-primary">{{ __('language.role') }}</a>
					            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');" name="name" value="{{ __('language.delete') }}">

				            </form>
			          	</td>

			        </tr>

			    @endforeach

			</table>  

			<table class="table">
				<thead>
					<tr>
						<th>{{__('language.role')}}</th>
						<th>{{__('language.name')}}</th>
			       		<th>{{__('language.email')}}</th>
			       		<th>Login Max</th>


					</tr>
				<?php 
				
				foreach($users as $user){

					if(!isset($arr[$user->permission]) ){

						$arr[$user->permission] = [
							'count' => $user->count_login,
							'name' 	=> $user->name,
							'email'	=> $user->email,
							'login' => $user->count_login];


					}elseif($arr[$user->permission]['count'] < $user->count_login){
						$arr[$user->permission] = [
							'count' => $user->count_login,
							'name' 	=> $user->name,
							'email'	=> $user->email,
							'login' => $user->count_login];
					}
				}	

				ksort($arr);
				foreach ($arr as $key => $value) {
				?>
				
						<tr>
							<td>{{$key}}</td>
							<td>{{$value['name']}}</td>
							<td>{{$value['email']}}</td>
							<td>{{$value['login']}}</td>
						</tr>
				<?php 		
					}	
				?>

			</table>


	@endsection			        