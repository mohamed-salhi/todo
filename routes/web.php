<?php

use App\Http\Controllers\todocontroller;
use App\Mail\emailtodo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;




Route::get('/massges',[todocontroller::class,'massges'])->name('massges')->middleware('auth');
Route::post('/massges',[todocontroller::class,'postmassges'])->name('massges')->middleware('auth');
Route::get('/todo',[todocontroller::class,'index'])->name('todo')->middleware('auth');
Route::post('/todo',[todocontroller::class,'store'])->name('todo')->middleware('auth');
Route::delete('/destroy',[todocontroller::class,'destroy'])->name('destroy')->middleware('auth');
Route::post('/update',[todocontroller::class,'update'])->name('update')->middleware('auth');
Route::post('/addyestardat',[todocontroller::class,'addyestardat'])->name('addyestardat')->middleware('auth');
Route::get('/history',[todocontroller::class,'history'])->name('history')->middleware('auth');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
