<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

//  Route::group(['prefix' => 'adminapp'], function () {

Route::get('/adminapp/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/adminapp/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/adminapp/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');
                
                

Route::post('/adminapp/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/adminapp/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/adminapp/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/adminapp/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/adminapp/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/adminapp/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/adminapp/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/adminapp/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/adminapp/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/adminapp/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
                
//  });
