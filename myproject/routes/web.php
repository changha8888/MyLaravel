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


Route::get('login','LoginController@getLogin');
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
