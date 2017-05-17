<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

$router->group(['middleware' => 'locale'], function($router)
{
Route::get('login',['as' => 'login','uses'=>'LoginController@getLogin']);
Route::post('login','LoginController@postLogin');

// Route::get('register','LoginController@getRegister');
// Route::post('register','LoginController@postRegister');

Route::get('logout','HomeController@getLogout');

Route::get('forgot-password','ForgotPasswordController@forgotPassword');

Route::post('forgot-password',['as' =>'forgot-password','uses'=> 'ForgotPasswordController@postForgotPassword']);

Route::get('/reset/{email}/{code}','ForgotPasswordController@formResetPassword');

Route::post('resetpass',['as'=>'resetpass','uses' =>'ForgotPasswordController@resetPassword']);

Route::get('/',['as' => 'home', 'uses' => 'HomeController@index']);


Route::get('admin_company/{id_company}',['as' => 'admin_company', 'uses' => 'CompanyController@AdminCompany']);

Route::get('lang/set',['as'=> 'setlang' ,'uses'=>'LanguageController@set_lang']);

Route::get('addcompany',['as'=> 'addcompany','uses'=>'HomeController@addcompany']);
Route::post('registercompany',['as'=> 'registercompany','uses'=>'HomeController@registerCompany']);


Route::get('viewcompany/{id_company}',['as'=> 'viewcompany','uses'=>'HomeController@viewCompany']);

Route::get('editcompany/{id_company}',['as'=> 'editcompany','uses'=>'HomeController@editCompany']);

Route::post('updatecompany',['as'=> 'updatecompany','uses'=>'HomeController@updateCompany']);

Route::get('deletecompany/{id_company}',['as'=> 'deletecompany','uses'=>'HomeController@deleteCompany']);

Route::get('register/{id_company}',['as'=> 'register','uses'=>'CompanyController@RegisterUserCompany']);

Route::post('postregister',['as'=> 'postregister','uses'=>'CompanyController@postRegisterUserCompany']);

Route::get('edituser',['as'=> 'edituser','uses'=>'CompanyController@editUserCompany']);

Route::post('updateuser',['as'=> 'updateuser','uses'=>'CompanyController@updateUserCompany']);

Route::get('deleteuser',['as'=> 'deleteuser','uses'=>'CompanyController@deleteUserCompany']);

Route::get('normaluser/{id}',['as'=> 'normaluser','uses'=>'CompanyController@NormalUser']);

Route::get('upload/{id}',['as'=>'upload','uses'=>'CompanyController@upload' ]);

Route::post('importUser',['as'=>'importUser','uses'=>'CompanyController@importUser' ]);


});


Route::get('search','SearchController@index');

Route::get('result',['as'=>'result','uses'=>'SearchController@search']);


Route::get('abc',function(){


// $data  = DB::table('users')->select('users.*','company.name as name_company')
//         ->join('company', function ($join) {
//             $join->on('users.id_company', '=', 'company.id_company')
//                  ->where('users.role', '=', 2);
                 
//         })
//         ->get();


	  // $data = DB::table('users')->where('id_company', 2)->get();

	$data = DB::table('users')
            ->join('company', 'users.id_company', '=', 'company.id_company')
           	->where('users.id_company', '=', 2)
           	->where('users.role', '=', 2)
            ->select('*')
            ->get();

// dd($data);
// $subQuery = DB::table('roles')->select(['permission', DB::raw('max(count_login) as max')])->groupBy('permission');

// $data = DB::table('users')->select( '*' )
// 	->join('roles', 'users.id', '=', 'roles.id')
// 	->join(DB::raw('(' . $subQuery->toSql() . ') sub'), function($join) {
// 		$join->on('sub.permission', '=', 'roles.permission');
// 		$join->on('sub.max', '=', 'roles.count_login');
// 	})->get();


// // dd($data);

//  $company = DB::table('company')
//             ->join('usercompany', 'usercompany.id_company', '=', 'company.id_company')
//             ->join('users', 'users.id', '=', 'usercompany.id_user')
//             ->select('users.email','company.*' )
//             ->get(); 


});


Route::get('test',['as'=>'test','uses'=>'SearchController@TestController']);

Route::get('button',['as'=>'button','uses'=>'SearchController@ButtonController']);






// Route::get()

// select a.name, a.email, b.permission, b.count_login from users a INNER JOIN roles b ON a.id = b.id INNER JOIN (select permission, MAX(count_login)as max from roles group by permission) c ON b.permission = c.permission AND b.count_login = c.max ;

