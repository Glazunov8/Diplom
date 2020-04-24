<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('api')->group(function (){
    Route::post('index_company', 'CompanyController@index');
    Route::post('confirm_company', 'CompanyController@confirmAcc');
    Route::get('get_info', 'UserController@getInfo');

    Route::post('get_company', 'DadataController@getCompany');
});


Route::prefix('auth')->group(function (){
    Route::get('init', 'AppController@init');

    Route::post('get_role', 'AppController@getRole');
    Route::post('login', 'AppController@login');
    Route::post('register_student', 'AppController@register_student');
    Route::post('register_company', 'AppController@register_company');
    Route::post('logout', 'AppController@logout');

});
