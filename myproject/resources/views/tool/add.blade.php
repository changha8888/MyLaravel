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
        <input type="text" class="form-control" id="name" name="name" placeholder="">
        @if($errors->has('name'))
        <p style="color:red">{{$errors->first('name')}}</p>
        @endif
      </div>
      <div class="form-group">
        <label>Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="">
        @if($errors->has('description'))
        <p style="color:red">{{$errors->first('description')}}</p>
        @endif
      </div>
      <div class="form-group">
        <label for="">Position</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="">
        @if($errors->has('location'))
        <p style="color:red">{{$errors->first('location')}}</p>
        @endif
      </div>
      <div class="form-group">
        <label for="fileimages" class="col-md-2">Hình ảnh</label>
        <div class="col-md-10"> 
          <!-- <input type="file" name="fileimages"> -->
          <input type="file" id="file_upload" name="file_upload" type="file" multiple="true">
          <input type="hidden" name="images" id="linkAvatar" value="">
          <p>
           <img id="previewavatar" style="max-width: 350px;  " name="images" />
         </p>
       </div>  
     </div>  
   </div>
   <!-- /.box-body -->

   <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>

@endsection
