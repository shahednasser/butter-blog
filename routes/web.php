<?php

use App\Http\Controllers\BlogController;
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

Route::get('/', [App\Http\Controllers\BlogController::class, 'home']);

Route::get('/post/{slug}', [App\Http\Controllers\BlogController::class, 'showPost'])->name('post');

Route::post('/post/{slug}', [App\Http\Controllers\BlogController::class, 'addComment'])->name('post.comment');

Route::webhooks('/new-post', [App\Http\Controllers\BlogController::class, 'sendNotification']);