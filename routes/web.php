<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/login', [AuthController::class, 'login']);
Route::post('/get-login', [AuthController::class, 'getLogin']);
Route::get('/logout', [AuthController::class, 'logOut']);

Route::get('/register',[AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'postRegister']);

Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);    
});