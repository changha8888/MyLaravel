<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    public function login_trans(Request $request, $locale){
    	\App::setlocale($locale);

    	return view('login');
    	// return view('test');
    	// dd(@lang('language.message'));

    }

    public function register_trans(Request $request, $locale){
    	\App::setlocale($locale);

    	return view('register');
    }    

}
