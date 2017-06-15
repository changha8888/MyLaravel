<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use App\Jobs\UploadFileExcel;
use DB;

class InitJobUploadFile implements ShouldQueue
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
        //
        $this->id = $id;
        $this->dir_path = $dir_path;
        $this->file_name = $file_name;
        $this->id_log_file = $id_log_file;
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
        $id_log_file = $this->id_log_file;

        $job = new UploadFileExcel($id,$dir_path,$file_name,$id_log_file);
        dispatch($job);

    }
}
