<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get(
    'user/all/paginated',
    [UserController::class, 'getAllPaginated']
)->name('user.paginated');

Route::apiResource('user', UserController::class);