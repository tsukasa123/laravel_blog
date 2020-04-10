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

Route::resource('post', 'PostController');
// Route::resource('post', 'PostController')->middleware('auth');

Route::get('/trashed-posts',[
    'uses' => 'PostController@trashed',
    'as' => 'post.trashed'
]);

Route::get('/restore-post/{id}',[
    'uses' => 'PostController@restore',
    'as' => 'post.restore',
]);

Route::delete('/kill-post/{id}', [
    'uses' => 'PostController@kill',
    'as' => 'post.kill'
]);


/*
|--------------------------------------------------------------------------
| SettingController
|--------------------------------------------------------------------------
*/

Route::resource('setting', 'SettingController');

/*
|--------------------------------------------------------------------------
| CategoryController
|--------------------------------------------------------------------------
*/

Route::resource('category', 'CategoryController');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');