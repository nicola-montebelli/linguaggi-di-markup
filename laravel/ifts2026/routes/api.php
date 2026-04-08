<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/info', function() {
    return response()->json([
        'message' => 'Stampa info'
    ]);
});

Route::get('/product', function(Request $request) {
    Log::debug('metodo:'.$request->method());
    Log::debug(request()->getMethod());
    Log::debug(FacadeRequest::method());    //controllare il file /logs/*data-odierna.log
    return response()->json([
        'message' => 'Lista Prodotti',
    ]);
});

Route::post('/product', function () {
    return response()->json([
        'message' => 'Creazione Prodotto',
    ]);
});

Route::put('/product/{id}', function ($id) {
    return response()->json([
        'message' => "Aggiornamento Prodotto con ID: $id",
    ]);
});

Route::delete('/product/{id}', function ($id) {
    return response()->json([
        'message' => "Eliminazione Prodotto con ID: $id",
    ]);
});


//creare la rotta per lo show del prodotto
Route::get('/product/{id}', function($id) {
    return response()->json([
        'message' => 'Singolo prodotto con ID: ' + $id + 'visualizzato',
    ]);
});

