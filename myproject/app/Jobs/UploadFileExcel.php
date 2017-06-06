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


class UploadFileExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $dir_path;
    protected $file_name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$dir_path,$file_name)
    {
        $this->id = $id;
        $this->dir_path = $dir_path;
        $this->file_name = $file_name;
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

        $dir_path_file = $dir_path.'/'.$file_name;

        // Log::info('HANDLE -- ID '.$id);
        // Log::info('HANDLE -- PATH '.$dir_path);
        // Log::info('HANDLE -- NAME FILE'.$file_name);



           Excel::filter('chunk')->load($dir_path_file)->chunk(200, function($results) use($id,$file_name,$dir_path)
        { 
            
            foreach($results as $row)
            {
          
                // $email = Users::where('email', '=', $row->email)->value('email');
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

                $validator = Validator::make($arr_user,$rules);

               if($user == null && !$validator->fails()){

                    DB::table('users')->insert(
                        ['name'     => $row->name,
                        'email'     => $row->email,
                        'password'  => bcrypt($row->password),
                        'role'      => 4,
                        'qrcode'    => str_random(30),

                        'id_company'=> $id ]);

                }
                if($user != null || $validator->fails()|| $row->email == null ) {


                  $name = ($row->name !=null) ? $row->name : '';
                  $email = ($row->email !=null) ? $row->email : '';
                  $password = ($row->password !=null) ? $row->password : '';

                   DB::table('error_users')->insert(
                        ['name'     => $name,
                        'email'     => $email,
                        'password'  => $password,
                        'id_company' => $id, 
                        'file'      => $file_name,
                         ]);

                }
            }



            $without_extension = substr($file_name, 0, strrpos($file_name, "."));
                // $check = $dir_path."/Error_".$without_extension.".xlsx";
        
                //     Excel::load($check, function($reader)use($id)
                //     {

                //       $reader->sheet('Error',function($sheet)use($id)  {

                //           $sheet->prependRow(['name','email','password']);
                //       });

                //     })->store('xlsx', storage_path('user_data/'.$id), false);

     
            $count = DB::table('jobs')->count();

            $pace = 100/$count;

            // Read file percent process.

            $percent_file = $dir_path.'/Percent_'.$without_extension.'.txt';
            $pace_file = $dir_path.'/Pace_'.$without_extension.'.txt';

            $file_contents = file_get_contents($pace_file);

            if($file_contents == '0'){

                $pace_value = str_replace("0",$pace,$file_contents);
                file_put_contents($pace_file,$pace_value);
            }

            $new_percent = floatval(file_get_contents($percent_file)) + floatval(file_get_contents($pace_file));

            $percent_value = file_get_contents($percent_file);
            $percent_value = str_replace(file_get_contents($percent_file),$new_percent,$percent_value);
            file_put_contents($percent_file,$percent_value);



            // $lines = file($file_txt_1);

            // if($lines[1] == 'pace'){

            //     $file_contents = file_get_contents($file_txt);
            //     $pace_value = str_replace("pace",$pace,$file_contents);
            //     file_put_contents($file_txt,$pace_value);

            // }

            // // $valueabc = $lines[1] + 1;

            // $new_percent = 'a';
            // $new_percent .= floatval(substr($lines[0], 1)) + floatval($lines[1]);

            // $old_percent = $lines[0];

            // $file_contents = file_get_contents($file_txt);
            // $percent_value = str_replace($old_percent,$new_percent,$file_contents);
            // file_put_contents($file_txt,$percent_value);






            // Log::info('phan tram '. $lines[1]);
            // $handle = fopen($file_txt, 'r');                       
            // $data = fread($handle,filesize($file_txt));



  // Log::info(' data file '.$data);
            // $new_percent = $phantram + $data;

            // Write new value


            // fwrite($handle, $new_percent);
            


            // Log::info('new phan tram '.$phantram);
      });

            Log::info('create job done !!!!  ');
    }    
}
