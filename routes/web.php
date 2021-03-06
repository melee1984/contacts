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
//     return view('home');
// });
	

// Define default page 

Route::get('/', 'HomeController@index');

// API 
Route::get('api/request', 'RequestController@index');
Route::post('api/request/submit', 'RequestController@store');
Route::post('api/request/delete/{id}', 'RequestController@destroy');
Route::post('api/request/update/submit', 'RequestController@update');
