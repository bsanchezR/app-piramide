<?php

use App\Http\Controllers\PyramidController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PyramidController::class, 'showForm'])->name('piramide.form');
Route::post('/genera', [PyramidController::class, 'genera'])->name('piramide.genera');