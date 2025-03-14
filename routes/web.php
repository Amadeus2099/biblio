<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Redirigir a dashboards según el tipo de usuario
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard del Administrador (Protegido con Middleware)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // Gestión de usuarios (solo admin)
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::patch('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

        // Gestión de libros (solo admin)
        Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
        Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
        Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
        Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
        Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
        Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

        // Gestión de préstamos (solo admin)
        Route::get('/prestamos/admin', [PrestamoController::class, 'adminIndex'])->name('prestamos.admin');
        Route::patch('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
    });

    // Dashboard del Usuario
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');

    // Consultar y solicitar préstamos (usuario)
    Route::get('/consultaYprestamo', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');

    // Perfil de usuario (admin y usuario)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación y registro
require __DIR__.'/auth.php';
