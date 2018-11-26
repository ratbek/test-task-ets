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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('companies', 'CompanyController@index');
    Route::get('companies/{company_id}', 'CompanyController@show');
    Route::post('companies', 'CompanyController@store');
    Route::put('companies/{company_id}', 'CompanyController@update');
    Route::delete('companies/{company_id}', 'CompanyController@delete');

    Route::get('users', 'UserController@index');
    Route::get('users/{user_id}', 'UserController@show');
    Route::put('users/{user_id}', 'UserController@update');
    Route::delete('users/{user_id}', 'UserController@delete');

    Route::post('users/add-user-to-company', 'UserController@addUserToCompany');
    Route::put('users/update-user-company/{id}', 'UserController@updateUserCompany');
});