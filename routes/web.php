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


Route::get('/swimmers', 'SwimmerController@index');
Route::get('/swimmers/create', 'SwimmerController@create');
Route::get('/swimmers/search', 'SwimmerController@search');
Route::post('/swimmers/', 'SwimmerController@store');

Route::get('/swimmers/{id}','SwimmerController@show');
Route::get('/swimmers/{id}/edit','SwimmerController@edit');
Route::get('/swimmers/{id}/delete','SwimmerController@destroy');
Route::put('/swimmers/{id}','SwimmerController@update');

Route::get('/contacts', 'contactController@index');
Route::get('/contacts/create', 'contactController@create');
Route::get('/contacts/search', 'contactController@search');
Route::get('/contacts/{id}','contactController@show');
Route::get('/contacts/{id}/edit','contactController@edit');
Route::get('/contacts/{id}/delete','contactController@destroy');
