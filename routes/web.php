<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;

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

Route::get('/', [PublicController::class, 'index'])->name('home');



Route::post('/verifyLogin', [AuthController::class, 'verifyLogin']);

Route::post('/file', [FileController::class, 'getFiles'])->name('files');

Route::post('/files/download', [FileController::class, 'downloadFiles'])->name('downloadFiles');

Route::get('login', [PublicController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');