<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Reminder;
use Mail;
use Sentinel;
use DB;
use Validator;

class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword(){

    	return view('password.forgot-password');
    }


    public function postForgotPassword(Request $request){

    	$user = Users::whereEmail($request->email)->first();


    	if(!$user){

    		return redirect()->back()->with(['message_fail'=>'Email not exist !!!']);

    	}else{

    		$sentinelUser = Sentinel::findById($user->id);

	    	$reminder = Reminder::exists($sentinelUser) ?:Reminder::create($sentinelUser);

	    	$this->sendEmail($user, $reminder->code);
	    	
	    	return redirect()->back()->with(['message'=>'Reset link was send  to your email']);
    	}
    }
    private function sendEmail($user, $code){
    	Mail::send('emails.forgot-password',[

    			'user' => $user,
    			'code' => $code
    		],function($message) use ($user){
    			$message ->to($user->email);
    			$message ->subject("Hello $user->name, reset your password");
    		});
    }

    public function formResetPassword($email, $code){

    		 $id_user 	= DB::table('users')->where('email', $email)->value('id');
    		 $code1 	= DB::table('reminders')->where('user_id', $id_user)->value('code');

    		 if($code == $code1 ){

    		 	return view('password.reset',compact('email','code'));
    		 }
    }

    public function resetPassword(Request $request){

    	$rules = [
 
            'password'                 => 'required|min:6',
            'password_confirm'         => 'required|same:password'
          
    	];
    	
    	$validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{


        	$user = Users::where('email', $request->email)->first();
        	$user->password = bcrypt($request->password);
        	$user->save();

        	return redirect()->route('login')->with('message','Reset password Success !!!');

        }

    }

}
