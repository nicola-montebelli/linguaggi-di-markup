<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories = DB::query()->select('id', 'name', 'description')->from('categories')->get();
        $categories = DB::query()->select('id', 'name', 'description')->from('categories')->get();
        return response()->json($categories);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);
        $category = DB::table('categories')->insert($validate);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        if($category){
            return response()->json($category);
        } else{
            return response()->json(['message' => 'Categoria non trovata'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);
        $updated = DB::table('categories')->where('id', $id)->update($validatedData);
        $category = DB::table('categories')->where('id', $id)->first();
        if ($updated) {
            return response()->json(['message' => 'Categoria aggiornata', 'category' => $category]);
        } else {
            return response()->json(['message' => 'Categoria non trovata'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = DB::table('categories')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Categoria eliminata']);
        } else {
            return response()->json(['message' => 'Categoria non trovata'], 404);
        }
    }
}

//file creato con un biolerplate con php artisan make:controller CategoryController --api  