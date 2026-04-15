<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/info', function() {
    return response()->json([
        'message' => 'Stampa info'
    ]);
});

Route::get('/products', function(Request $request) {
    Log::debug('metodo:'.$request->method());
    Log::debug(request()->getMethod());
    Log::debug(FacadeRequest::method());    //controllare il file /logs/*data-odierna.log
    return response()->json([
        'message' => 'Lista Prodotti',
    ]);
});

Route::post('/products', function () {
    return response()->json([
        'message' => 'Creazione Prodotto',
    ]);
});

Route::put('/products/{id}', function ($id) {
    return response()->json([
        'message' => "Aggiornamento Prodotto con ID: $id",
    ]);
});

Route::delete('/products/{id}', function ($id) {
    return response()->json([
        'message' => "Eliminazione Prodotto con ID: $id",
    ]);
});


//creare la rotta per lo show del prodotto
Route::get('/products/{id}', function($id) {
    return response()->json([
        'message' => 'Singolo prodotto con ID: ' + $id + 'visualizzato',
    ]);
});

Route::get('products/search/{name?}', function(Request $request, ?string $name = null){
    return Redirect::to(route('categories.search'));
    // return response()->json([
    //     'message' => "Ricerca prodotto con nome: $name",
    // ]);
});

Route::get('/categories/search', function (){
    return response()->json([
        'message' => 'ricerca categoria',
    ]);
})->name('categories.search');  //named route

Route::prefix('admin')->group(function(){
    Route::get('/admin-users', function(){
        return response()->json([
            'message' => 'Admin User List',
        ]);
    });
    Route::post('/admin-users', function () {
        return response()->json([
            'message' => 'Admin Users Creazione',
        ]);
    });
})->middleware('verify.param');  //app/http/middlware/verifyparam.php

//esercizietto middleware che filtra le richieste all'endpoint /products che 
//non hanno i parametri user=='ifts' e password=='2026'
Route::middleware('check.user')->group(function() {
    Route::get('/products', function (Request $request) {
        Log::debug('metodo:'.$request->method());
        return response()->json([
            'message' => 'Lista Prodotti',
        ]);
    });
    Route::post('/products', function () {
        return response()->json([
            'message' => 'Creazione Prodotto',
        ]);
    });
    Route::put('/products/{id}', function ($id) {
        return response()->json([
            'message' => "Aggiornamento Prodotto con ID: $id",
        ]);
    });
    Route::delete('/products/{id}', function ($id) {
        return response()->json([
            'message' => "Eliminazione Prodotto con ID: $id",
        ]);
    });
    //creare la rotta per lo show del prodotto con id dinamico
    Route::get('/products/{id}', function ($id) {
        return response()->json([
            'message' => "Dettagli Prodotto con ID: $id",
        ]);
    });
    Route::get('/products/search/{name?}', function (Request $request, ?string $name = null) {
        return Redirect::to(route('categories.search'));

        // return response()->json([
        //     'message' => "Ricerca Prodotto con nome: $name",
        // ]);
    });
    Route::get('/categories/search', function () {
        return response()->json([
            'message' => "Ricerca Categoria",
        ]);
    })->name('categories.search');
});


// Rotte per autentcazione con sanctum
Route::post('/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',            //qui si inseriscono le regole di validazione in modo semplice
        'password' => 'required|min:3',
    ]);
    //qui i parametri sono corretti, creiamo il token
    if (auth()->attempt($validated)) {
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }
    return response()->json(['message' => 'Invalid credentials'], 401);
})->name('login');

// Rotte protette da auth:sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', function () {
        return response()->json([
            'message' => 'Lista Utenti',
        ]);
    });
});