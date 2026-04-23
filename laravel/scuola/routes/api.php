<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
    })->middleware('auth:sanctum');
    
//rotta per la ricerca
Route::post('/students/search', [\App\Http\Controllers\StudentController::class, 'search'])->name('students.search');
//rotte protette eccetto index e show
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/courses/{course}/students', [\App\Http\Controllers\CourseController::class, 'addStudents'])->name('courses.enroll');
    Route::delete('/courses/{course}/students/{student}', [\App\Http\Controllers\CourseController::class, 'removeStudent'])->name('courses.removeStudent');
    Route::apiResource('students', \App\Http\Controllers\StudentController::class)
    ->only(['store', 'update', 'destroy']);
    Route::apiResource('courses', \App\Http\Controllers\CourseController::class)
    ->only(['store', 'update', 'destroy']);
});

Route::apiResource('students', \App\Http\Controllers\StudentController::class)
->only(['index', 'show']);
Route::apiResource('courses', \App\Http\Controllers\CourseController::class)
->only(['index', 'show']);

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



/**
 * "message": "No query results for model [App\\Models\\Course] 1",
 * "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
 * Errori nelle query per le chiamate a /courses
 * guardare il file del prof 
 */