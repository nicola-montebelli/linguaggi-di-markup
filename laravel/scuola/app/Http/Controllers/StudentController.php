<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentController extends Controller
{
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:20',
            'surname' => 'nullable|string|max:20',
        ]);    
        if (empty($validatedData['name']) && empty($validatedData['surname'])) {
            return response()->json(['message' => 'At least one search parameter is required'], 400);
        }
        switch (true) {
            case empty($validatedData['name']) && !empty($validatedData['surname']):
                $students = Student::where('surname', 'like', "%{$validatedData['surname']}%")
                    ->get();
                break;
            case !empty($validatedData['name']) && empty($validatedData['surname']):
                $students = Student::where('name', 'like', "%{$validatedData['name']}%")
                    ->get();
                break;
            case !empty($validatedData['name']) && !empty($validatedData['surname']):
                $students = Student::where('name', 'like', "%{$validatedData['name']}%")
                    ->where('surname', 'like', "%{$validatedData['surname']}%")
                    ->get();
                break;
        }
        
        return response()->json($students);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        //$students = DB::table('students')->get();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:150',
            'birth_date' => 'nullable|date',
            'fiscal_code' => 'nullable|string|max:16',
            'civil_status' => 'nullable|string|max:20'
        ]);

        // $result = DB::table('students')->insert($validatedData);
        // $student = DB::table('students')->where('id', DB::getPdo()->lastInsertId())->firstOrFail();   
        $student = Student::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'mobile' => $validatedData['mobile'] ?? null,
            'email' => $validatedData['email'] ?? null,
            'birth_date' => $validatedData['birth_date'] ?? null,
        ]);
        $student->profile()->create([
            'fiscal_code' => $validatedData['fiscal_code'] ?? null,
            'civil_status' => $validatedData['civil_status'] ?? null,
        ]);
        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with(['profile','votes'])->findOrFail($id);
        // $student = DB::table('students')->where('id', $id)->firstOrFail();
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:150',
            'birth_date' => 'nullable|date',
        ]);

        // DB::table('students')->where('id', $id)->update($validatedData);
        // $student = DB::table('students')->where('id', $id)->firstOrFail();
        $student = Student::findOrFail($id);
        $student->update($validatedData);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $student = DB::table('students')->where('id', $id)->firstOrFail();
        // DB::table('students')->where('id', $id)->delete();
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json($student);
    }
}
