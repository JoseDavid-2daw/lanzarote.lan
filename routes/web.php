<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:admin|editor']], function () {
    Route::get('/libros'                  , [LibroController::class, 'listado'])->name('libros.listado');
    Route::get('/libro/{id}'              , [LibroController::class, 'mostrar'])->name('libros.mostrar');
    Route::get('/libro/actualizar/{id}'   , [LibroController::class, 'actualizar'])->name('libros.actualizar');
    Route::post('/libros/nuevo'           , [LibroController::class, 'almacenar'])->name('libros.almacenar');
    Route::get('/usuarios'                , [UsuarioController::class, 'listado'])->name('usuarios.listado');
    Route::get('/usuario/{id}'            , [UsuarioController::class, 'mostrar'])->name('usuarios.mostrar');
    Route::get('/usuario/actualizar/{id}' , [UsuarioController::class, 'actualizar'])->name('usuarios.actualizar');
    Route::post('/usuarios/nuevo'         , [UsuarioController::class, 'almacenar'])->name('usuarios.almacenar');
    Route::get('/products'                , [ProductsController::class, 'listado'])->name('products.listado');
    Route::get('/product/{id}'            , [ProductsController::class, 'mostrar'])->name('products.mostrar');
    Route::get('/product/actualizar/{id}' , [ProductsController::class, 'actualizar'])->name('products.actualizar');
    Route::post('/products/nuevo'         , [ProductsController::class, 'almacenar'])->name('products.almacenar');

});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', function () {
        return "Página de administración";    
    });
    Route::get('/libro/eliminar/{id}'     , [LibroController::class, 'eliminar'])->name('libros.eliminar');
    Route::get('/libros/nuevo'            , [LibroController::class, 'alta'])->name('libros.alta');
    Route::get('/usuario/eliminar/{id}'   , [UsuarioController::class, 'eliminar'])->name('usuarios.eliminar');
    Route::get('/usuarios/nuevo'          , [UsuarioController::class, 'alta'])->name('usuarios.alta');
    Route::get('/product/eliminar/{id}'   , [ProductsController::class, 'eliminar'])->name('products.eliminar');
    Route::get('/products/nuevo'          , [ProductsController::class, 'alta'])->name('products.alta');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');

require __DIR__.'/auth.php';
