<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\BigQueryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
Route::get('/', [HomeController::class, 'landing']);

Route::get('/landing', [HomeController::class, 'landing'])->name('landing');

Route::get('/verify/{email}', [RegisterController::class, 'userVerify'])->name('user.verify');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify_email');
	Route::post('/welcome-lauz', [RegisterController::class, 'sendVerifyEmail'])->name('send_verify_email');
	Route::post('/re-send-email', [RegisterController::class, 'reSendVerifyEmail'])->name('re_send_email');

	Route::get('/quiz', [RegisterController::class, 'quiz'])->name('quiz');
	Route::post('/store-quiz', [RegisterController::class, 'storeQuiz'])->name('store.quiz');

	Route::get('/get-netpl', [BigQueryController::class, 'getNetPL'])->name('get.netpl');
	Route::get('/get-annual-return', [BigQueryController::class, 'getAnnualReturn'])->name('get.annual.return');
	Route::get('/get-profit-factor', [BigQueryController::class, 'getProfitFactor'])->name('get.profit.factor');
	Route::get('/get-win-lost', [BigQueryController::class, 'getWinLost'])->name('get.win.lost');

	
	Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::get('my-accounts', function () {
		return view('my-accounts');
	})->name('my-accounts');

	Route::get('import-trades', function () {
		return view('import-trades');
	})->name('import-trades');

	Route::get('leader-strategys', function () {
		return view('leader-strategys');
	})->name('leader-strategys');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	

    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');