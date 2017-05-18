<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->truncate();

        App\User::create([
        	
    		'name' => 'admin',
    		'email'=> 'admin@test.com',
    		'password'=>bcrypt('12345678'),
    		'role'	=>'1',
            'qrcode' => str_random(30),


    	]);

      
    }
}
