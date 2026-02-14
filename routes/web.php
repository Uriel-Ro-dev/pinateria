<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pinatas', App\Http\Controllers\PinatasController::class)->middleware('auth');

Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
