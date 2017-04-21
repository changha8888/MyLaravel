<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Users;
use App\Roles;
use Illuminate\Support\Facades\Redirect;
use DB;

class HomeController extends Controller
{
    //
    public function __construct(){

    	$this->middleware('auth',['except'=>'getLogout']);
    }
    // ROLe 1 : ADMIN
    public function index(){

        // $users = Users::all();

        $users = DB::table('users')
            ->join('roles', 'users.id', '=', 'roles.id')
            ->select('users.*', 'roles.permission','roles.count_login')
            ->get();
       

    	return view('home',['users'=>$users]);

    }

    // ROLE 2

    public function index_role2(){
        
        return view('role2');

    }

    // ROLE 3

    public function index_role3(){
        
        return view('role3');

    }

     // ROLE 4

    public function not_admin(){
         $users = DB::table('users')
            ->join('roles', 'users.id', '=', 'roles.id')
            ->select('users.*', 'roles.permission','roles.count_login')
            ->get();

        return view('not_admin',['users'=>$users]);

    }   


    public function getLogout(){
    	Auth::logout();
    	return redirect('login');
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
        $user = Users::findOrFail($id);
        $user->delete();

        $role = Roles::findOrFail($id);
        $role->delete();

        return redirect()->back();
    }


}
