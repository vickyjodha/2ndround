<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\ProductController as Product;

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



Auth::routes(['verify' => true]);
Route::middleware('auth', 'verified')->group(function () {
    Route::view('/user', 'normal')->name('user');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::middleware('is_admin', 'verified', 'auth')->group(function () {
    Route::view('image', 'imageupload')->name('imageperview');
    Route::post('userimage', [User::class, 'imageUploadPost'])->name('imageuser');
    Route::get('/', function () {
        return view('welcome');
    });
});
Route::post('login', [User::class, 'login'])->name('login')->name('login');
Route::post('register', [User::class, 'register'])->name('register');

Route::middleware('is_admin', 'verified')->group(function () {
    Route::view('products/create', 'product.create')->name('product.create');
    Route::get('products', [Product::class, 'index'])->name('product');
    Route::post('products/store', [Product::class, 'store'])->name('product.store');
    Route::post('products/update/{product}', [Product::class, 'update'])->name('product.update');
    Route::get('products/edit/{id}', [Product::class, 'edit'])->name('product.edit');
    Route::delete('products/destroy/{product}', [Product::class, 'destroy'])->name('product.destroy');
    Route::get('products/show/{id}', [Product::class, 'show'])->name('product.show');
    // Route::resource('products', Product::class);
});
