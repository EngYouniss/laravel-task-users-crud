<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('users.view');
Route::get('/Create', [UserController::class, 'viewCreatePage'])->name('users.add');

Route::post('/create', [UserController::class, 'store'])->name('users.store');

Route::get('/update/{id}', [UserController::class, 'viewUpdatePage'])->name('users.update.view');
Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');

// الحذف (عندك GET؛ شغّال لكن غير مستحسن)
Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
