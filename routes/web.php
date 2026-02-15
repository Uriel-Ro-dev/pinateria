<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pinatas', App\Http\Controllers\PinatasController::class)->middleware('auth');

Route::get('/delete-pinata/{id}', [
    'as' => 'deletePinata',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PinatasController@destroy'
]);

Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');

Route::get('/delete-categoria/{id}', [
    'as' => 'deleteCategoria',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\CategoriaController@destroy'
]);
