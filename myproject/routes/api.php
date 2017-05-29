<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'LoginController@apiLogin');

Route::get('data/{id}', 'LoginController@dataapi');

Route::get('testAuth3', function () {
		dd('ko auth van vao dc');
});
Route::group(['middleware' => 'auth:api'], function () {

	Route::get('role',function(){
	dd(auth('api')->user()->role);
	});

	Route::get('testAuth', function () {
		dd('auth moi vao day');
	});
	
});