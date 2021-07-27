<?php

use App\Http\Controllers\AuthController;
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
});

Route::post('/create',[AuthController::class,'create'])->name('auth.create');
Route::post('/check',[AuthController::class,'check'])->name('auth.check');
Route::get('/reset-password/{id}',[AuthController::class,'updateForm'])->name('auth.updat');
Route::post('/update-password',[AuthController::class,'update'])->name('auth.update');
Route::post('/sendmail',[AuthController::class,'sendmail'])->name('auth.sendmail');
Route::get('/forgot-password',[AuthController::class,'forgot'])->name('auth.forgot');


Route::group(['middleware'=>['AuthCheck']],function(){
    Route::get('/welcome',[AuthController::class,'welcome'])->name('user.welcome');
    Route::get('/login',[AuthController::class,'login'])->name('user.login');
    Route::get('/register',[AuthController::class,'register']);
    Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
});
