<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Users;
// use App\Roles;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Company;

class HomeController extends Controller
{
    //
    public function __construct(){

    	$this->middleware('auth',['except'=>'getLogout']);
    }
    // ROLe 1 : ADMIN
    public function index(){
        // dd(Auth::user());

        // $data = DB::table('users')
        //     ->join('company', 'users.id_company', '=', 'company.id_company')
           
        //     ->select('users.*', 'company.name as company_name','company.description')
        //     ->get();
        $data  = DB::table('users')->select('users.*','company.name as name_company','company.description')
            ->join('company', function ($join) {
                $join->on('users.id_company', '=', 'company.id_company')
                     ->where('users.role', '=', 2);
                 
            })->get();

    	return view('home',['company'=>$data]);

    }

// Admin Company
    public function AdminCompany($id_company){

        $users_company = DB::table('users')
                ->where('role', '=', 4)
                ->where('id_company','=', $id_company)
                ->get();

        $company = DB::table('company')->where('id_company', $id_company)->first();


      return view('admincompany.home',compact('company','users_company'));

    }   



    public function edit($id){

          // $user = Users::findOrFail($id);
          $permission = Roles::findOrFail($id);
        // return to the edit views
        return view('edit',compact('permission'));
    }



      public function update(Request $request, $id)
    {
        //
        $role = Roles::findOrFail($id);

        $role->permission = $request->role;
       
        $role->save();

        return redirect()->route('home');
        
    }

    public function destroy($id)
    {
        $id_company = DB::table('usercompany')->where('id_user', $id)->value('id_company');

        $user = Users::findOrFail($id);
        $user->delete();

        $role = Roles::findOrFail($id);
        $role->delete();

        DB::table('usercompany')->where('id_user', '=', $id)->delete();

        
        DB::table('company')->where('id_company', '=', $id_company)->delete();

        return redirect()->back();
    }


      public function getLogout(){
        
        Auth::logout();
        return redirect()->route('login');
    }



}
