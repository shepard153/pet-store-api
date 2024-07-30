<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', PetController::class)->name('pets');
Route::post('/', [PetController::class, 'store'])->name('pets.store');
Route::get('/search', [PetController::class, 'search'])->name('pets.search');
Route::get('{id}', [PetController::class, 'show'])->name('pets.show');
Route::put('{id}/update', [PetController::class, 'update'])->name('pets.update');
Route::get('{id}/destroy', [PetController::class, 'destroy'])->name('pets.destroy');