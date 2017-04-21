<?php

use Illuminate\Database\Seeder;

class RolesAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('roles')->truncate();

        App\Roles::create([
        	
    		'id' => '1',
    		'permission'=> '1',

    	]);
    }
}
