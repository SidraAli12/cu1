<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Topic;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('topic')->get();
        $topics = Topic::all();
        return view('chapters.index', compact('chapters', 'topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string|max:255',
            'path' => 'nullable|file|mimes:pdf,mp3,mp4,doc,docx|max:10240',
        ]);

        $data = $request->only(['topic_id', 'name']);

        if ($request->hasFile('path')) {
            $file = $request->file('path')->store('uploads/chapters', 'public');
            $data['path'] = $file;
        }

        Chapter::create($data);

        return redirect()->back()->with('success', 'Chapter added successfully!');
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'nullable|file|mimes:pdf,mp3,mp4,doc,docx|max:10240',
        ]);

        $chapter->name = $request->name;

        if ($request->hasFile('path')) {
            $file = $request->file('path')->store('uploads/chapters', 'public');
            $chapter->path = $file;
        }

        $chapter->save();

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }

    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return redirect()->back()->with('success', 'Chapter deleted successfully!');
    }
}
