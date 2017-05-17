<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Company;
use Roles;
use App\Users;
use Illuminate\Support\Facades\Input;
use Excel;


class CompanyController extends Controller
{
        public function __construct(){

        $this->middleware('auth',['except'=>'getLogout']);
        $this->middleware('companyadmin')->except('NormalUser');
    }

     public function AdminCompany($id_company){

        $users_company = DB::table('users')
                ->where('role', '=', 4)
                ->where('id_company','=', $id_company)
                ->get();

        $company = DB::table('company')->where('id_company', $id_company)->first();


      return view('admincompany.home',compact('company','users_company'));

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

    public function NormalUser($id){

         $user = DB::table('users')
            ->join('company', 'users.id_company', '=', 'company.id_company')
            ->where('users.id', '=', $id)
            ->select('users.*','company.description','company.name as name_com')
            ->get();


        return view('normaluser',compact('user'));
    }

    public function upload($id){

        return view('admincompany.upload',compact('id'));
    }

    public function importUser(Request $request){

        $id = $request->input('id');

        $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $file->move('files',$file_name);

        $results = Excel::load('files/'.$file_name,function($reader){

            $reader->all();

        })->get();

       $k = 0;
        foreach ($results as $value ) {

            $k++;

            $email = Users::where('email', '=', $value->email)->value('email');
            $arr_user = [
                'name'      => $value->name,
                'email'     => $value->email,
                'password'  => $value->password,
             ];

             $rules = [
                'name'        => 'required',
                'email'       => 'required|email',
                'password'    =>'required|min:6',

            ];
            
            $validator = Validator::make($arr_user,$rules);
            
           if(!$email && !$validator->fails()){

                DB::table('users')->insert(
                    ['name'     => $value->name, 
                    'email'     => $value->email,
                    'password'  => bcrypt($value->password),
                    'role'      => 4,
                    
                    'id_company'=> $request->input('id') ]);
           }else{

                if($email == $value->email && $email != null){

                    $record_err[$k] = [
                        'name'      => $value->name,
                        'email'     => $value->email,
                        'password'  => $value->password,
                        'status'    => 'User was used'
                    ];

                }else{
                    
                    $record_err[$k] = [
                        'name'      => $value->name,
                        'email'     => $value->email,
                        'password'  => $value->password,
                        'status'    => 'Record error some information'
                    ];
                }       
            }           
        }

        return view('admincompany.error',compact('record_err','id'));    
    }
}
