<?php

use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MiCuentaController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/cursos', 'cursos')->name('cursos');
Route::view('/contacto', 'contacto')->name('contacto');
Route::get('/checkout', [CartController::class, 'index'])->name('checkout');

Route::post('/contacto/enviar', [ContactController::class, 'store'])->name('contacto.enviar');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/cart/add',    [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta',  [MiCuentaController::class, 'index'])->name('mi-cuenta');
    Route::post('/pago',      [PaymentController::class, 'process'])->name('pago.procesar');
    Route::get('/pago/exito', fn () => view('pago-exito'))->name('pago.exito');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleAdmin'])->name('users.toggle');
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
    Route::patch('/contacts/{contact}/read', [ContactsController::class, 'markRead'])->name('contacts.read');
    Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});
