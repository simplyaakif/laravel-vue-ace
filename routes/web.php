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
    return view('welcome');
});

//List Queries
Route::get('queries','QueriesController@index'); 
//List Query
Route::get('queries/{queries}','QueriesController@show'); 
//Create Query
Route::post('queries','QueriesController@store'); 
//Update Query
Route::put('queries','QueriesController@store'); 
//Delete Query
Route::delete('queries/{queries}','QueriesController@destroy'); 