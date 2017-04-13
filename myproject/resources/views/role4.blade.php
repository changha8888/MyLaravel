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
		<h2> Display something ROLE 4 </h2>

@endsection	
