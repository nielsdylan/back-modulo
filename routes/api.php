<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Configuracion\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('registrar', [AuthController::class, 'registrar'])->name('registrar');
Route::post('login', [AuthController::class, 'login'])->name('login');



Route::middleware('jwt.verify')->group(function(){

    Route::name('configuraciones.')->prefix('configuraciones')->group(function () {
        Route::name('usuarios.')->prefix('usuarios')->group(function () {
            Route::get('lista', [UsuarioController::class, 'lista'])->name('lista');
        });
    });

});
