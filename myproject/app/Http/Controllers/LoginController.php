<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use App\Users;



class LoginController extends Controller
{
    //
    public function getLogin(){
    	return view('login');
    }

    public function getRegister(){

        return view('register');
    
    }

    public function postLogin(Request $request){


    	$rules = [

    		'email'       => 'required|email',
    		'password'    =>'required|min:6',

    	];
    	
    	$validator = Validator::make($request->all(),$rules);

    	if($validator->fails()){

    		return redirect()->back()->withErrors($validator);

    	}else {
    		$email 		= $request->input('email');
    		$password 	= $request->input('password');
    		$remember 	= $request->input('remember') ? true :false;
            $check      = Users::where('email',$request->email)->first();


    		if( Auth::attempt(['email' => $email,'password' => $password], $remember)){

            // check role user.   
             
                switch($check->role){

                    case 1: return redirect()->intended('/');
                    break;

                    case 2: return redirect()->intended('/role2');
                    break;

                    case 3: return redirect()->intended('/role3');
                    break;

                    case 4: return redirect()->intended('/role4');
                    break;
                }
            
    		}else{
    			$errors = new MessageBag(['errorlogin'=>'wrong email or password']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }

    

    public function postRegister(Request $request){

     	$rules = [
     		'name'        => 'required',
    		'email'       => 'required|email',
    		'password'    =>'required|min:6',

    	];
    	
    	$validator = Validator::make($request->all(),$rules);

    	if(!$validator->fails()){

    		$users = new Users;

    		$users->name      = $request->name;
    		$users->email     = $request->email;
    		$users->password  = bcrypt($request->password);
    		$users->save();

    		return redirect()->back()->with('message','Register Success !!!');

    	}else {

            return redirect()->back()->with('message','Register Fail !!!');
        }
	
    }





}
