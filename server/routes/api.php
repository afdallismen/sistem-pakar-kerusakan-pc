<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\GejalaKonsultasiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DiagnosaController;

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
Route::delete('/gejala/bulk', [GejalaController::class, 'bulkDestroy']);
Route::delete('/kerusakan/bulk', [KerusakanController::class, 'bulkDestroy']);
Route::delete('/rule/bulk', [RuleController::class, 'bulkDestroy']);
Route::delete('/konsultasi/bulk', [KonsultasiController::class, 'bulkDestroy']);
Route::delete('/gejala-konsultasi/bulk', [GejalaKonsultasiController::class, 'bulkDestroy']);
Route::delete('/pelanggan/bulk', [PelangganController::class, 'bulkDestroy']);
Route::delete('/diagnosa/bulk', [DiagnosaController::class, 'bulkDestroy']);

Route::get('/konsultasi/{konsultasi}/diagnosa', [KonsultasiController::class, 'diagnosa']);

Route::apiResource('gejala', GejalaController::class);
Route::apiResource('kerusakan', KerusakanController::class);
Route::apiResource('rule', RuleController::class);
Route::apiResource('konsultasi', KonsultasiController::class);
Route::apiResource('gejala-konsultasi', GejalaKonsultasiController::class);
Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('diagnosa', DiagnosaController::class);
