<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use App\Users;
// use App\Roles;

use DB;



class LoginController extends Controller
{
    //

    public function __construct(){
        $this->middleware('loginform');
    }
    
    public function getLogin(){
    	return view('login');
    }


    public function apiLogin(Request $request) {


        $email      = $request->input('email');
        $password   = $request->input('password');
        

        $user = Users::where('email', $email)->first();
        

        if (!\Hash::check($password, $user->password)) {
            return response(['error' => 'No user found!'], 400); 
        }
        
        $user->api_token = hash_hmac('sha256', str_random(40), config('app.key'));
        $user->save();

        return response(['token' => $user->api_token], 200);
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

                $role           = Users::where('email',$request->email)->first()->role;
                $id_company     = Users::where('email',$request->email)->first()->id_company;
                $id_user        = Users::where('email',$request->email)->first()->id;
               
                

                if($role == 1){

                    return redirect()->route('home');
                }
                if($role == 2){
                    return redirect()->route('admin_company',['id_company'=>$id_company]);
                }

                if($role == 4){
                    return redirect()->route('normaluser',['id'=>$id_user]);
                }            
    		}else{
    			$errors = new MessageBag(['errorlogin'=>'wrong email or password']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }


    public function getLoginQR(){
        return view('qr-login');
    }

    public function postLoginQR(Request $request){

        $code       = $request->code;
        $user       = Users::where('qrcode',$code)->first();     
        $role       = Users::where('qrcode',$code)->value('role');
        $id_user    = Users::where('qrcode',$code)->value('id');
        $id_company = Users::where('qrcode',$code)->value('id_company');

        if($user){
            
            Auth::login($user);

            if($role == 1){
                return redirect()->route('home');
            }
            if($role == 2){   
                return redirect()->route('admin_company',['id_company'=>$id_company]);  
            }
            if($role == 4){      
                return redirect()->route('normaluser',['id'=>$id_user]);     
            }
        } else{
            return redirect()->back()->with('message','Qr Code Login Fail !!!');
           
        }         
    }


    public function dataapi($id){

        // $id = $request->input('id');
        

        $user = DB::table('users')->where('id', $id)->first();

        return response()->json($user);
    }
}
