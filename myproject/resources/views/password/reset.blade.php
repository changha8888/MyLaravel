@extends("master")
	@section('content')


	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('language.reset_password') }}</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('resetpass',['email' => $email, 'code' => $code ]) }}">
                        {{ csrf_field() }}
                 
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">{{ __('language.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus disabled>

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ __('language.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if($errors->has('password'))
							<p style="color:red">{{$errors->first('password')}}</p>
								@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">{{ __('language.confirm_password') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirm" required>

                                @if($errors->has('password_confirm'))
							<p style="color:red">{{$errors->first('password_confirm')}}</p>
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('language.reset_password') }}
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
