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

Route::view('/', 'welcome')->name('welcome')->middleware('guest');
Route::view('/privacy', 'privacy')->name('privacy')->middleware('auth');

Route::middleware(['auth', 'accept'])->group(function () {
    Route::view('/info', 'info')->name('info');
    Route::view('/calendar', 'calendar')->name('calendar');
    Route::view('/gallery', 'gallery')->name('gallery');
});

Auth::routes(['register' => false, 'verify' => false]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('users', 'UserController', ['except' => ['show']]);
Route::resource('clients', 'ClientController', ['except' => ['show']]);
Route::resource('offices', 'OfficeController', ['except' => ['show']]);
Route::resource('tags', 'TagController', ['except' => ['show']]);
Route::resource('birthdays', 'BirthdayController', ['only' => ['index']]);
Route::resource('accept', 'AcceptController', ['only' => ['create', 'store']]);
Route::resource('activities', 'ActivityController', ['only' => ['index', 'destroy']]);

Route::put('profile/{user}', 'ProfileController@update')->name('profile.update');
Route::put('users/{user}/password', 'UserPasswordController@update')->name('users.password.update');
