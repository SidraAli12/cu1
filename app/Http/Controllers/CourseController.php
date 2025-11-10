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

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'track_id' => 'required|integer',
            'course' => 'required|string|max:255',
        ]);

        $course = Courses::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Course added successfully!',
            'data' => $course
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'track_id' => 'required|integer',
            'course' => 'required|string|max:255',
        ]);

        $course = Courses::findOrFail($id);
        $course->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Course updated successfully!',
            'data' => $course
        ]);
    }

    public function destroy($id)
    {
        Courses::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Course deleted successfully!'
        ]);
    }
}
