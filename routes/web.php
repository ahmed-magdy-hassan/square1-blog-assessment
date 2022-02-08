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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('posts', \App\Http\Controllers\Web\PostController::class)->except(['edit', 'update', 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', \App\Http\Controllers\Web\UserController::class)->except(['show', 'destroy']);
});
