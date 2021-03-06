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

Route::get('/', function () {
    return view('main');
});

//List Queries
Route::get('api/queries','QueriesController@index'); 
//List Query
Route::get('api/queries/{queries}','QueriesController@show'); 
//Create Query
Route::post('api/queries','QueriesController@store'); 
//Update Query
Route::put('api/queries','QueriesController@store'); 
//Delete Query
Route::delete('api/queries/{queries}','QueriesController@destroy'); 



//List contact
Route::get('api/contact','ContactController@index'); 
//List Query
Route::get('api/contact/{contact}','ContactController@show'); 
//Create Query
Route::post('api/contact','ContactController@store'); 
//Update Query
Route::put('api/contact','ContactController@store'); 
//Delete Query
Route::delete('api/contact/{contact}','ContactController@destroy'); 