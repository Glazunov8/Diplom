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
    Route::get('index_company', 'CompanyController@index');
    Route::get('confirm_company', 'CompanyController@confirmAcc');
    Route::get('remove_company', 'CompanyController@destroy');
    Route::get('show_company', 'CompanyController@show');

    Route::get('confirm_student', 'StudentController@confirmAcc');
    Route::get('index_student', 'StudentController@index');
    Route::get('show_student', 'StudentController@show');
    Route::get('remove_student', 'StudentController@destroy');

    Route::get('index_mentor', 'MentorController@index');
    Route::get('show_mentor', 'MentorController@show');
    Route::get('remove_student', 'MentorController@destroy');

    Route::get('get_info', 'UserController@getInfo');

    Route::post('get_company', 'DadataController@getCompany');
});


Route::prefix('auth')->group(function (){
    Route::get('init', 'AppController@init');
    Route::post('login', 'AppController@login');
    Route::post('logout', 'AppController@logout');

    Route::post('register_student', 'AppController@register_student');
    Route::post('register_company', 'AppController@register_company');
    Route::post('register_mentor', 'AppController@register_mentor');

    Route::post('get_role', 'AppController@getRole');
});
