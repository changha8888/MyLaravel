<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Company;
use Roles;

class CompanyController extends Controller
{
    
    public function addCompany(){

    $data =	DB::table('users')
        ->join('roles', function ($join) {
            $join->on('users.id', '=', 'roles.id')
                 ->where('roles.permission', '=', 4);
        })
        ->get();

    	return view('company.add',['data'=>$data]);
    }



    public function registerCompany(Request $request){

    	$rules = [
     		'name'             => 'required:min:8',
    		'description'      => 'required',
    		'admin'            => 'required',
          
    	];
    	
    	$validator = Validator::make($request->all(),$rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }else{

        	$name 			= $request->input('name');
        	$description 	= $request->input('description');
        	$id_admin 		= $request->input('admin');

        }

        // Add company

			$id = DB::table('company')->insertGetId( 
                    array(
                        'name' => $name,
                        'description' => $description,
                        )
                );
		//Add user company	

     		  DB::table('usercompany')->insert(['id_user' => $id_admin, 'id_company' => $id]);

     	//Update role 

     		  DB::table('roles')->where('id', $id_admin)->update(['permission' => 2]);
		   
     		  return redirect()->route('home')->with('message','Add Company Success !!!');

    }

    public function editCompany(Request $request){

		
		$data = $request->all();



		 $user =	DB::table('users')
        ->join('roles', function ($join) {
            $join->on('users.id', '=', 'roles.id')
                 ->where('roles.permission', '=', 4);
        })
        ->get();
		

		return view('company.edit',compact('data','user'));

    }

    public function updateCompany(Request $request){
    	// dd($request->all());

    	// echo $request->id_company;
    	DB::table('company')
            ->where('id_company', $request->id_company)
            ->update([

            	'name' => $request->name,
            	'description' => $request->description

            	]);
        if($request->admin != $request->id_admin_cur ){

        	DB::table('usercompany')
            ->where('id_company', $request->id_company)
            ->update(['id_user' => $request->admin]);

            DB::table('roles')
            ->where('id', $request->admin)
            ->update(['permission' => 2]);

            DB::table('roles')
            ->where('id', $request->id_admin_cur)
            ->update(['permission' => 4]);


        }
        return redirect()->route('home');
    	// dd($request->all());
    }


    public function deleteCompany(Request $request){
    	
    	DB::table('company')->where('id_company', '=', $request->id_company)->delete();
    	DB::table('usercompany')->where('id_company', '=', $request->id_company)->delete();
    	DB::table('roles')->where('id', $request->id_admin)->update(['permission' => 4]);
    	// $company = Company::findOrFail($request->id_company);
     //    $company->delete();


    	// dd($request->all());

    	return redirect()->back();
    }
}
