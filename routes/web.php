<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\admin\tagController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

//home page
Route::get('/', [HomeController::class, 'index'])->name('home');
//Register
    Route::view('register', 'register')->name('register')->middleware('can:isAdmin');
    Route::post('registerSave', [UserController::class, 'register'])->name('registerSave');

//login
Route::view('login', 'login')->name('login');
Route::post('loginMatch', [UserController::class, 'login'])->name('loginMatch');
//logout
Route::post('logout', [UserController::class, 'logout'])->name('logout');

//post 
Route::middleware(['auth'])->group(function () {
        Route::resource('post', PostController::class);
});

//tag 
    Route::resource('tag', tagController::class)->middleware('can:isAdmin');

//Forgot Password
Route::get('password/forgot', [ForgotPasswordController::class, 'forgotPassword'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('password.forgot.post');
Route::get('password/forgot/{token}', [ForgotPasswordController::class, 'ShowLinkForm'])->name('password.forgot.link');
Route::post('resetpassword', [ForgotPasswordController::class, 'resetPassword'])->name('resetpassword');

//comment
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/post/{post}', [CommentController::class, 'show'])->name('post.show');
// web.php
Route::get('/post/{post}/reply', [HomeController::class, 'index'])->name('post.reply');
