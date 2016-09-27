<?php

Route::get('/admin', function () {
//    dd(Auth::guard('admin')->user());
    $subject = DB::select('select * from add_subjects ORDER by id DESC ');

    return view('admin.welcome', ['subject' => $subject]);
});

//Route::get('admin/logout', 'AdminAuth\LoginController@logout');
Route::post('admin/logout', 'AdminAuth\LoginController@logout');

Route::resource('admin/post', 'AdminAuth\SubjectController');

Route::get('admin/setting', 'AdminAuth\SettingController@getSetting');
Route::post('admin/setting', 'AdminAuth\SettingController@postUpdate');
Route::get('admin/setting/adminverify', 'AdminAuth\SettingController@postAdminVerify');
Route::post('admin/setting/filedir', 'AdminAuth\SettingController@fileDir');
Route::get('admin/addid', 'AdminAuth\AddIDController@getAddID');
Route::post('admin/addid', 'AdminAuth\AddIDController@postAddID');




