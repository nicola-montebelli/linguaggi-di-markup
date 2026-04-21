<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = DB::query()->select('id', 'name', 'price', 'color')->from('tools')->get();
        return response()->json($tools);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|between:0,999999.99',
            'color' => 'required|string|max:20'
        ]);
        $tools = DB::table('tools')->insert($validate);
        return response()->json($tools, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tool = DB::table('tools')->where('id', $id)->first();
        if($tool){
            return response()->json($tool);
        } else{
            return response()->json(['message' => 'Tool not found'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|between:0,999999.99',
            'color' => 'required|string|max:20'
        ]);
        $updated = DB::table('tools')->where('id', $id)->update($validatedData);
        $tool = DB::table('tools')->where('id', $id)->first();
        if ($updated) {
            return response()->json(['message' => 'Tool updated', 'tool' => $tool]);
        } else {
            return response()->json(['message' => 'Tool not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = DB::table('tools')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Tool removed']);
        } else {
            return response()->json(['message' => 'Tool not found'], 404);
        }
    }

    public function count()
    {
        $count = DB::table('tools')->count();
        return response()->json(['count' => $count]);
    }
}
