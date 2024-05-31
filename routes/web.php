<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', function () {
    return view('import');
});

Route::post('/import', [ProductController::class, 'import'])->name('import');
