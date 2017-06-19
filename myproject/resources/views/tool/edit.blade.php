@extends('master')
@section('tool','active')
@section('page_header','ToolManagament')
@section('action','add')
@section('content')

<div class="box box-primary">
  <div class="box-header with-border">
    <!-- <h3 class="box-title">Quick Example</h3> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{!! $tool->name !!}">
        @if($errors->has('name'))
                <p style="color:red">{{$errors->first('name')}}</p>
        @endif
      </div>
      <div class="form-group">
        <label>Description</label>
        <input type="text" class="form-control" id="description" name="description" value="{!! $tool->description !!}">
        @if($errors->has('description'))
                <p style="color:red">{{$errors->first('description')}}</p>
        @endif
      </div>
      <div class="form-group">
        <label for="">Position</label>
        <input type="text" class="form-control" id="location" name="location" value="{!! $tool->order !!}">
        @if($errors->has('location'))
                <p style="color:red">{{$errors->first('location')}}</p>
        @endif
      </div>
      <div class="form-group">

        <p class="help-block">Example block-level help text here.</p>
        <input type="file" name="file_upload" id="file_upload" />
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>

@endsection
