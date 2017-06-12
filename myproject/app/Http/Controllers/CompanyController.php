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

              // Create file Excel record user error.

      $without_extension = substr($file_name, 0, strrpos($file_name, "."));

              // Create file TXT process percent.

      $file_txt_1 = $dir_path.'/Percent_'.$without_extension.'.txt';

      $handle_1 = fopen($file_txt_1, 'w');

      $data_1 = "0";

      fwrite($handle_1, $data_1);

      $file_txt_2 = $dir_path.'/Pace_'.$without_extension.'.txt';

      $handle_2 = fopen($file_txt_2, 'w');

      $data_2 = "0";

      fwrite($handle_2, $data_2);


      $dir_path_file = $dir_path.'/'.$file_name;

      $job = new UploadFileExcel($id_company,$dir_path,$file_name);

      dispatch($job);


          // return redirect()->route('admin_company', ['id_company' =>  $id_company,'file_name'=>$file_name ]);

        $current_user = DB::table('users')->count();

      return view('admincompany.status-upload',compact('file_name','id_company','current_user'));
    }

    public function ErrorFile(Request $request,$id_company){

       $file_name =$request->input('file_name');

       $without_extension = substr($file_name, 0, strrpos($file_name, "."));

       $current_user = DB::table('users')->count();


return view('admincompany.status-upload',compact('without_extension','id_company','current_user'));


      $dir_path = storage_path('user_data'.'/'.$id_company);   

      // $file = scandir($dir_path);
      if(!is_dir($dir_path)){

        return redirect()->back();
      }
      $file = scandir($dir_path);

      $k = 0;
      foreach ($file as $value) {

        $file_extension = substr($value, strrpos($value, "."));

        if($file_extension != '.txt'){
          $k++;
          $file_name[$k] = $value;
        }
      } 

      $file_name = array_slice($file_name,2);

    return view('admincompany.error-file',compact('file_name','id_company'));
    }

    // public function FileDetail($id_company,$filename){

    //   $error_users = DB::table('error_users')
    //   ->where('file', '=', $filename)
    //   ->where('id_company','=', $id_company)
    //   ->get();

    //   return view('admincompany.detail-file',compact('error_users','id_company'));
    // }

    public function GetStatus(Request $request){

      $id =  $request->input('id');
      $file_name =  $request->input('file_name');
      $without_extension = substr($file_name, 0, strrpos($file_name, "."));
      $current_user =  $request->input('current_user');
      $test =  $request->input('test');

      $file_path = storage_path('user_data'.'/'.$id.'/Percent_'.$without_extension.'.txt');

      $file_content = file_get_contents($file_path);

          $ahihi = DB::table('users')->first();

      $user = DB::table('users')->count();

      $new = $user - $current_user;

      if($test == 0 ){

        $err_user  = DB::table('error_users')->where('file','=',$file_name)->get();

        if($err_user == null){

          $test = 0;

        }else{
          $test = DB::table('error_users')->orderBy('id', 'desc')->value('id');
        }

      }else{
        $err_user = DB::table('error_users')->where('id','>',$test)->where('file','=',$file_name)->get();

        $test = DB::table('error_users')->orderBy('id', 'desc')->value('id');
      }

      // $err_user = DB::table('error_users')->get();

      $percent = file_get_contents($file_path);

      $info = [
        
        'err' => $err_user,
        'percent' => $percent,
        'new' => $new,
        'test' => $test

      ];
      return json_encode($info);
      
    }
}
