<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// files routes
Route::get('files/list', 'FileController@index')->name('files');
Route::get('file/create', 'FileController@create')->name('file.create');
Route::post('file/create', 'FileController@store')->name('file.store');

//edit
Route::get('file/edit/{id}', 'FileController@edit')->name('file.edit');
Route::post('file/edit/{id}', 'FileController@update')->name('file.update');

//show
Route::get('file/show/{id}', 'FileController@show')->name('file.show');

//delete
Route::get('file/delete/{id}', 'FileController@destroy')->name('file.destroy');

//download
Route::get('file/{id}/download', 'FileController@download')->name('file.download');
Route::get('file/{id}/downloadPublic', 'FileController@downloadPublic')->name('file.downloadPublic');

//public
Route::get('file/public', 'FileController@public')->name('file.public');
Route::post('file/public/{id}', 'FileController@share')->name('file.share');
Route::get('file/public/show{id}', 'FileController@showPublic')->name('file.showPublic');
