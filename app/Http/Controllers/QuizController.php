<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Topic;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('topic')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $topics = Topic::all();
        return view('quizzes.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string',
            'duration_minutes' => 'required|integer',
            'total_marks' => 'required|integer'
        ]);

        Quiz::create($request->only(['topic_id','name','duration_minutes','total_marks']));

        return redirect()->route('quizzes.index')->with('success','Quiz created');
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $topics = Topic::all();
        return view('quizzes.edit', compact('quiz','topics'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string',
            'duration_minutes' => 'required|integer',
            'total_marks' => 'required|integer'
        ]);

        $quiz->update($request->only(['topic_id','name','duration_minutes','total_marks']));

        return redirect()->route('quizzes.index')->with('success','Quiz updated');
    }

    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('quizzes.index')->with('success','Quiz deleted');
    }
}
