<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/nova', 301);
// Route::get('/', function () {
//     return view('nova::auth.login');
// });

// Route::get('/nova/login', function () {
//     return view('vendor/nova/auth/login');
// });

Route::get('/nova/signup', function () {
    return view('nova::auth/signup');
})->name('nova.signup');

route::post('/nova/signup-create','App\Http\Controllers\SocialLoginController@create')->name('nova.signup.create');
route::post('/nova/signup-final','App\Http\Controllers\SocialLoginController@create_final')->name('nova.signup.final');
Route::post('/nova/password/reset', function () {
    return view('nova::auth/passwords/reset');
})->name('password.reset');

Route::get('nova/login/google', 'App\Http\Controllers\SocialLoginController@redirectToGoogle')->name('nova.login.google');
Route::get('nova/login/linkedin', 'App\Http\Controllers\SocialLoginController@redirectToLinkedIn')->name('nova.login.linkedin');

Route::get('nova/google/callback', 'App\Http\Controllers\SocialLoginController@processGoogleCallback');
Route::get('nova/linkedin/callback', 'App\Http\Controllers\SocialLoginController@processLinkedInCallback');
