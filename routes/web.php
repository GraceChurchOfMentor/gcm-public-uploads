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

Route::get('/', 'FormController@show');
Route::post('/s3/success', 'FineUploaderController@s3EndpointSuccess');
Route::post('/s3/sign', 'FineUploaderController@s3EndpointSign');
Route::delete('/s3', 'FineUploaderController@s3EndpointDelete');
Route::post('/notify/email', 'NotifyController@email');
Route::get('/blank', function() {
    return view('blank');
});
