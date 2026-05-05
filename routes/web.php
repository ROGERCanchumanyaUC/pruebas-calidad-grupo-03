<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/cursos', 'cursos')->name('cursos');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/calidad', 'calidad')->name('calidad');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/checkout', 'checkout')->name('checkout');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
