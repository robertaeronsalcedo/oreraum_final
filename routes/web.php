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
Route::get('/bulletinboard', 'CategoryController@join');
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
Route::get('Chat_Message', 'chatmessageController@index');
Route::post('submitted', 'submitController@openPdf')->name('openPdf');
Route::post('coderequest', 'coderequestController@post');
Route::get('delete_message', 'bulletinController@delete_message');
// Route::get('/index', 'CategoryController@index');
// Route::post('/create','groupController@insertform');
// Route::get('/make_group', 'groupController@index');
// Route::get('grouprequest', 'groupController@showgroups');
// Route::get('created_group', 'groupController@advisergroups');
Route::get('admin_register','userController@admin_registration');
Route::get('avatar','userController@avatar');
route::post('avatar','userController@upload_avatar');
Route::post('deleted','bulletinController@delete_message');
route::get('manuscript_list','submitController@adviser_manuscript_list');
route::get('admin_manuscript_list','submitController@admin_manuscript_list');
route::get('Pdf_evaluation','submitController@openAnnotation');

// route::get('/avatar','userController@sample');

Route::get('profile', function(){
    return view('profile');
});



/* View Composer*/
View::composer(['*'], function($view){
    
    $user = Auth::user();
    $view->with('user',$user);
    

    

});

