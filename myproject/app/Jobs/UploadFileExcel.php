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


class UploadFileExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $dir_path_file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$dir_path_file)
    {
        $this->id = $id;
        $this->dir_path_file = $dir_path_file;
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
        $path   = $this->dir_path_file;

        Log::info('HANDLE -- PATH'.$path);


        $results = Excel::load($path,function($reader){

            $reader->all();

        })->get();

        Log::info('LOADED');
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
                    'qrcode'    => str_random(30),

                    'id_company'=> $id ]);
           }
        }
    }    
}
