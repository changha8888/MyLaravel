<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Users;
// use App\Roles;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Company;
use Validator;

class HomeController extends Controller
{
    //
    public function __construct(){

    	$this->middleware('auth',['except'=>'getLogout']);
        $this->middleware('systemadmin')->except('getLogout');;
    }
    // ROLe 1 : ADMIN
    public function index(){
        // dd(Auth::user());

        // $data = DB::table('users')
        //     ->join('company', 'users.id_company', '=', 'company.id_company')
           
        //     ->select('users.*', 'company.name as company_name','company.description')
        //     ->get();
        $data  = DB::table('users')->select('users.*','company.name as name_company','company.description')
            ->join('company', function ($join) {
                $join->on('users.id_company', '=', 'company.id_company')
                     ->where('users.role', '=', 2);
                 
            })->get();

    	return view('home',['company'=>$data]);

    }

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
            $admin_name            = $request->input('admin_name');
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


    // $company = DB::table('company')->where('id_company', $id_company)->first();

    $company = DB::table('users')
            ->join('company', 'users.id_company', '=', 'company.id_company')
            ->where('users.id_company', '=', $id_company)
            ->where('users.role', '=', 2)
            ->select('*')
            ->get();
        return view('company.edit',compact('company'));

    }

    public function updateCompany(Request $request){

        $rules = [
            'name'             => 'required',
            'description'      => 'required',
            'email'             => 'required|email',           
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
            DB::table('users')
                ->where('id_company', $request->id_company)
                ->where('role', 2)
                ->update([

                    'email' => $request->email,

                    ]);    
           
            return redirect()->route('home')->with('message','Edit Company Success !!!');
        
        }    
        
    }


    public function deleteCompany($id_company){

        DB::table('company')->where('id_company', '=', $id_company)->delete();
        DB::table('users')->where('id_company', '=', $id_company)->delete();


        return redirect()->back();
    }


      public function getLogout(){
        
        Auth::logout();
        return redirect()->route('login');
    }



}
