<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;

class LanguageController extends Controller
{


    public function set_lang(Request $request){

    	$locale = $request->lang;
        Session::put('locale',$locale);

        return redirect(url(URL::previous()));
    } 

//     public function set_lang(Request $request){
        
//         $lang = session()->has('lang') ? $request->input('lang') : "en";

// // \App::setlocale($request->lang);
//         session()->put('lang',$lang);
//         // dd(session()->get('lang'));
//         // return view('login');
//         return redirect(url(URL::previous()));
//     }   

}
