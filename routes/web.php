<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\SpesialisController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\UserController;
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

Route::get('/', [WebController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Kecamatan */

Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::get('/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

/* Spesialis */

Route::get('/spesialis', [SpesialisController::class, 'index'])->name('spesialis');
Route::get('/spesialis/add', [SpesialisController::class, 'add']);
Route::post('/spesialis/insert', [SpesialisController::class, 'insert']);
Route::get('/spesialis/edit/{id_spesialis}', [SpesialisController::class, 'edit']);
Route::post('/spesialis/update/{id_spesialis}', [SpesialisController::class, 'update']);
Route::get('/spesialis/delete/{id_spesialis}', [SpesialisController::class, 'delete']);

/* Rumah Sakit */
Route::get('/rumahsakit', [RumahSakitController::class, 'index'])->name('rumahsakit');
Route::get('/rumahsakit/add', [RumahSakitController::class, 'add']);
Route::post('/rumahsakit/insert', [RumahSakitController::class, 'insert']);
Route::get('/rumahsakit/edit/{id_rumahsakit}', [RumahSakitController::class, 'edit']);
Route::post('/rumahsakit/update/{id_rumahsakit}', [RumahSakitController::class, 'update']);
Route::get('/rumahsakit/delete/{id_rumahsakit}', [RumahSakitController::class, 'delete']);


/* User*/
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);


/* Frontend */
Route::get('/kecamatan/{id_kecamatan}', [WebController::class, 'kecamatan']);
Route::get('/spesialis/{id_spesialis}', [WebController::class, 'spesialis']);
Route::get('/detailrumahsakit/{id_rumahsakit}', [WebController::class, 'detailrumahsakit']);
