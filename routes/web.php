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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/catalog', 'HomeController@catalog')->name('catalog');
Route::post('/createcatalog','Frontedpage@catalog');
Route::post('/upload','Frontedpage@store');
Route::post('/update','Frontedpage@update');
Route::post('/updatecatalog','Frontedpage@updatecatalog');
Route::post('/updatenamecatalog','Frontedpage@updatenamecatalog');
Route::get('/delete/{id}','Frontedpage@delete');
Route::get('/deletecatalog/{id}','Frontedpage@deletecatalog');