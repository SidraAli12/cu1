<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Courses::all(); 
        return view('courses.index', compact('courses'));
    }

    // Store new course
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'track_id' => 'required|integer',
            'course' => 'required|string|max:255',
        ]);

        $course = Courses::create($request->only('subject_id','track_id','course',));

        return response()->json(['message' => 'Course added successfully', 'course' => $course]);
    }

    public function update(Request $request, Courses $course)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'track_id' => 'required|integer',
            'course' => 'required|string|max:255',
        ]);

        $course->update($request->only('subject_id','track_id','course',));

        return response()->json(['message' => 'Course updated successfully', 'course' => $course]);
    }

    // Delete course
    public function destroy(Courses $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
