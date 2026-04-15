<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

$utenti = [
    ['id' => 1, 'nome' => 'Mario', 'cognome' => 'Rossi', 'email' => 'mario@example.com'],
    ['id' => 2, 'nome' => 'Luigi', 'cognome' => 'Verdi', 'email' => 'luigi@example.com'],
    ['id' => 3, 'nome' => 'Anna', 'cognome' => 'Bianchi', 'email' => 'anna@example.com'],
    ['id' => 4, 'nome' => 'Giovanni', 'cognome' => 'Neri', 'email' => 'giovanni@example.com'],
    ['id' => 5, 'nome' => 'Francesca', 'cognome' => 'Gialli', 'email' => 'francesca@example.com'],
    ['id' => 6, 'nome' => 'Marco', 'cognome' => 'Verdi', 'email' => 'marco@example.com'],
    ['id' => 7, 'nome' => 'Laura', 'cognome' => 'Rosa', 'email' => 'laura@example.com'],
    ['id' => 8, 'nome' => 'Paolo', 'cognome' => 'Blu', 'email' => 'paolo@example.com'],
    ['id' => 9, 'nome' => 'Elena', 'cognome' => 'Gialli', 'email' => 'elena@example.com'],
    ['id' => 10, 'nome' => 'Alessandra', 'cognome' => 'Verdi', 'email' => 'alessandra@example.com']
];


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/nico')->group(function() use ($utenti)  {
    Route::get('/utenti', function () use ($utenti) {
        Log::info('Stampo gli utenti');
        return response()->json($utenti);
    }); //questa Route::get stampa tutto l'array di $utenti
    Route::post('/utenti', function (Request $request) use($utenti){
        $utenti[] = ['id' => $request->input('id'),];
        return response()->json($utenti);
    });
});