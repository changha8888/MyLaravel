<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Company;
use Roles;
use App\Users;

class CompanyController extends Controller
{
    
    public function addCompany(){

    	return view('company.add');
    }


    public function registerCompany(Request $request){

    	$rules = [
     		'company_name'             => 'required',
    		'company_description'      => 'required',	
            'admin_name'               => 'required',
            'admin_email'              => 'required|email',
            'password'                 => 'required|min:6',
            'password_confirm'         => 'required|same:password'
          
    	];
    	
    	$validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{



        	$company_name          = $request->input('company_name');
        	$company_description   = $request->input('company_description');
        	$admin_name 		   = $request->input('admin_name');
            $admin_email           = $request->input('admin_email');
            $password              = $request->input('password');


            $user = Users::where('email', '=', $admin_email)->first();

            if($user == null){

                // Add company

    			$id = DB::table('company')->insertGetId( 
                        array(
                            'name'          => $company_name,
                            'description'   => $company_description,
                            )
                    );

    		    // Add admin company	

         		  DB::table('users')->insert([

                        'name'          => $admin_name, 
                        'email'         => $admin_email,
                        'password'      => bcrypt($password),
                        'role'          => 2,
                        'id_company'    => $id
                    ]);
                  

         		  return redirect()->route('home')->with('message','Add Company Success !!!');
            }else{

                return redirect()->back()->with('message_fail', 'exist'); 
            }      
        }      

    }

    public function viewCompany($id_company){

        $user_company = DB::table('users')->where('id_company', $id_company)->get();


return view('company.view',compact('user_company'));
    }    

    public function editCompany($id_company){


    $company = DB::table('company')->where('id_company', $id_company)->first();

		return view('company.edit',compact('company'));

    }

    public function updateCompany(Request $request){

    	$rules = [
     		'name'             => 'required',
    		'description'      => 'required',          
    	];

    	$validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{
    	
	    	DB::table('company')
	            ->where('id_company', $request->id_company)
	            ->update([

	            	'name' => $request->name,
	            	'description' => $request->description

	            	]);
	       
	        return redirect()->route('home')->with('message','Edit Company Success !!!');
    	
	    }    
        
    }


    public function deleteCompany($id_company){

    	DB::table('company')->where('id_company', '=', $id_company)->delete();
        DB::table('users')->where('id_company', '=', $id_company)->delete();


    	return redirect()->back();
    }

    public function RegisterUserCompany($id_company){


        return view('admincompany.register',compact('id_company'));
    }

    public function postRegisterUserCompany(Request $request){

        $rules = [
            'name'                => 'required',
            'email'               => 'required|email',
            'password'            => 'required|min:6',
            'password_confirm'    => 'required|same:password'

        ];
        
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{    


            $id_company         = $request->input('id_company');
            $name               = $request->input('name');
            $email              = $request->input('email');
            $password           = $request->input('password');

            $user = Users::where('email', '=', $email)->first();
            
            if($user == null){ 

                DB::table('users')->insert([

                        'name'          => $name, 
                        'email'         => $email,
                        'password'      => bcrypt($password),
                        'role'          => 4,
                        'id_company'    => $id_company
                    ]);

               return redirect()->route('admin_company', ['id_company' =>  $id_company ])->with('message','Register Success !!!');
            }else{

                return redirect()->back()->with('message_fail', 'exist');
            }  
            
        }    

    }


    public function editUserCompany(Request $request){
      
        $id_user    = $request->input('id_user');
        $id_company = $request->input('id_company');

        $user = DB::table('users')->where('id', $id_user)->first();


        return view('admincompany.edit',compact('id_user','id_company','user'));

    }

    public function updateUserCompany(Request $request){

     
        $rules = [
            'name'                => 'required',
            'email'               => 'required|email',
            'password'            => 'required|min:6',
            'password_confirm'    => 'required|same:password'

        ];
        
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{

            $name       = $request->input('name');
            $email      = $request->input('email');
            $password   = $request->input('password');
            $id_user    = $request->input('id_user');
            $id_company    = $request->input('id_company');


            DB::table('users')
            ->where('id', $id_user)
            ->update(['name' => $name , 'email' => $email ,'password' =>bcrypt($password)]);

            return redirect()->route('admin_company', ['id_company' =>  $id_company ])->with('message','Update User Success !!!');
        }   
       
    }

    public function deleteUserCompany(Request $request){

    $id_user = $request->input('id_user');

    DB::table('users')->where('id', '=', $id_user)->delete();

        return redirect()->back();
    }


}
