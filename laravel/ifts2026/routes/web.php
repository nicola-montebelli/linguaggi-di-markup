<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Url;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ifts2026', function () {
    Log::info('Accesso alla rotta /ifts2026');
    Log::debug('Url completo (facade): ' . Url::full());    //modificato il LOG_CHANNEL e STACK nel file .env
    Log::debug('Url completo (helper): ' . url()->current());
    return response()->json([
        'message' => 'Corso IFTS 2026 - Sviluppo di applicazioni web con Laravel',
    ]);
});

Route::get('/info', function(){
    return response()->view('info');
});