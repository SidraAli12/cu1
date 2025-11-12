<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Courses;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('course')->get();
        $courses = Courses::all(); 

        return view('topics.index', compact('topics', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'track_id' => 'required|integer',
            'topic' => 'required|string|max:255',
        ]);

        $topic = Topic::create($request->only(['course_id','track_id','topic']));

        return response()->json([
            'status' => 'success',
            'message' => 'Topic added successfully!',
            'data' => $topic
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'track_id' => 'required|integer',
            'topic' => 'required|string|max:255',
        ]);

        $topic = Topic::findOrFail($id);
        $topic->update($request->only(['course_id','track_id','topic']));

        return response()->json([
            'status' => 'success',
            'message' => 'Topic updated successfully!',
            'data' => $topic
        ]);
    }

    public function destroy($id)
    {
        Topic::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Topic deleted successfully!'
        ]);
    }
}
