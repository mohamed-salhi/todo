<?php

use App\Http\Controllers\todocontroller;
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

Route::get('/todo',[todocontroller::class,'index'])->name('todo')->middleware('auth');
Route::post('/todo',[todocontroller::class,'store'])->name('todo')->middleware('auth');
Route::delete('/destroy',[todocontroller::class,'destroy'])->name('destroy')->middleware('auth');
Route::post('/update',[todocontroller::class,'update'])->name('update')->middleware('auth');
Route::post('/addyestardat',[todocontroller::class,'addyestardat'])->name('addyestardat')->middleware('auth');
Route::get('/history',[todocontroller::class,'history'])->name('history')->middleware('auth');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
