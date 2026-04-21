<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//rotte protette eccetto index e show
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('students', \App\Http\Controllers\StudentController::class)->only(['store', 'update', 'destroy']);
});

Route::apiResource('students', \App\Http\Controllers\StudentController::class)->only(['index', 'show']);

//chiamata post che crea il personal_access_token (bisogna creare un User e inserire nel body del POST i parametri per i quali facciamo la validazione sotto)
Route::post('/login', function(Request $request) {
    $credentials = $request->validate([
        'email' => "required|email",
        'password' => 'required',
    ]);
    if(auth()->attempt($credentials)) {
        $user = auth()->user();
        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
    return response()->json(['message' => 'Invalid Credentials'], 401);
})->name('login');
