<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@Index')->name('index');

//Route::post('/admin/logout','Admin\LoginController@Logout')->name('admin.logout');

Route::group(['prefix' => 'admin'],function(){
    Route::get('login','Admin\LoginController@getLogin')->name('admin.login');
    Route::post('login','Admin\LoginController@postLogin');

    Route::get('register','Admin\RegisterController@getRegister')->name('admin.register');
    Route::post('register','Admin\RegisterController@postRegister');

    Route::post('logout','Admin\LoginController@Logout')->name('admin.logout');

    Route::group(['middleware' => 'AdminAuth'],function (){
        Route::get('/','Admin\IndexController@Index')->name('admin.index');
    });
});

