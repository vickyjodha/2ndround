<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as User;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::post('login', [User::class, 'login'])->name('login')->name('login');
Route::post('register', [User::class, 'register'])->name('register');
Route::post('userimage', [User::class, 'imageUploadPost'])->name('imageuser');
Route::view('image', 'imageupload')->name('imageperview');
