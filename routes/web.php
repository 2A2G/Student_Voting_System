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
                $caso = 'dashboard';
                return view('livewire.dashboard', compact('caso'));
            })->name('dashboard');

            Route::prefix('/gestion')->group(function () {
                Route::get('/rolesPermisos', function () {
                    $caso = 'rolesPermisos';
                    return view('livewire.dashboard', compact('caso'));
                })->name('rolesPermisos');


                Route::get('/usuarios', function () {
                    $caso = 'usuarios';
                    return view('livewire.dashboard', compact('caso'));
                })->name('usuarios');
            });
        });
    }
);
