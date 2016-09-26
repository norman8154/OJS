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

//Admin Login
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin/login', 'AdminAuth\LoginController@login');
//Route::get('admin/logout', 'AdminAuth\LoginController@logout');

$allow_admin_register = DB::table('settings')->where('index', '0')->get();
if (strcmp($allow_admin_register[0]->allow_admin_register, "on") == 0) {
    //Admin Register
    Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\RegisterController@register');

    //Admin Passwords
    Route::post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
}


Auth::routes();

Route::get('/', 'Auth\SubjectController@getTopic');

Route::resource('post', 'Auth\SubjectController',
    ['only' => ['index', 'show']]);
Route::post('/post/attachment', 'Auth\SubjectController@download_file');

Route::post('answer', 'Auth\AnswerController@postAnswer');
Route::get('answer', 'Auth\AnswerController@checkAuth');

Route::get('ranking', 'RankingController@getTotalRanking');

Route::get('personal', 'Auth\PersonalController@getPersonal');

Route::get('/test', 'TestController@getTest');
Route::post('/test', 'TestController@testcmp');

Route::get('/verify','Auth\SubjectController@getVerify');
Route::post('/verify', 'Auth\SubjectController@postVerify');

Route::get('/sendmail','Auth\MailController@sendMail');
Route::get('/resend','Auth\MailController@resend');