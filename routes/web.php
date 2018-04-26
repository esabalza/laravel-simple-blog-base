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

use Illuminate\Support\Facades\Route;


// Authentication routes
Route::get('/',  'Auth\LoginController@getView')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


// Admin dashboard group
Route::group(['prefix' => 'admin'], function () {

    // Admin dashboard splash
    Route::get('/', 'PostController@welcome')->name('welcome');

    //  Admin/PostController
    Route::resource('posts', 'PostController');
    Route::resource('users', 'UserController');

});

