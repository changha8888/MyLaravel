<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\Tool;
use Alert;
class ToolController extends Controller
{
  public function Index(){
    $company_id = Auth::user()->id_company;
    // $tools = Tool::select('id','name','description','order')
    // ->where('company_id',$company_id)
    // ->orderBy('id','DESC')
    // ->paginate(5);

    // return view('tool.index', compact('tools'));
    $search = \Request::get('search');
    $tools = Tool::where('name','like', '%'.$search.'%')
    ->where('company_id',$company_id)
    ->orderBy('id')
    ->paginate(10);
    return view('tool.index', compact('tools'));
  }

  public function getAdd(){
   return view('tool.add');
 }
 public function postAdd(Request $request){
  $rules = [
  'name'                => 'required',
  'description'               => 'required',
  'location'            => 'required'
  ];
  $validator = Validator::make($request->all(),$rules);

  if($validator->fails()){
    return redirect()->back()->withErrors($validator);
  }else{

    $name = $request->input('name');
    $description = $request->input('description');
    $location = $request->input('location');
    $company_id = Auth::user()->id_company;

    DB::table('tool_manage')->insert([

      'name'          => $name,
      'description'   => $description,
      'order' => $location,
      'file' => '1',
      'company_id'    => $company_id,
      ]);
    $notification = array(
      'message' => 'Insert Successfully ',
      'alert-type' => 'success'
      );
    return redirect()->route('tool')->with($notification);
  }
}
public function getEdit($id){
 $tool = Tool::findOrFail($id);
 return view('tool.edit',compact('tool'));

}
public function postEdit(Request $request, $id){

 $rules = [
 'name'                => 'required',
 'description'               => 'required',
 'location'            => 'required'
 ];
 $validator = Validator::make($request->all(),$rules);

 if($validator->fails()){
  return redirect()->back()->withErrors($validator);
}else{

  $name = $request->input('name');
  $description = $request->input('description');
  $location = $request->input('location');
  $company_id = Auth::user()->id_company;

  DB::table('tool_manage')->where('id',$id)
  ->update(['name' => $name ,
   'description' => $description ,
   'order' =>$location]
   );
  $notification = array(
    'message' => 'Update Successfully ',
    'alert-type' => 'success'
    );
  return redirect()->route('tool')->with($notification);
}

}
public function getDelete(Request $request, $id){
 $tool = Tool::findOrFail($id);
 $tool->delete();
 $notification = array(
  'message' => 'Delete Successfully ',
  'alert-type' => 'success'
  );
 return redirect()->route('tool')->with($notification);

}

}
