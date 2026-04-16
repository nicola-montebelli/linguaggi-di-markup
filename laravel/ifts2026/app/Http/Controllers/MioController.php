<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MioController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'utile per leggere la lista delle risorse',
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'utile per creare una nuova risorsa',
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'message' => "utile per leggere i dettagli della risorsa con id: $id",
        ]); 
    }
    
    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => "utile per aggiornare la risorsa con id: $id",
        ]); 
    }

    public function destroy($id)
    {        return response()->json([
            'message' => "utile per eliminare la risorsa con id: $id",
        ]); 
    }
}
