@extends('master')
@section('tool','active')
@section('page_header','ToolManagament')
@section('action','index')
@section('content')
<div class="col-xs-12">
  <a href="{{route('getAddTool')}}" class="btn btn-success">Add Tool</a>
  <div class="box">
  <form action="" method="GET" role="search">
    <div class="box-header">
      <h3 class="box-title">Responsive Hover Table</h3>
      
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="search" class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tbody><tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Position</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        @foreach($tools as $tool)
        <tr>
          <td>{!! $tool->id !!}</td>
          <td>{!! $tool->name !!}</td>
          <td>{!! $tool->description!!}</td>
          <td>{!! $tool->order!!}</td>
          <td><a href="{!! route('getEditTool',['id'=>$tool->id]) !!}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><a href="{!! route('getDeleteTool',['id'=>$tool->id]) !!}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        @endforeach
      </tbody>

    </table>
    {{ $tools->links() }}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>

@endsection