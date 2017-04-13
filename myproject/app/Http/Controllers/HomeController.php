<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Users;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //
    public function __construct(){

    	$this->middleware('auth',['except'=>'getLogout']);
    }
    // ROLe 1 : ADMIN
    public function index(){

        $users = Users::all();

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

    public function index_role4(){
        
        return view('role4');

    }   


    public function getLogout(){
    	Auth::logout();
    	return redirect('login');
    }


    public function edit($id){

          $user = Users::findOrFail($id);
        // return to the edit views
        return view('edit',compact('user'));
    }



      public function update(Request $request, $id)
    {
        //
        $user = Users::findOrFail($id);

        $user->role = $request->role;
       
        $user->save();

        return redirect()->route('home');
        
    }



    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }


}
