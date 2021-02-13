<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/private', [PrivateController::class, 'index'])->name('private');

Route::get('/private/user/index', [UserController::class, 'index'])->name('private.user.index');
Route::get('/private/user/getIndexTable', [UserController::class, 'getIndexTable'])->name('private.userList');
Route::get('/private/user/create', [UserController::class, 'create'])->name('private.userCreate');
Route::get('/private/user/show/{id}', [UserController::class, 'show'])->name('private.userShow');
Route::post('/private/user/update/{id}', [UserController::class, 'update'])->name('private.userUpdate');
Route::post('/private/user/store', [UserController::class, 'store'])->name('private.userStore');
Route::post('/private/user/delete/{id}', [UserController::class, 'destroy'])->name('private.userDelete');

Route::get('/private/files/index', [FileController::class, 'index'])->name('private.files.index');
Route::get('/private/files/getIndexTable', [FileController::class, 'getIndexTable'])->name('private.files.getIndexTable');
Route::post('/private/file/uploadFile', [FileController::class, 'uploadFile'])->name('private.files.uploadFile');
Route::post('/private/file/delete', [FileController::class, 'delete'])->name('private.files.deleteFile');