<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get(
    'user/all/paginated',
    [UserController::class, 'getAllPaginated']
)->name('user.paginated');
Route::apiResource('user', UserController::class);

Route::get('store/all/paginated',[StoreController::class,'getAllPaginated']);
Route::post('store/{id}/verified',[StoreController::class,'updateVerifiedStatus']);
Route::apiResource('store',StoreController::class);