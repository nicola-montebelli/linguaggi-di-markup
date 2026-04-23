<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Student;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'duration' => 'required|integer',
        ]);

        $course = Course::create($validatedData);
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Student $student)
    {
        return response()->json($course->load('students'));
        //durante la lettura del corso (show) restituire anche gli studenti iscritti al corso
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'duration' => 'required|integer'
        ]);
        $course->update($validatedData);
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null,204);
    }

    public function addStudents(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'integer|exists:students,id',
        ]);

        $course->students()->syncWithoutDetaching($validatedData['student_ids']);

        return response()->json($course->load('students'));
    }

    public function removeStudent(Course $course, Student $student)
    {
        $course->students()->detach($student->id);
        return response()->json(
            [
                'message' => 'Student removed from course successfully.',
                'course' => $course->load('students')
            ]
        );
    }
}
