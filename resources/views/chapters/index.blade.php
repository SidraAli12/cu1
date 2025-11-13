@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Chapters</h1>

    <form action="{{ route('chapters.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div class="mb-3">
            <label class="block font-semibold">Select Topic</label>
            <select name="topic_id" class="border p-2 rounded w-full">
                @foreach($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->topic }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Chapter Name</label>
            <input type="text" name="name" class="border p-2 rounded w-full" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Upload File (PDF, MP3, MP4, etc.)</label>
            <input type="file" name="path" class="border p-2 rounded w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Chapter</button>
    </form>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">#</th>
                <th class="p-2 border">Topic</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">File</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chapters as $chapter)
            <tr>
                <td class="border p-2">{{ $chapter->id }}</td>
                <td class="border p-2">{{ $chapter->topic->topic ?? 'N/A' }}</td>
                <td class="border p-2">{{ $chapter->name }}</td>
                <td class="border p-2">
                    @if($chapter->path)
                        <a href="{{ asset('storage/'.$chapter->path) }}" target="_blank" class="text-blue-600">View File</a>
                    @else
                        No File
                    @endif
                </td>
                <td class="border p-2">
                    <form action="{{ route('chapters.destroy', $chapter->id) }}" method="POST" onsubmit="return confirm('Delete chapter?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
