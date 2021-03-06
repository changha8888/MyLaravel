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
use File;
use Auth;
use App\Jobs\UploadFileExcel;
use App\Jobs\InitJobUploadFile;
use Log;

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
        ->paginate(10);

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
                    'id_company'    => $id_company,
                    'qrcode'        => str_random(30)
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

      $id_company = $request->input('id_company');

      $file = Input::file('file');

      if(!$file){

        return redirect()->back()->with('message','Select File Excel !!!');
      }

      $file_name = $file->getClientOriginalName();

      $dir_path = storage_path('user_data'.'/'.$id_company);

      if(is_dir($dir_path)==false){

        mkdir($dir_path,0755,true);
      }

      $file->move($dir_path,$file_name);

      $id_log_file = DB::table('upload_log')->insertGetId(
            ['file_name' => $file_name, 'number_job' => '','status' => 'pending','created_at'=> date('Y-m-d H:i:s')]
        );

    $count = DB::table('jobs')->count();

    if($count == 0){
      $job = new UploadFileExcel($id_company,$dir_path,$file_name,$id_log_file);
      dispatch($job);
    }


      return redirect()->route('admin_company', ['id_company' =>  $id_company]);

    
    }

    public function LogUpload($id_company){

      $list_file = DB::table('upload_log')->paginate(10);

      return view('admincompany.log-file',compact('list_file','id_company'));

     
    }

    public function FileDetail($id_company,$id,$filename){

      $error_users = DB::table('error_users')
      ->where('file', '=', $filename)
      ->where('id_company','=', $id_company)
      ->where('id_log_file','=', $id)
      ->paginate(10);

      return view('admincompany.detail-file',compact('error_users','id_company'));
    }

    
}
