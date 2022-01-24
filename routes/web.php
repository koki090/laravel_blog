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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'BlogController@index')->name('blogs.index');
Auth::routes();
Route::resource('blogs', 'BlogController');
Route::resource('users', 'UserController')->only([
    'show', 'edit', 'update']);
Route::post('users/follow/{user_id}', 'UserController@follow')->name('users.follow');
Route::post('blogs/search', 'BlogController@search')->name('blogs.search');