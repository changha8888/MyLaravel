@extends('master')

	@section('content')
						@if (session('message'))

							<div class="alert alert-success">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message')}}

							</div>

						@endif

						@if (session('message_fail'))

							<div class="alert alert-danger">
								
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{session('message_fail')}}

							</div>

						@endif


		<div class="container">
		    <div class="row">
		        <div class="col-md-8 col-md-offset-2">
		            <div class="panel panel-default">
		                <div class="panel-heading">{{ __('language.reset_password') }}</div>
		                <div class="panel-body">
		                    @if (session('status'))
		                        <div class="alert alert-success">
		                            {{ session('status') }}
		                        </div>
		                    @endif

		                    <form class="form-horizontal" role="form" method="POST" action="{{route('forgot-password')}}">
		                        {{ csrf_field() }}

		                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                            <label for="email" class="col-md-4 control-label">{{ __('language.email') }}</label>

		                            <div class="col-md-6">
		                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <div class="col-md-6 col-md-offset-4">
		                                <button type="submit" class="btn btn-primary">
		                                    {{ __('language.send_link_reset') }}
		                                </button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>	
		</div>

	@endsection