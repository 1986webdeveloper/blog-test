<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('blogs', BlogController::class);
    Route::post('/hasDuplicateBlogTitle', [BlogController::class, 'hasDuplicateBlogTitle'])->name('hasDuplicateBlogTitle');
});
Route::get('/blog/{id}', [BlogController::class, 'singlePage'])->name('single-page');

