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

Route::get('/', 'App\Http\Controllers\Auth\LoginController@index')
    ->name('login');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')
    ->name('user.login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')
    ->name('user.logout');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')
    ->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store')
    ->name('user.register');

Route::get('/home', 'App\Http\Controllers\HomeController@index')
    ->name('home');
Route::post('/reg/no/candidate', 'App\Http\Controllers\HomeController@candidateNo')
    ->name('no.candidate');

Route::post('/reg/add/can2', 'App\Http\Controllers\AddCandidateController@can2')
    ->name('add.can2');
Route::post('/reg/add/can3', 'App\Http\Controllers\AddCandidateController@can3')
    ->name('add.can3');
Route::post('/reg/add/can4', 'App\Http\Controllers\AddCandidateController@can4')
    ->name('add.can4');

Route::get('/{id}/control-centre', 'App\Http\Controllers\ControlController@index')
    ->name('control');
Route::get('/{id}/vote-centre', 'App\Http\Controllers\ControlController@voteCentre')
    ->name('vote.centre');

Route::post('/{id}/publish', 'App\Http\Controllers\Pub_EndController@publish')
    ->name('publish.poll');
Route::post('/{id}/end', 'App\Http\Controllers\Pub_EndController@endpoll')
    ->name('end.poll');

Route::get('/{id}/vote', 'App\Http\Controllers\EmailVerifyController@emailRequest')
    ->name('get.email');
Route::post('/{id}/email/verify', 'App\Http\Controllers\EmailVerifyController@emailVerify')
    ->name('verify.email');

Route::post('/{id}/vote', 'App\Http\Controllers\VoteController@vote')
    ->name('vote.poll');

Route::get('/{id}/result', 'App\Http\Controllers\ResultController@index')
    ->name('poll.result');

Route::delete('/{id}/deletepoll', 'App\Http\Controllers\AddCandidateController@destroy')
    ->name('delete.poll');