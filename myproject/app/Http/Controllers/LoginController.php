<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use App\Users;
use App\Roles;

use DB;



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
            
       

    		if( Auth::attempt(['email' => $email,'password' => $password], $remember)){

                $id_user        = Users::where('email',$request->email)->first()->id;
                $count_login    = Roles::where('id',$id_user)->first()->count_login;
                $role           = Roles::where('id',$id_user)->first()->permission;
                
    

                    DB::table('roles')
                        ->where('id',$id_user )
                        ->update(['count_login' => $count_login + 1 ]);

                if($role == 1){

                    return redirect()->intended('/');

                }else{
                    return redirect()->intended('/not_admin');
                }

            
    		}else{
    			$errors = new MessageBag(['errorlogin'=>'wrong email or password']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }



    public function postRegister(Request $request){

     	$rules = [
     		'name'                => 'required',
    		'email'               => 'required|email',
    		'password'            => 'required|min:6',
            'password_confirm'    => 'required|same:password'

    	];
    	
    	$validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
        }    

    	else{

    		// $users = new Users;

    		// $users->name      = $request->name;
    		// $users->email     = $request->email;
    		// $users->password  = bcrypt($request->password);
    		// $users->save();
            $user = Users::where('email', '=', $request->email)->first();
            if ($user === null) {
                $id = DB::table('users')->insertGetId( 
                    array(
                        'name' => $request->name,
                        'email' => $request->email,
                        'password'=> bcrypt($request->password),
                        )
                );

                DB::table('roles')->insert(['id' => $id, 'permission' => 4]);

                return redirect('login')->with('message','Register Success !!!');

            } else {

                return redirect()->back()->with('message_fail', 'exist');
            }    

    	}
	
    }


    // public function getLogout(){
    //     Auth::logout();
    //     return redirect('login');
    // }


}
