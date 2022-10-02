<?php

use App\Http\Controllers\AddCandidateController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\Guest\LoginController;
use App\Http\Controllers\Guest\PasswordResetController;
use App\Http\Controllers\Guest\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\VoteController;
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

//login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('user.register');

//verify mail
// Route::get('/verify/{user_id}/{token}', [RegisterController::class, 'verifymail'])->name('verify.mail');

//password reset
Route::get('/forgotpassword', [PasswordResetController::class, 'index'])->name('forgetpassword');
Route::post('/resetlink', [PasswordResetController::class, 'resetLink'])->name('resetLink.mail');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// get number of candidate for the poll
Route::post('/reg/no/candidate', [HomeController::class, 'candidateNo'])->name('no.candidate');

// add candidate 
Route::post('/reg/add-candidate', [AddCandidateController::class, 'createPoll'])->name('add.can');


Route::get('/{poll_id}/control-centre', [ControlController::class, 'index'])->name('control');

Route::get('/{poll_id}/vote-centre', [ControlController::class, 'voteCentre'])->name('vote.centre');

// publish poll
Route::post('/{poll_id}/publish', [PublishController::class, 'publish'])->name('publish.poll');
// end poll
Route::post('/{poll_id}/end', [PublishController::class, 'endpoll'])->name('end.poll');

// voting link redirecting to emai request page
Route::get('/{poll_id}/vote', [EmailVerifyController::class, 'emailRequest'])->name('get.email');

Route::post('/{poll_id}/email/verify', [EmailVerifyController::class, 'emailVerify'])->name('verify.email');

Route::post('/{poll_id}/{cand_id}/vote', [VoteController::class, 'vote'])->name('vote.poll');

Route::get('/{poll_id}/result', [ResultController::class, 'index'])->name('poll.result');

Route::delete('/{poll_id}/deletepoll', [AddCandidateController::class, 'destroy'])->name('delete.poll');