<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['namespace' => 'NineCells\Member\Http\Controllers'], function() {

        Route::get('auth/register', 'AuthController@getRegister');
        Route::post('auth/register', 'AuthController@postRegister');

        Route::get('auth/github', 'AuthController@redirectToProvider');
        Route::get('auth/github/callback', 'AuthController@handleProviderCallback');

        Route::get('auth/login', 'AuthController@getLogin');
        Route::post('auth/login', 'AuthController@postLogin');
        Route::post('auth/logout', 'AuthController@logout');

        Route::get('members/{member_id}', 'MemberController@GET_member')->name('ncells::url.auth.member_profile');
    });
});
