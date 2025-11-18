<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    public function index($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        return view('questions.index', compact('quiz'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required|string',
            'marks' => 'required|numeric',
            'question_type' => 'required|string'
        ]);

        Question::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
            'marks' => $request->marks,
            'complexity' => $request->complexity,
            'question_type' => $request->question_type,
            'path' => $request->path
        ]);

        return redirect()->route('questions.index', $quizId)->with('success','Question added');
    }

    public function edit($quizId, $id)
    {
        $question = Question::findOrFail($id);
        $quiz = Quiz::findOrFail($quizId);
        return view('questions.edit', compact('question','quiz'));
    }

    public function update(Request $request, $quizId, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'question' => 'required|string',
            'marks' => 'required|numeric',
            'question_type' => 'required|string'
        ]);

        $question->update($request->only(['question','marks','complexity','question_type','path']));

        return redirect()->route('questions.index', $quizId)->with('success','Question updated');
    }

    public function destroy($quizId, $id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->route('questions.index', $quizId)->with('success','Question deleted');
    }
}
