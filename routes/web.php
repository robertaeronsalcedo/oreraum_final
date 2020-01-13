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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/bulletinboard', 'CategoryController@index');
Route::resource('category','CategoryController');
Route::get('/users', 'userController@index');
Route::get('/bulletin', 'bulletinController@index');
Route::get('/compose', 'composeController@index');
Route::get('/submission', 'submitController@index');
Route::get('/coderequest', 'coderequestController@index');
Route::post('user_update', 'userController@update');
Route::post('delete_user', 'userController@delete');
Route::post('upload', 'submitController@upload')->name('upload');
Route::get('openPdf','submitController@openPdf')->name('openPdf');
Route::get('submitted', 'submitController@index')->name('submitted');
Route::post('compose_message', 'composeController@post');
Route::get('profile', function(){
    return view('profile');
});



/* View Composer*/
View::composer(['*'], function($view){
    
    $user = Auth::user();
    $view->with('user',$user);
    

    

});

