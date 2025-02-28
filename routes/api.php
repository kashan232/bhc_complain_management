<?php

use App\Http\Controllers\ComplaintController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-districts', [ComplaintController::class, 'get_districts'])->name('get-districts');
Route::post('/store-complain', [ComplaintController::class, 'store_complain'])->name('store-complain');
Route::post('/store-contact', [ComplaintController::class, 'store_contact'])->name('store-contact');
Route::get('/get-talukas', [ComplaintController::class, 'getTalukas'])->name('get-talukas');

