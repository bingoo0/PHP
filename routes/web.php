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
Route::group(['middleware' => 'guest'], function(){
	Route::view('login','login')->name('login');
	Route::post('login','Auth\LoginController@Login');

	Route::view('register','register')->name('register-user');
	Route::post('register','Auth\RegisterController@StoreUser')->name('register-store');
});


Route::group(['middleware'=>'auth'], function(){
	Route::get('posts','PostController@Index')->name('posts.index');
	Route::get('logout','Auth\LoginController@Logout')->name('logout');

	Route::group(['middleware' => 'adminCheck'], function(){
		Route::get('create-post','PostController@Create')->name('posts.create');
		Route::post('create-post','PostController@Store')->name('posts.store');	
	 	Route::post('update-post','PostController@Update')->name('posts.update');
	});
});


