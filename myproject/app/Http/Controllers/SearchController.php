<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    //

    public function index(){

    	return view('search');
    }

    public function search(Request $request){


$name = Input::get('name');

		// if($request->ajax()){

			$output ='';

			$data = DB::table('users')->where('name','LIKE','%'.$name.'%')->get();
		// }  

		if($data){
			foreach ($data as $key => $value) {
				$output .='<li>'.$value->name.'</li>';
			}
		}

		return Response($output);  

		// return response()->json($data);
// $custommers = DB::table('users')->where('name','LIKE','%'.$request->linh.'%')->get();


// 		dd( $custommers );
    }
}
