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

Route::get('/', [
    'uses' => 'FrontendController@index',
    'as' => 'index'
]);

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

/*
|--------------------------------------------------------------------------
| FrontendController
|--------------------------------------------------------------------------
*/

Route::get('/single-category/{category}', [
    'uses' => 'FrontendController@category',
    'as' => 'category.single'
]);

Route::get('/single-post/{slug}', [
    'uses' => 'FrontendController@single_post',
    'as' => 'post.single'
]);

Route::get('/results', [
    'uses' => 'FrontendController@search',
    'as' => 'search.results'
]);

Route::post('/subscribe', [
    'uses' => 'FrontendController@subscribe',
    'as' => 'subscribe'
]);

Route::get('/tags/{id}', [
    'uses' => 'FrontendController@tag',
    'as' => 'tag.single'
]);




/*
|--------------------------------------------------------------------------
| ProfileController
|--------------------------------------------------------------------------
*/

Route::get('/user/profile', [
    'uses' => 'ProfileController@index',
    'as' => 'user.profile'
]);

Route::post('/user/profile/update', [
    'uses' => 'ProfileController@update',
    'as' => 'user.profile.update'
]);

/*
|--------------------------------------------------------------------------
| TagController
|--------------------------------------------------------------------------
*/

Route::resource('tag', 'TagController');

/*
|--------------------------------------------------------------------------
| UsersController
|--------------------------------------------------------------------------
*/

Route::get('/user/admin/{id}', [
    'uses' => 'UsersController@admin',
    'as' => 'user.admin'
]);

Route::get('/user/not-admin/{id}', [
    'uses' => 'UsersController@not_admin',
    'as' => 'user.not_admin'
]);

Route::get('/user/delete/{user}', [
    'uses' => 'UsersController@destroy',
    'as' => 'user.delete'
]);

Route::get('/user', [
    'uses' => 'UsersController@index',
    'as' => 'users'
]);

Route::get('/user/create', [
    'uses' => 'UsersController@create',
    'as' => 'user.create'
]);

Route::get('/user/store', [
    'uses' => 'UsersController@store',
    'as' => 'user.store'
]);




Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');