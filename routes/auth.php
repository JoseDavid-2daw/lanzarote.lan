<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/libros'       , [LibroController::class, 'listado'])
        ->name('libros.listado');

    Route::get('/libro/{id}'            , [LibroController::class, 'mostrar'])
        ->name('libros.mostrar');

    Route::get('/libro/actualizar/{id}' , [LibroController::class, 'actualizar'])
        ->name('libros.actualizar');

    Route::get('/libro/eliminar/{id}'   , [LibroController::class, 'eliminar'])
        ->name('libros.eliminar');

    Route::get('/libros/nuevo'          , [LibroController::class, 'alta'])
        ->name('libros.alta');

    Route::post('/libros/nuevo'         , [LibroController::class, 'almacenar'])
        ->name('libros.almacenar');

    Route::get('/usuarios'       , [UsuarioController::class, 'listado'])
    ->name('usuarios.listado');

    Route::get('/usuario/{id}'            , [UsuarioController::class, 'mostrar'])
        ->name('usuarios.mostrar');

    Route::get('/usuario/actualizar/{id}' , [UsuarioController::class, 'actualizar'])
        ->name('usuarios.actualizar');

    Route::get('/usuario/eliminar/{id}'   , [UsuarioController::class, 'eliminar'])
        ->name('usuarios.eliminar');

    Route::get('/usuarios/nuevo'          , [UsuarioController::class, 'alta'])
        ->name('usuarios.alta');

    Route::post('/usuarios/nuevo'         , [UsuarioController::class, 'almacenar'])
        ->name('usuarios.almacenar');
});
