<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use URL;
use session;

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



public function TestController(){

return view('search');
}

public function ButtonController(Request $abc){


dd($abc->all());


}

public function LangController(Request $request){




$value =  $request->input('lang');
session(['lang_session' => $value]);
$abv = session('lang_session');


\App::setLocale($abv);
 
return redirect()->back();


	// $lang = Input::get('lang_ajax');

	//  session(['lang_session' => $lang]);
	//  $value = session('lang_session');

	// \App::setLocale($value);

	// echo $value;

	// return \App::getLocale();
	// echo 'fasdfsadf';

// \App::setLocale($lang);

// return redirect(url(URL::previous()));
}



}
