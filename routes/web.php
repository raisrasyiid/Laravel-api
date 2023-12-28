<?php

use App\Http\Controllers\BukuController as ControllersBukuController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('buku', [ControllersBukuController::class, 'index']);

Route::post('buku', [ControllersBukuController::class, 'store']);

Route::get('buku/{id}', [ControllersBukuController::class, 'edit']);

Route::put('buku/{id}', [ControllersBukuController::class, 'update']);

Route::delete('buku/{id}', [ControllersBukuController::class, 'destroy']);
