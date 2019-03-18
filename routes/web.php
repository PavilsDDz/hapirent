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

Route::get('/', 'HomeController@index');
Route::post('/language', array('Middleware'=>'LanguageSwitcher','uses'=>'LanguageController@index'));



Auth::routes();

Route::get('/home', 'HomeController@home')->name('home')->middleware('logedin');
// Route::get('/posts', 'PostsController@index')->name('posts'); 
Route::get('/posts/{id}/edit', 'PostsController@edit')->middleware(['logedin','owns_post']);
Route::put('/posts/{id}', 'PostsController@update')->middleware('logedin');
Route::post('/posts/{id}','PostsController@sendBooking');
Route::resource('posts', 'PostsController')->except(['index', 'show'])->middleware('logedin');
Route::resource('posts', 'PostsController')->only(['index', 'show']);
Route::options('/posts/','PostsController@search');

Route::get('/snow', 'PostsController@getSnow');
Route::get('/water', 'PostsController@getWater');
Route::get('/sand', 'PostsController@getSand');
Route::get('/air', 'PostsController@getAir');

Route::get('/profile', 'ProfileController@index')->middleware('logedin');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('logedin');
Route::put('/profile/edit', 'ProfileController@update')->middleware('logedin');

Route::get('/users/{id}', 'ProfileController@showUser');

Route::get('/quer_posts','PostsController@query');
Route::post('/quer_posts','PostsController@query');

Route::get('/test','TestController@form');
Route::post('/test',function(){
	return Session::all();
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "cleared";
});
