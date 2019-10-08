<?php

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Auth::routes(['verify' => true]);

//for user and admin
Route::group(['middleware' => 'verified'], function () {
	Route::get('home', 'HomeController@index')->name('home');
	Route::resource('bank', 'BankAccountsController');
	Route::resource('fd', 'FixedDepositsController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('/autocomplete', 'bankController@autocomplete')->name('autocomplete');

	Route::resource('lic', 'LicInvestmentsController');
});

//only for admin
Route::group(['middleware' => ['admin']], function () {
	Route::resource('user', 'UserController');
});