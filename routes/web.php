<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorreoController;

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

Route::get('inventarioPDF',[App\Http\Controllers\GeneradorController::class, 'imprimirInventario'])->name('imprimirInventario');

Route::get('registroVentasPDF', [App\Http\Controllers\GeneradorController::class, 'registroVentas'])->name('ventas.pdf');

Route::resource('asset', App\Http\Controllers\AssetController::class)->middleware('auth');

Route::get('/video-file/{filename}', array(
   'as' => 'fileVideo',
   'uses' => 'App\Http\Controllers\AssetController@getVideo'
));
Route::get('/miniatura/{filename}', array(
   'as' => 'imageVideo',
   'uses' => 'App\Http\Controllers\AssetController@getImage'
));

Route::get('/correo-prueba', [CorreoController::class, 'enviarPrueba']);
