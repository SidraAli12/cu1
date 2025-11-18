@extends('layouts.app')

@section('content')
<div class="card p-5">
    <h3 class="mb-4">Edit Quiz</h3>

    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Select Topic</label>
            <select name="topic_id" class="form-control">
                @foreach ($topics as $t)
                    <option value="{{ $t->id }}" {{ $quiz->topic_id == $t->id ? 'selected' : '' }}>
                        {{ $t->topic }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Quiz Name</label>
            <input type="text" name="name" value="{{ $quiz->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Duration (minutes)</label>
            <input type="number" name="duration_minutes" value="{{ $quiz->duration_minutes }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Total Marks</label>
            <input type="number" name="total_marks" value="{{ $quiz->total_marks }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update Quiz</button>
    </form>
</div>
@endsection
