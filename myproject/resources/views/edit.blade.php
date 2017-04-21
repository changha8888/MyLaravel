@extends('master')

	@section('content')

<div class="container">
	<div class="row">
		<h4>{{ __('language.edit_role') }}</h4>

		<form class="" action="{{route('home.update',$permission->id)}}" method="post">

		        <?php $role = $permission->permission; ?>
		        <input name="_method" type="hidden" value="PATCH">
		     	{{csrf_field()}}
			    <div class="radio-inline">
			      	<label><input type="radio" name="role" value="1" <?php echo ($role == 1) ? "checked":''; ?> >Role 1</label>
			    </div>
			    <div class="radio-inline">
			      	<label><input type="radio" name="role" value="2" <?php echo ($role == 2) ? "checked":''; ?> >Role 2</label>
			    </div>
			    <div class="radio-inline">
			      	<label><input type="radio" name="role" value="3" <?php echo ($role == 3) ? "checked":''; ?> >Role 3</label>
			    </div>
			    <div class="radio-inline">
			      	<label><input type="radio" name="role" value="4" <?php echo ($role == 4) ? "checked":''; ?> >Role 4</label>
			    </div>
			    <div class="form-group">
		        	<input type="submit" class="btn btn-primary" value="{{ __('language.save') }}">		

		    	</div>
    	</form>
	</div>
</div>	
@endsection	