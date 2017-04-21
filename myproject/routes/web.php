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

Route::get('register','LoginController@getRegister');
Route::post('register','LoginController@postRegister');

Route::get('logout','HomeController@getLogout');


Route::resource('/home', 'HomeController');

Route::get('login/{locale}','LanguageController@login_trans');
Route::get('register/{locale}','LanguageController@register_trans');

Route::get('/',['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('role2',['as' => 'role2', 'uses' => 'HomeController@index_role2']);
Route::get('role3',['as' => 'role3', 'uses' => 'HomeController@index_role3']);
Route::get('role4',['as' => 'role4', 'uses' => 'HomeController@index_role4']);


Route::get('not_admin',['as' => 'not_admin', 'uses' => 'HomeController@not_admin']);


Route::get('lang/set',['as'=> 'setlang' ,'uses'=>'LanguageController@set_lang']);

});
Route::get('test',function(){
echo '<pre>';



  $ab = session()->all();
  var_dump(session()->get('lang'));
  // var_dump(App::getLocale());
});



// select a.name, a.email, b.permission, b.count_login from users a INNER JOIN roles b ON a.id = b.id INNER JOIN (select permission, MAX(count_login)as max from roles group by permission) c ON b.permission = c.permission AND b.count_login = c.max ;