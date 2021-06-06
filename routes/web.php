<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::group(['middleware' => ['guest']], function () {

    //ログインホーム画面
    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('login.show');
    //ログイン処理
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
});

Route::group(['middleware' => ['auth']], function () {
    //ホーム画面
    Route::get('home', function () {
        return view('home');
    })->name('home');
    //ログアウト
    Route::post(
        'logout',
        [AuthController::class, "logout"]
    )->name('logout');
});

//登録画面
Route::get('register', function () {
    return view('register');
})->name('register');
//db登録
Route::post(
    'register',
    [AuthController::class, "register"]
)->name('register');
