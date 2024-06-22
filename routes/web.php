<?php

use App\Http\Controllers\ComponentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(
    function () {
        Route::prefix('inefrapasa')->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            Route::prefix('/gestion')->group(function () {
                Route::get('/rolesPermisos', function () {
                    return view('livewire.super-admin.roles');
                })->name('usuarios');
                
                Route::get('/usuarios', function () {
                    return view('livewire.super-admin.usuarios');
                })->name('usuarios');
            });
        });
    }
);
