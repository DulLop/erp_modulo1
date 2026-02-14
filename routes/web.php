<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\TelasAlmacenController;
use App\Http\Controllers\MovimientoMaquilaController;


Route::get('/', function () {
    return view('welcome');
});

//Ver pantalla de materia prima
Route::get('/materiaprima', function () {
    return view('materiaprima.index');
});

//ver tabs de Telas>Control de entradas y salidas
Route::get('/materiaprima/telas/control', [LoteController::class, 'control'])
    ->name('materiaprima.control');


//tabla de lotes
Route::prefix('materiaprima')->group(function () {

    Route::get('/lotes', [LoteController::class, 'index']);
    Route::post('/lotes', [LoteController::class, 'store'])
    ->name('lotes.store');
    Route::put('/lotes/{lote}', [LoteController::class, 'update']);

    Route::patch('/lotes/{lote}/autorizacion', 
        [LoteController::class, 'cambiarAutorizacion']);

    Route::patch('/lotes/{lote}/ubicacion', 
        [LoteController::class, 'cambiarUbicacion']);

    Route::delete('/lotes/{lote}', 
    [LoteController::class, 'destroy']
    )->name('lotes.destroy');

    Route::post('/maquila/enviar', 
    [MovimientoMaquilaController::class, 'enviarLotes']
    )->name('maquila.enviar');

});


//tabla de MovimientosdeMaquila


Route::prefix('materiaprima')->group(function () {

    Route::post('/maquila', [MovimientoMaquilaController::class, 'store']);

    Route::patch(
        '/maquila/{movimiento}/salida',
        [MovimientoMaquilaController::class, 'cambiarAutorizacionSalida']
    );

    Route::patch(
        '/maquila/{movimiento}/llegada',
        [MovimientoMaquilaController::class, 'registrarLlegada']
    );

    Route::post('/lotes', [LoteController::class, 'store'])
    ->name('lotes.store');

    //actualizar estado de autorizacion de entradas

    Route::patch('/lotes/{lote}/autorizacion',
    [LoteController::class, 'cambiarAutorizacion']
    )->name('lotes.cambiarAutorizacion');

    //Vista Gestion de Almacen
    Route::get('/telas/almacen',
    [TelasAlmacenController::class, 'index']
    )->name('materiaprima.telas.almacen');




});

