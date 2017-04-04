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
        //
        // DB::table('users')->truncate();
        // App\User::create([
        // 	'name' 		=> 'abc',
        // 	'email'		=> 'abc@gmail.com',
        // 	'password' 	=> bcrypt(12345678)
        // 	]);
        
        DB::table('users')->insert([
		    [
		        'name' => 'linh',
		        'email' => 'linhlinh@gmail.com',
		        'password' 	=> bcrypt(12345678)
		    ],
		    [
		        'name' => 'hien',
		        'email' => 'hienhien@gmail.com',
		        'password' 	=> bcrypt(12345678)
		    ],
		]);

    }
}
