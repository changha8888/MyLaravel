@extends('master')

	@section('content')

		
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					
					
					<ul class="nav navbar-nav navbar-right">
					
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{url('logout')}}">Logout</a></li>
								
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		  	<table class="table table-striped">
			      <tr>
			        <th>ID</th>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Role</th>
			        <th>Action</th>
			      </tr>
			      
			      <?php $no=1; ?>
			    @foreach($users as $user)
			        <tr>
			          <td>{{$no++}}</td>
			          <td>{{$user->name}}</td>
			          <td>{{$user->email}}</td>
			          <td>{{$user->role}}</td>      
			          <td>
			          <form class="" action="{{route('home.destroy',$user->id)}}" method="post">
			              <input type="hidden" name="_method" value="delete">
			              <input type="hidden" name="_token" value="{{ csrf_token() }}">
			              <a href="{{route('home.edit',$user->id)}}" class="btn btn-primary">Permission</a>
			              <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');" name="name" value="delete">

			            </form>
			          </td>

			        </tr>

			    @endforeach
			    
			</table>    

	@endsection			        