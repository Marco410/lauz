<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\Lauz\BigQueryController;
use App\Http\Controllers\Lauz\PeriodTabController;
use App\Http\Controllers\Lauz\AccountsController;
use App\Http\Controllers\Lauz\NoteController;
use App\Http\Controllers\Lauz\OverviewTabController;
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


	//DASHBOARD
	Route::get('/get-accounts', [AccountsController::class, 'getAccounts'])->name('get.accounts');

	Route::get('/get-netpl', [BigQueryController::class, 'getNetPL'])->name('get.netpl');
	Route::get('/get-overview-data', [BigQueryController::class, 'getOverviewData'])->name('get.overview.data');
	Route::get('/get-calendar', [BigQueryController::class, 'getCalendar'])->name('get.calendar');
    Route::get('/get-mfe', [BigQueryController::class, 'getMFE'])->name('get.mfe');
    Route::get('/get-metrics', [BigQueryController::class, 'getMetrics'])->name('get.metrics');
    Route::get('/get-metrics', [BigQueryController::class, 'getMetrics'])->name('get.metrics');

	
	
	//TRADES
	Route::get('/get-total-trades', [BigQueryController::class, 'getTotalTrades'])->name('get.total.trades');
	
	//PERIOD ANALYSIS
	Route::get('/get-net-profit', [PeriodTabController::class, 'getNetProfit'])->name('get.net.profit');
	Route::get('/get-max-drawdown', [PeriodTabController::class, 'getMaxDrawdown'])->name('get.max.drawdown');
	Route::get('/get-overview-day', [PeriodTabController::class, 'getOverviewForDay'])->name('get.overview.day');
	Route::get('/get-instruments', [PeriodTabController::class, 'getInstruments'])->name('get.instruments');
	Route::get('/get-overview-day', [PeriodTabController::class, 'getOverviewDay'])->name('get.overview-day');
	
	Route::get('/notes', [NoteController::class, 'get'])->name('notes');
	Route::post('/create-note', [NoteController::class, 'create'])->name('create.note');
	
	Route::get('/get-daily-net-cumulative-pl', [OverviewTabController::class, 'getDailyNetCumulativePL'])->name('get-daily-net-cumulative-pl');
	Route::get('/get-performance-table', [OverviewTabController::class, 'getPerformanceTable'])->name('get-performance-table');
    Route::get('/get-recent-trades', [OverviewTabController::class, 'getRecentTrades'])->name('get.recent.trades');
    Route::get('/get-trades-direction', [OverviewTabController::class, 'getTradesForDirection'])->name('get.trades.direction');


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


    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {


    Route::get('/register', [RegisterController::class, 'create'])->name('register');
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
