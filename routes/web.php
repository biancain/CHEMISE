<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Prueba;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProduccionController::class, 'index'])->name('funcionarios.index');
Route::get('search/funcionario', [SearchController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/funcionario/update', [ProduccionController::class, 'update'])->name('funcionarios.update');
Route::post('test/', [ProduccionController::class, 'test']);
Route::get('/prueba', [Prueba::class, 'prueba']);
Route::post('insert/', [ProduccionController::class, 'insert']);