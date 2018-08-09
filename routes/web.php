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

use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('main');
});

Route::get('sendmail', function () {
    $data = [
        'title'=>'Something great happened today.',
        'content'=> 'Not only was i able to set mail server but also the sms server. Thats great guys..',
    ];

    Mail::send('emails.test',$data, function($message){
        $message->to('simply.aakif@gmail.com','Raza Aakif')->subject('Today\'s Update guy');
    });

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
Route::get('api/contacts','ContactController@index'); 
//List Query
Route::get('api/contacts/{contact}','ContactController@show'); 
//Create Query
Route::post('api/contacts','ContactController@store'); 
//Update Query
Route::put('api/contacts','ContactController@store'); 
//Delete Query
Route::delete('api/contacts/{contact}','ContactController@destroy'); 








Route::get('/{vue_capture?}', function () {
    return view('main');
})->where('vue_capture', '[\/\w\.-]*');