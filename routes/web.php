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

//Auth::routes();

Route::get('/', 'SurveysController@create');
Route::post('/surveys/store', 'SurveysController@store')->middleware('auth');
Route::get('/surveys', 'SurveysController@index')->name('surveys')->middleware('auth');
Route::get('/surveys/{id}/edit', 'SurveysController@edit')->middleware('auth');
Route::put('/surveys/{id}', 'SurveysController@update')->middleware('auth');
