<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use Excel;
use App\Users;
use Validator;
use DB;
use File;
use App\Jobs\InitJobUploadFile;


class UploadFileExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $dir_path;
    protected $file_name;
    protected $id_log_file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$dir_path,$file_name,$id_log_file)
    {
        $this->id = $id;
        $this->dir_path = $dir_path;
        $this->file_name = $file_name;
        $this->id_log_file = $id_log_file;
        //

        Log::info('CONSTRUCT');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $id     = $this->id;
        $dir_path   = $this->dir_path;
        $file_name   = $this->file_name;
        $id_log_file  = $this->id_log_file;

        $dir_path_file = $dir_path.'/'.$file_name;


           Excel::filter('chunk')->load($dir_path_file)->chunk(200, function($results) use($id,$file_name,$dir_path,$id_log_file)
        { 
            
            foreach($results as $row)
            {
          
                $user = Users::where('email', '=', $row->email)->first();
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

                  $name = ($row->name !=null) ? $row->name : '';
                  $email = ($row->email !=null) ? $row->email : '';
                  $password = ($row->password !=null) ? $row->password : '';

                $validator = Validator::make($arr_user,$rules);

               if($user == null && !$validator->fails()){

                    DB::table('users')->insert(
                        ['name'     => $row->name,
                        'email'     => $row->email,
                        'password'  => bcrypt($row->password),
                        'role'      => 4,
                        'qrcode'    => str_random(30),
                        'id_excel_file'=> $row->id,
                        'id_company'=> $id ]);

                }
                if($user != null && !$validator->fails()){

                  DB::table('error_users')->insert(
                        ['name'     => $name,
                        'email'     => $email,
                        'password'  => $password,
                        'id_company' => $id, 
                        'file'      => $file_name,
                        'id_excel_file'=> $row->id,
                        'id_log_file' =>  $id_log_file,
                        'status'    => 'User already exist'
                         ]);
  

                }
                if($validator->fails()){

                   DB::table('error_users')->insert(
                        ['name'     => $name,
                        'email'     => $email,
                        'password'  => $password,
                        'id_company' => $id, 
                        'file'      => $file_name,
                        'id_excel_file'=> $row->id,
                        'id_log_file'   => $id_log_file,
                        'status'    => 'User not full infomation'
                         ]);
                }

            }

            $without_extension = substr($file_name, 0, strrpos($file_name, "."));

            $number_job = DB::table('upload_log')->where('file_name', $file_name)->value('number_job');

            $check  = DB::table('upload_log')->where('status','pending')->count();
            $count = DB::table('jobs')->count();

            Log::info('countttt '.$count);

           
            $abc = DB::table('upload_log')->where('file_name', $file_name)->where('status','<>' ,'completed')->value('status');
            if($count != 1 && $abc != 'completed' ) {

                 DB::table('upload_log')
                ->where('file_name', $file_name)
                ->where('status','<>' ,'completed')
                ->update(['number_job' => $count -1 ,'status' => 'processing']);

            }if($count == 1){

                DB::table('upload_log')
                ->where('file_name', $file_name)
                ->update(['number_job' => 0 ,'status' => 'completed' ]);


                $get_file_name = DB::table('upload_log')->where('status','pending')->first();

                if($get_file_name){
                    $file_name = $get_file_name->file_name;

                    $dir_path = storage_path('user_data'.'/'.$id);

                    $job = new InitJobUploadFile($id,$dir_path,$file_name,$id_log_file);
                    dispatch($job);
                }

            }

      });

            Log::info('create job done !!!!  ');


    }    
}
