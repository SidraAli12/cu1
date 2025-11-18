<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use Carbon\Carbon;
use Auth;

class QuizAttemptController extends Controller
{
    public function start($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => Auth::id(),
            'started_at' => Carbon::now(),
            'status' => 'in_progress'
        ]);

        return redirect()->route('quiz.take', $attempt->id);
    }

    public function take($attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions')->findOrFail($attemptId);
        $quiz = $attempt->quiz;
        return view('quiz.take', compact('attempt','quiz'));
    }

    public function submit(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions')->findOrFail($attemptId);
        if ($attempt->user_id != Auth::id()) abort(403);

        $answers = $request->input('answers', []);
        $total = 0;
        foreach ($attempt->quiz->questions as $q) {
            $given = $answers[$q->id] ?? null;
            if ($q->question_type === 'mcq' && isset($q->correct_answer)) {
                if ($given == $q->correct_answer) {
                    $total += $q->marks;
                }
            }
        }

        $attempt->update([
            'finished_at' => Carbon::now(),
            'total_score' => $total,
            'status' => 'completed'
        ]);

        return redirect()->route('quiz.results', $attempt->id);
    }

    public function results($attemptId)
    {
        $attempt = QuizAttempt::with('quiz')->findOrFail($attemptId);
        return view('quiz.results', compact('attempt'));
    }
}
