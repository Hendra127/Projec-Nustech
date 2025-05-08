<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('tiket', function () {
		return view('tiket');
	})->name('tiket');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

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
    Route::get('users', [InfoUserController::class, 'index'])->name('users');
    Route::post('users', [InfoUserController::class, 'save'])->name('users.save');
    Route::put('user/{id}', [InfoUserController::class, 'saveUpdate'])->name('user.update');
    Route::get('user/delete/{id}', [InfoUserController::class, 'delete'])->name('user.delete');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

    // Menambahkan route pencarian untuk SiteController
	Route::get('/tables', [SiteController::class, 'index'])->name('tables');
    Route::get('/search', [SiteController::class, 'search'])->name('site.search'); // Route pencarian

	Route::post('/tables', [SiteController::class, 'index'])->name('tables');
	Route::get('/halaman-baru', [App\Http\Controllers\HalamanTest::class, 'index'])->name('halaman.baru');
	Route::get('/dataexport', [SiteController::class, 'dataexport'])->name('dataexport');
	Route::post('/dataimport', [SiteController::class, 'dataimport'])->name('dataimport');
	Route::get('/datacreate', [SiteController::class, 'create'])->name('datacreate');
	Route::get('/dataupdate/{id}', [SiteController::class, 'edit'])->name('edit');
	Route::post('/store', [SiteController::class, 'store'])->name('store');
	Route::post('/update/{id}', [SiteController::class, 'update'])->name('update');

	// Menambahkan Route untuk TiketController
	Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');
	Route::post('/tiketimport', [TiketController::class, 'tiketimport'])->name('tiketimport');
	Route::get('/tiketexport', [TiketController::class, 'tiketexport'])->name('tiketexport');
	Route::post('/tiket', [TiketController::class, 'store'])->name('tiket.store');
	Route::put('/tiket/{id}', [TiketController::class, 'update'])->name('tiket.update');
	Route::put('/tiket/{id}/update-status', [TiketController::class, 'updateStatus'])->name('tiket.updateStatus');

    Route::get('/close/tiket', [TiketController::class, 'closeTiket'])->name('close.tiket');



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
