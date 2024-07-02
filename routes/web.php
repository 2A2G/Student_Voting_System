<?php


use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(
    function () {
        Route::prefix('inefrapasa')->group(function () {
            Route::get('/dashboard', [ViewController::class, 'index'])->name('dashboard');

            Route::prefix('/gestion')->group(function () {
                Route::get('/rolesPermisos', [ViewController::class, 'rolesPermisos'])->name('rolesPermisos');
                Route::get('/usuarios', [ViewController::class, 'usuarios'])->name('usuarios');
                Route::get('/estudiante', [ViewController::class, 'estudiante'])->name('viewEstudiantes');
            });
        });
    }
);