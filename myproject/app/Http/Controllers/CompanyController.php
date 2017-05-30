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

        $id = $request->input('id');

        $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $dir_path = storage_path('user_data'.'/'.Auth::id());

        if(is_dir($dir_path)==false){

            mkdir($dir_path,0755,true);
        }

        $file->move($dir_path,$file_name);

        $dir_path_file = $dir_path.'/'.$file_name;

        // $job = new UploadFileExcel($id,$dir_path_file);
        
        // dispatch(($job)->onQueue('uploadfile'));

        Excel::filter('chunk')->load($dir_path_file)->chunk(100, function($results) use($id)
        { 
              $k = 0;
            foreach($results as $row)
            {

              $k++;

                $email = Users::where('email', '=', $row->email)->value('email');
                $arr_user = [
                    'name'      => $row->name,
                    'email'     => $row->email,
                    'password'  => $row->password,
                 ];

                 $rules = [
                    'name'        => 'required',
                    'email'       => 'required|email',
                    'password'    =>'required|min:6',

                ];

                $validator = Validator::make($arr_user,$rules);

               if(!$email && !$validator->fails()){

                    DB::table('users')->insert(
                        ['name'     => $row->name,
                        'email'     => $row->email,
                        'password'  => bcrypt($row->password),
                        'role'      => 4,
                        'qrcode'    => str_random(30),

                        'id_company'=> $id ]);
                }
            }
      });


        return redirect()->route('admin_company', ['id_company' =>  $id ]);



        // $results = Excel::load($dir_path_file,function($reader){

        //     $reader->all();

        // })->get();


       // $k = 0;
       //  foreach ($results as $value ) {

       //      $k++;

       //      $email = Users::where('email', '=', $value->email)->value('email');
       //      $arr_user = [
       //          'name'      => $value->name,
       //          'email'     => $value->email,
       //          'password'  => $value->password,
       //       ];

       //       $rules = [
       //          'name'        => 'required',
       //          'email'       => 'required|email',
       //          'password'    =>'required|min:6',

       //      ];

       //      $validator = Validator::make($arr_user,$rules);

       //     if(!$email && !$validator->fails()){

       //          DB::table('users')->insert(
       //              ['name'     => $value->name,
       //              'email'     => $value->email,
       //              'password'  => bcrypt($value->password),
       //              'role'      => 4,
       //              'qrcode'    => str_random(30),

       //              'id_company'=> $request->input('id') ]);
       //     }else{

       //          if($email == $value->email && $email != null){

       //              $record_err[$k] = [
       //                  'name'      => $value->name,
       //                  'email'     => $value->email,
       //                  'password'  => $value->password,
       //                  'status'    => 'User was used'
       //              ];

       //          }else{

       //              $record_err[$k] = [
       //                  'name'      => $value->name,
       //                  'email'     => $value->email,
       //                  'password'  => $value->password,
       //                  'status'    => 'Record error some information'
       //              ];
       //          }
       //      }
       //  }

       //  if(isset($record_err)){

       //      return view('admincompany.error',compact('record_err','id'));
       //  }else{

       //      return redirect()->route('admin_company', ['id_company' =>  $id_company ]);
       //  }   
    }
}
