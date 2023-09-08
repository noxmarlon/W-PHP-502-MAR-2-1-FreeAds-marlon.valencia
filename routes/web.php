<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');
//route create annonce
Route::get('/annonce', [App\Http\Controllers\AdController::class, 'create'])->middleware(['auth','verified'])->name('ad.create');
//route store annonce
Route::post('/annonce/create', [App\Http\Controllers\AdController::class, 'store'])->middleware(['auth','verified'])->name('ad.store');
//ads route index

Route::get('/annonces', [App\Http\Controllers\AdController::class, 'index'])->name('ad.index');
// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth','verified'])->name('dashboard');

Route::view('/profile', 'profile')->middleware(['auth','verified'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->middleware(['auth','verified'])
        ->name('profile.update');

Route::post('/search', [App\Http\Controllers\AdController::class, 'search'])->name('ad.search');

//route message
Route::get('/message/{seller_id}/{ad_id}', [App\Http\Controllers\MessageController::class, 'create'])->middleware(['auth','verified'])->name('message.create');
Route::post('/message', [App\Http\Controllers\MessageController::class, 'store'])->middleware(['auth','verified'])->name('message.store');